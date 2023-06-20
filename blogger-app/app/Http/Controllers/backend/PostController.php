<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:read-posts', ['only' => ['index' , 'show']]);
        $this->middleware('permission:create-posts', ['only' => ['create','save']]);
        $this->middleware('permission:edit-posts', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-posts', ['only' => ['delete']]);
    }


    public function index()
    {
        $posts = Post::all();

        return view('backend.posts.index' , ['posts'=> $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories = Category::all();
       $tags = Tag::all();

       return view('backend.posts.create',['categories'=>$categories , 'tags' =>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request ,[
            'title' => 'required|string|min:10',
            'content' =>'required|string|min:20',
            'post_image' =>'sometimes|image|mimes:jpg,png,jpeg,gif|max:2024',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        if($request->hasFile('post_image')){
          $image = $request->post_image;
          $imageExt = $image->extension();
          $imageName = time() . '.' . $imageExt;
          $image->move(public_path('backend/uploads/posts'), $imageName);


         $post=Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'post_image' => $imageName
          ]);

        }else{
          $post=Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
          ]);
        }

        if ($request->has('post_tags')) {
            $post->tags()->attach($request->post_tags);
        }

        toast('Post has been created' , 'success');
        return redirect()->route('posts.index');




    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post=Post::find($id);

        return view('backend.posts.show' , ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $categories = Category::all();
        $post=Post::find($id);
        $tags = Tag::all();
        $selectedTags =$post->tags()->get()->pluck('id')->toArray();


        return view('backend.posts.edit' ,
         ['post' => $post ,
         'categories' => $categories ,
         'tags' =>$tags ,
         'selectedTags' => $selectedTags
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $this->validate($request ,[
            'title' => 'required|string|min:10',
            'content' =>'required|string|min:20',
            'post_image' =>'sometimes|image|mimes:jpg,png,jpeg,gif|max:2024',
            'user_id' => 'required|integer',
            'category_id' => 'required|integer'
        ]);

        $post = Post::find($id);

        if($request->hasFile('post_image')){


            $imagePath = 'backend/uploads/posts/' . $post->post_image;
            // check if category has image then delete it
            if(file_exists(public_path($imagePath)) ){
                File::delete($imagePath);
            }



          $image = $request->post_image;
          $imageExt = $image->extension();
          $imageName = time() . '.' . $imageExt;
          $image->move(public_path('backend/uploads/posts'), $imageName);


          $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'post_image' => $imageName
          ]);

        }else{
          $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
          ]);
        }


        if ($request->has('post_tags')) {
            $post->tags()->sync($request->post_tags);
         }


        toast('Post has been updated' , 'success');
        return redirect()->route('posts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $delPost =  Post::find($id);

        $imagePath = 'backend/uploads/posts/' . $delPost->post_image;
        // check if category has image then delete it
        if(file_exists(public_path($imagePath)) ){
            File::delete($imagePath);
        }

        $delPost->tags()->detach();

        $delPost->delete();

         toast('Post has been deleted !','success');
         return redirect()->route('posts.index');
    }
}
