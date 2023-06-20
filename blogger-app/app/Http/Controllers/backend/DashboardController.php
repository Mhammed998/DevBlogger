<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:main-dashboard', ['only' => ['index']]);
    }

    public function index(){
        $users = User::all();
        $posts= Post::all();
        $categeories = Category::all();
        $tags = Tag::all();
        $comments = Comment::all();
        $lastUsers = User::paginate(5);
        $lastComments = Comment::paginate(5);
        return view('backend.dashboard' ,[
            'users' => $users ,
            'posts' => $posts ,
            'categories' => $categeories,
            'tags' => $tags,
            'comments' => $comments ,
            'lastUsers' => $lastUsers,
            'lastComments' => $lastComments
          ]);
    }


    public function showAccountProfile(){
       $user = Auth::user();
       return view('backend.account-profile.show-profile' , ['user'=> $user]);
    }


    public function editAccountProfile(){
        $user = Auth::user();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('backend.account-profile.edit-profile' ,compact('user','roles','userRole'));
     }






}
