@extends('layout')

@section('title')
    All Books
@endsection

@section('content')

<h1>All Books</h1>

@foreach ($books as $book)
    <a  href="{{ route("books.show" , $book->id) }}">
        <h3>
            {{ $book->title }}
        </h3>
    </a>
    <h4>{{ $book->desc }}</h4>
    <hr>
    @endforeach
    <span style="padding: 20px; width: 500px;">
        {!!$books->withQueryString()->links('pagination::bootstrap-5')!!}
    </span>

@endsection

