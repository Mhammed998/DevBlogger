<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:read-categories', ['only' => ['index' , 'show']]);
        $this->middleware('permission:create-categories', ['only' => ['create','save']]);
        $this->middleware('permission:edit-categories', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-categories', ['only' => ['delete']]);
    }


    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index' , ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:4|unique:categories',
            'description' => 'string',
            'category_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2024',
        ]);


        if($request->hasFile('category_image')){
            $image = $request->category_image;
            $imageExt = $image->extension();
            $imageName = time() . '.' . $imageExt;
            $image->move(public_path('backend/uploads/categories'), $imageName);
        }

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_image' => $imageName,
            'status' => $request->status
        ]);


         toast('Category has been created !' ,'success');
         return redirect()->route('categories.index');

    }


    public function show($id)
    {
        $category = Category::find($id);
        return view('backend.categories.show' , ['category' => $category]);

    }


    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.categories.edit' , ['category' => $category]);

    }


    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required|string|min:4|unique:categories,name,' . $id,
            'description' => 'required|string',
        ]);
        $category= Category::find($id);


        if($request->hasFile('category_image')){
            $imagePath = 'backend/uploads/categories/' . $category->category_image;
            // check if category has image then delete it
            if(file_exists(public_path($imagePath)) ){
                File::delete($imagePath);
            }

            $image = $request->category_image;
            $imageExt = $image->extension();
            $imageName = time() . '.' . $imageExt;
            $image->move(public_path('backend/uploads/categories'), $imageName);

            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'category_image' => $imageName,
                'status' => $request->status
            ]);
        }else{
            $category->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status
            ]);

        }

         toast('Category has been updated !' ,'success');
         return redirect()->route('categories.index');
    }


    public function destroy( $id)
    {
       $delCategory =  Category::find($id);

       $imagePath = 'backend/uploads/categories/' . $delCategory->category_image;
       // check if category has image then delete it
       if(file_exists(public_path($imagePath)) ){
           File::delete($imagePath);
       }
       $delCategory->delete();

        toast('Category has been deleted !','success');
        return redirect()->route('categories.index');
    }
}
