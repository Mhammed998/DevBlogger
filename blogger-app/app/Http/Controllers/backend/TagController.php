<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:read-tags', ['only' => ['index']]);
        $this->middleware('permission:create-tags', ['only' => ['create','store']]);
        $this->middleware('permission:edit-tags', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-tags', ['only' => ['destroy']]);
    }


    public function index()
    {
        $tags = Tag::all();
        return view('backend.tags.index' , ['tags' => $tags]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.tags.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'tag_name' => 'required|string|min:2',
            'status' => 'default'
        ]);

        $tag = Tag::create([
            'tag_name' => $request->tag_name
        ]);

        toast('New Tag has been added successfully','success');

        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('backend.tags.edit' , ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        $this->validate($request,[
            'tag_name' => 'required|string|min:2',
            'status' => 'default'
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update([
            'tag_name' => $request->tag_name
        ]);

        toast(' tag has been updated successfully','success');

        return redirect()->route('tags.edit',$tag->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tag =Tag::findOrFail($id);
        $tag->delete();
        toast(' tag has been deleted successfully!','success');
        return redirect()->route('tags.index');
    }
}
