<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        return view('index');
    }

    public function store(Request $request){
        $imageName = $request->file->getClientOriginalName();
        $request->file->move(public_path().'upload', $imageName);
        //$imageName->move(public_path().'/upload/', $name);
        return response()->json(['uploaded' => '/upload/'.$imageName]);
    }
}
