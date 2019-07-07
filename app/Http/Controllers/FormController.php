<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Form;

class FormController extends Controller
{
    
    public function index(){
        return view('create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);


        if($request->hasFile('filename')){
            foreach($request->file('filename') as $image){
                $name = $image->getClientOriginalName();
                $image->move(public_path().'/new_images/',$name);
                $data[] = $name;
            }
        }

        $form = new Form;
        $form->filename = json_encode($data);

        $form->save();

        return back()->withSuccess('Image Uploades Successfully');
    }
}
