@extends('layout')

@section('title')
    All Books
@endsection

@section('content')

<h1>All Books</h1>

<a href="{{ route('books.create') }}" class="btn btn-primary" >Add New Book</a>

@foreach ($books as $book)
<div class="d-flex justify-content-between align-items-center my-5 mx-auto" style="width: 70%">
    <a  href="{{ route("books.show" , $book->id) }}">
        <h3>
            {{ $book->title }}
        </h3>
    </a>
    <h4>{{ $book->desc }}</h4>
        <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('books.show' , $book->id) }}" class="btn btn-primary d-block mx-2" >Show</a>
        @auth
        <a href="{{ route('books.edit' , $book->id) }}" class="btn btn-success d-block mx-2" >Edit</a>
        <a href="{{ route('books.delete' , $book->id) }}" class="btn btn-danger d-block mx-2" >Delete</a>
        @endauth
    </div>
</div>
    <hr>
    @endforeach
    <span style="padding: 20px; width: 500px;">
        {!!$books->withQueryString()->links('pagination::bootstrap-5')!!}
    </span>

@endsection

