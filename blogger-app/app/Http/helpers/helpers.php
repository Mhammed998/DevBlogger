<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\File;

function isLinkActive($routeSegment){
    if (request()->segment(2) && request()->segment(2) == $routeSegment ){
    return 'active';
    }else{
        return '';
    }
}




// function uploadImage(Request $request , $path , $image )
// {
//     if($request->hasFile('$image')){
//
        // $request->validate([

        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        // ]);



        // $imageName = time().'.'.$request->image->extension();
        // $request->image->move(public_path('images'), $imageName);


//     }
// }
