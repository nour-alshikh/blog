<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request){
        $request->validate([
            'content' => 'required'
        ]);

        Note::create([
            'content' => $request->content,
            'book_id' => $request->book_id,
            'user_id' => Auth::user()->id,
        ]);

        return back();

    }
}
