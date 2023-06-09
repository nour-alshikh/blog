<?php

namespace App\Http\Controllers;

use App\Models\Cat;
use App\Models\Book;
use App\Models\Note;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){

        $books = Book::orderBy('id' , 'DESC')->get();
        // $books = Book::select('title' , 'desc')->where('id' , '>=' , 2)->orderBy('id' , 'DESC')->get();
        return view('books.index' , compact('books'));
    }

    public function show($id){
        $book = Book::findOrFail($id);

        $notes = Note::where('book_id' , '=' ,$id)->get();
        return view('books.show' , compact('book' , 'notes'));
    }

    public function create(){
        $cats = Cat::all();
        return view('books.create' , compact('cats'));
    }

    public function store(Request $request){
        $request->validate([
            'title'=> 'required|max:100|string',
            'desc'=> 'required|string',
            'img'=>'nullable|image',
            'cat_ids' => 'required',
            'cat_ids.*' => 'exists:cats,id',
        ]);

        if($request->hasFile('img')){
            $img = $request->file('img');
            $ext = $img->getClientOriginalExtension();
            $name = 'book-' . uniqid() . '.' . $ext;
            $img->move(public_path('uploads/books'),$name);

            $book = Book::create([
                'title' => $request->title,
                'desc' => $request->desc,
                'img' => $name
            ]);

            $book->cats()->sync($request->cat_ids);

            return redirect( route('books') );
        }

        $book = Book::create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);
        $book->cats()->sync($request->cat_ids);
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
            'img' =>'nullable|image',
            'cat_ids' => 'required',
            'cat_ids.*' => 'exists:cats,id',
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


        $book->cats()->sync($request->cat_ids);

        return redirect( route('books') );
    }

    public function delete($id){
        $book = Book::findOrFail($id);

        if($book->img !== null){
            unlink( public_path('uploads/books/') . $book->img );
        }

        $book->cats()->sync([]);
        $notes = Note::where('book_id' , '=' ,$id )->get();
        foreach($notes as $note){
            $note->delete();
        }
        $book->delete();
        return redirect( route('books') );
    }

    public function search(Request $request){
        $keyword = $request->search;
        $books = Book::where('title' , 'like' , "%$keyword%")->get();

        return response()->json($books);
    }
}
