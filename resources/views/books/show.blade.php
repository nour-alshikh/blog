@extends('layout')

@section('title')
    {{$book->title}}
@endsection

@section('content')

<h2>Book ID : {{ $book->id }}</h2>
<h2>Book Title : {{ $book->title }}</h2>
<h2>Book Description : {{ $book->desc }}</h2>

<hr>

<button>
    <a href="{{ route("books") }}">Back</a>
</button>

@endsection
