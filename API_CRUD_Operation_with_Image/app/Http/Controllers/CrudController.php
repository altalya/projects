<?php

namespace App\Http\Controllers;

use App\Models\ImageCrud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CrudController extends Controller
{
    public function create(Request $request)
    {
        $images=new ImageCrud();
        $request->validate([
            'title'=>'required',
            'image'=>'required|max:1024'
        ]);
        $filename="";
        if($request->hasFile('image')){
            $filename=$request->file('image')->store('posts','public');
        }else{
            $filename=Null;
        }
        $images->title=$request->title;
        $images->image=$filename;
        $result=$images->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
        
    }

    public function show()
    {
        $images = ImageCrud::get();
        return view('showImage',compact('images'));
        // return $images;
    }

    public function get()
    {
        $images=ImageCrud::orderBy('id','ASC')->get();
        return response()->json($images);
    }

    public function edit($id)
    {
        $images=ImageCrud::findOrFail($id);
        return response()->json($images);
    }

    public function update(Request $request,$id)
    {
        $images=ImageCrud::findOrFail($id);
        
        $destination=public_path("storage\\".$images->image);
        $filename="";
        if($request->hasFile('new_image')){
            if(File::exists($destination)){
                File::delete($destination);
            }

            $filename=$request->file('new_image')->store('posts','public');
        }else{
            $filename=$request->image;
        }

        $images->title=$request->title;
        $images->image=$filename;
        $result=$images->save();
        if($result){
            return response()->json(['success'=>true]);
        }else{
            return response()->json(['success'=>false]);
        }
    }


    public function delete($id)
    {
        $images=ImageCrud::findOrFail($id);
        $destination=public_path("storage\\".$images->image);
        if(File::exists($destination)){
            File::delete($destination);
        }
        $images->delete();
    }
}
