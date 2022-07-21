<?php

namespace App\Http\Controllers;

use App\Actions\File\File;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index()
    {
        return view('attribute');
    }

    public function fileUpload(Request $request)
    {
        foreach($request->images as $image ){
            File::upload($image,"image");
        }
        return back();
    }
}
