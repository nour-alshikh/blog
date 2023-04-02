<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBookController extends Controller
{
    public function index()
    {
        $books = Book::with('cats')->get();

        return response()->json($books);
    }

    public function show($id)
    {
        $books = Book::with('cats')->findOrFail($id);

        return response()->json($books);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'=> 'required|max:100|string',
            'desc'=> 'required|string',
            'img'=>'nullable|image',
            'cat_ids' => 'required',
            'cat_ids.*' => 'exists:cats,id',
        ]);

        if($validator->fails()){
            $err = $validator->errors();
            return response()->json($err);
        }

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
            $success = "Book Created Successfully";
            return response()->json($success);
        }

        $book = Book::create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);
        $book->cats()->sync($request->cat_ids);
        $success = "Book Created Successfully";
        return response()->json($success);
    }

    public function update(Request $request , $id){
        $validator = Validator::make($request->all(), [
            'title'=> 'required|max:100|string',
            'desc'=> 'required|string',
            'img'=>'nullable|image',
            'cat_ids' => 'required',
            'cat_ids.*' => 'exists:cats,id',
        ]);

        if($validator->fails()){
            $err = $validator->errors();
            return response()->json($err);
        }

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

        $success = "Book Updated successfully";

        return response()->json($success);
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

        $success = "Book deleted successfully";

        return response()->json($success);
    }
}
