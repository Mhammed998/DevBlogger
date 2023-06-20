<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:read-comments', ['only' => ['index' , 'show']]);
        $this->middleware('permission:create-comments', ['only' => ['create','save']]);
        $this->middleware('permission:edit-comments', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-comments', ['only' => ['delete']]);
    }

    public function index()
    {
        $comments= Comment::all();
        return view('backend.comments.index' , ['comments' => $comments]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();

        toast('Comment has been deleted successfully' , 'success');
        return redirect()->route('comments.index');
    }
}
