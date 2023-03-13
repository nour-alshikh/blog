<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){

        $books = Book::orderBy('id' , 'DESC')->paginate(3);
        // $books = Book::select('title' , 'desc')->where('id' , '>=' , 2)->orderBy('id' , 'DESC')->get();
        return view('books.index' , compact('books'));
    }

    public function show($id){
        $book = Book::findOrFail($id);
        return view('books.show' , compact('book'));
    }

    public function create(){
        return view('books.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=> 'required|max:100|string',
            'desc'=> 'required|string',
            'img'=>'nullable|image'
        ]);

        if($request->hasFile('img')){
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = 'book-' . uniqid() . '.' . $ext;
            $img->move(public_path('uploads/books'),$name);

            Book::create([
                'title' => $request->title,
                'desc' => $request->desc,
                'img' => $name
            ]);
            return redirect( route('books') );
        }

        Book::create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);
        return redirect( route('books') );
    }

    public function edit($id){
        $book = Book::findOrFail($id);
        return view('books.edit' , compact('book'));
    }

    public function update(Request $request , $id){
        $request->validate([
            'title'=> 'required|max:100|string',
            'desc'=> 'required|string',
            'img' =>'nullable|image'
        ]);
        $book = Book::findOrFail($id);
        $name = $book->img;

        if($request->hasFile('img')){

            if($name !== null ){
                unlink( public_path('uploads/books/') . $name );
            }

            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = 'book-' . uniqid() . '.' . $ext;
            $img->move(public_path('uploads/books') , $name);
        }

        $book->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'img' => $name
        ]);
        return redirect( route('books') );
    }

    public function delete($id){
        $book = Book::findOrFail($id);

        if($book->img !== null){
            unlink( public_path('uploads/books/') . $book->img );
        }

        $book->delete();
        return redirect( route('books') );
    }
}
