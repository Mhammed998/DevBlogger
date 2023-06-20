<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Str;


class SiteController extends Controller
{



    public function index(){
        $categories = Category::all();
        $posts = Post::all();
        $tags = Tag::all();
        $currentUser=Auth::user();
        $latestPosts = Post::latest()->paginate(5);

        return view('frontend.welcome' , [
            'categories'=> $categories ,
            'posts' => $posts ,
            'tags' => $tags ,
            'latestPosts' => $latestPosts ,
            'currentUser' => $currentUser
        ]);
    }


    public function showPostDetails($id){
      $post = Post::findOrFail($id);
      $categories = Category::all();
      $tags = Tag::all();
      $currentUser=Auth::user();
      $postComments = $post->comments;
      $latestPosts = Post::latest()->where('id' , '!=',$post->id)->paginate(5);

      return view('frontend.posts.show',
          [
              'post'=>$post ,
              'categories' => $categories ,
              'tags' => $tags,
              'latestPosts' => $latestPosts,
              'postComments' => $postComments,
              'currentUser' => $currentUser
          ]);

    }


    public function showCategoryDetails($id){
        $category = Category::findOrFail($id);

    }




    // Account Profile Functions

    public function showAccountprofile(){
       $author = Auth::user();
       $author_posts = $author->posts;
       return view('frontend.users.account-profile' , [
           'author' => $author ,
           'author_posts' =>$author_posts
       ]);
    }


    public function editAccountprofile(){
        $user = Auth::user();
        return view('frontend.users.edit-account' , ['user'=> $user]);
    }



    public function updateAccountInfo(Request $request , $id){

        $this->validate($request,[
            'name' => 'required|string|min:4',
            'email' => 'required|email|unique:users,email,'.$id,
            'about' => 'sometimes|string'
        ]);

        $input = $request->all();
        $user = User::find($id);
        if($request->hasFile('avatar')){
            $imagePath = 'backend/uploads/users/' . $user->avatar;
            // check if category has image then delete it
            if(file_exists(public_path($imagePath)) ){
                File::delete($imagePath);
            }

            $image = $request->avatar;
            $imageExt = $image->extension();
            $imageName = time() . '.' . $imageExt;
            $image->move(public_path('backend/uploads/users'), $imageName);

            $user->update([
                'name' =>  $input['name'],
                'email' => $input['email'],
                'avatar' => $imageName ,
                'about' => $input['about'],
            ]);

        }else{
            $user->update($input);
        }

        toast('Account information has been updated !','success');
        return redirect()->back();

    }





    public function updateAccountPassword(Request $request , $id){
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required|same:password_confirmation',
            'password_confirmation' => 'required'
        ]);


        $user = User::find($id);
        $passwords = $request->all();
        $oldPass = $passwords['old_password'];
        $userPass = $user->password;
        $newPass= $passwords['new_password'];

        //check if the old password is correct..!
        if(FacadesHash::check($oldPass, $userPass)){
            $newHashedPass = bcrypt($newPass);
            $user->update([
                'password' => $newHashedPass
            ]);

            toast('Account password has been updated !','success');
            return redirect()->back();

        }else{
            toast('Wrong password !','error');
        }


    }


    public function deleteProfileAccount($id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('/login');
    }




    // author profile
    public function showAuthorProfile($id){
        $author = User::find($id);
        $author_posts = $author->posts;
        return view('frontend.users.show-user' , [
            'author' => $author ,
            'author_posts' => $author_posts
            ]);
    }






    // Comments System Functions
    public function saveComment(Request $request){
        $this->validate($request , [
            'comment' => 'required|string',
            'post_id' => 'required'
        ]);
        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id
        ]);

        toast('Comment has been created successfully' , 'success');
        return redirect()->back();
    }

    public function storeRepliedComment(Request $request){
        $this->validate($request , [
            'comment' => 'required|string',
            'post_id' => 'required',
            'parent_id' => 'required'
        ]);
        $comment = Comment::create([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'parent_id' => $request->parent_id
        ]);

        toast('Comment has been replied successfully' , 'success');
        return redirect()->back();
    }



    public function deleteComment($id)
    {
        $comment = Comment::find($id);
        $subComments= Comment::where('parent_id' , '=' , $comment->id)->get();
        if($subComments->count() > 0) {
            foreach ($subComments as $sub) {
                $sub->delete();
            }
        }
        $comment->delete();

        toast('Comment has been deleted successfully' , 'success');
        return redirect()->back();
    }


    public function  updateComment(Request $request , $id)
    {
        $comment = Comment::find($id);
        $comment->update([
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
            'post_id' => $comment->post_id
        ]);

        toast('Comment has been updated successfully', 'success');
        return redirect()->back();
    }




    public function showCategory($id){
     $category=Category::findOrFail($id);
     return view('frontend.category.show-category',['category'=>$category]);
    }










    // Tags Functions

    public function tagPosts($id){
        $tag = Tag::findOrFail($id);
        return view('frontend.tags.show-tags' , ['tag' => $tag]);
    }


   public  function addToFavorite($id){
        $post = Post::findOrFail($id);
        $user=Auth::user();
       $exists = $user->favPosts->contains($post->id);
       if($exists){
           $post->allUsers()->detach($user->id);
           toast('Post has been removed from favorite list ' , 'success');

       }else{
           $post->allUsers()->attach($user->id);
           toast('Post has been added to favorite list ' , 'success');
       }

        return redirect()->route('favorite-posts.show');
   }




   public function showFavoritePosts(){
        $user = Auth::user();
        $favPosts = $user->favPosts;
        return view('frontend.users.favorite-list' , ['favPosts' => $favPosts]);
   }










}
