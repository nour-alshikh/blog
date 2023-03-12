@extends('layout')

@section('title')
    Edit Book - {{$book->title}}
@endsection

@section('content')

@include('inc.errors')

<div class="add-book-box">
  <h2>Edit Book {{ $book->title }}</h2>
  <form method="POST" action="{{ route("books.update" , $book->id) }}" enctype="multipart/form-data">

    @csrf

    <div class="book-box">
      <input type="text" name="title" value="{{ old('title') ?? $book->title }}">
      <label>Title</label>
    </div>
    <div class="book-box">
      <input type="text" name="desc" value="{{ old('desc') ?? $book->desc }}">
      <label>Description</label>
    </div>
    <div class="mb-3">
        <input class="form-control" type="file" name="img">
    </div>
    <button type="submit">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit
    </button>
  </form>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
