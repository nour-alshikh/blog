@extends('layout')

@section('title')
    Add New Category
@endsection

@section('content')

@include('inc.errors')

<div class="add-book-box">
  <h2>Add New Category</h2>
  <form method="POST" action="{{ route("cats.store") }}" enctype="multipart/form-data">

    @csrf

    <div class="book-box">
      <input type="text" name="name" value="{{ old('name') ?? '' }}">
      <label>Name</label>
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
