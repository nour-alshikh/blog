<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(){

        $cats = Cat::orderBy('id' , 'DESC')->get();
        // $books = Book::select('title' , 'desc')->where('id' , '>=' , 2)->orderBy('id' , 'DESC')->get();
        return view('cats.index' , compact('cats'));
    }

    public function show($id){
        $cat = Cat::findOrFail($id);
        return view('cats.show' , compact('cat'));
    }

    public function create(){
        return view('cats.create');
    }

    public function store(Request $request){
        $request->validate([
            'name'=> 'required|max:100|string',
        ]);

        Cat::create([
            'name' => $request->name,
        ]);
        return redirect( route('cats') );
    }

    public function edit($id){
        $cat = Cat::findOrFail($id);
        return view('cats.edit' , compact('cat'));
    }

    public function update(Request $request , $id){
        $request->validate([
            'name'=> 'required|max:100|string',
        ]);
        $cat = Cat::findOrFail($id);

        $cat->update([
            'name' => $request->name,
        ]);
        return redirect( route('cats') );
    }

    public function delete($id){
        $cat = Cat::findOrFail($id);

        $cat->delete();
        return redirect( route('cats') );
    }
}
