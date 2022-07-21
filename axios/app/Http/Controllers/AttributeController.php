<?php

namespace App\Http\Controllers;

use App\Actions\File\File;
use App\Models\Image;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return view('attribute');
    }

    public function fileUpload(Request $request)
    {
        // dd($request->images);
        foreach($request->images as $image ){
           Image::create(["image" => File::upload($image,"image")]) ;
        }
        return back();
    }
}
