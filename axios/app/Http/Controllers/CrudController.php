<?php

namespace App\Http\Controllers;

use App\Models\Crud;
use App\Actions\File\File;
use Illuminate\Http\Request;
use App\Http\Requests\CrudRequest;

class CrudController extends Controller
{
    public function index()
    {
        return view('crud.index');
    }

    public function getAllData()
    {
        return Crud::latest()->get();
    }
    function store(CrudRequest $request)
    {
        $crud =  Crud::create([
            'name' => $request->name,
            'slug' => $request->name,
            'image' => File::upload($request->file('image'), 'crud')
        ]);
        if ($crud) {
            return true;
        }
    }

    public function show(Crud $crud)
    {
        return $crud;
    }

    public function edit(Crud $crud)
    {
        return $crud;
    }

    public function destroy(Crud $crud)
    {
        $image = $crud->image;
        File::deleteFile($image);
        return $crud->delete();
    }
    public function update(Request $request, Crud $crud)
    {

        $request->validate([
            'name' => "required|unique:cruds,name,{$crud->id}",
        ]);

        if ($request->file('image')) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
            ]);
            $olgImage = $crud->image;
            $crud =   $crud->update([
                'name' => $request->name,
                'slug' => $request->name,
                'image' => File::upload($request->file('image'), 'crud')
            ]);
            File::deleteFile($olgImage);
        } else {
            $crud =   $crud->update([
                'name' => $request->name,
                'slug' => $request->name
            ]);
        }

        if ($crud) {
            return true;
        } else {
            return false;
        }
    }
}
