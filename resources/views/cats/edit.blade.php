@extends('layout')

@section('title')
    Edit Category - {{$cat->title}}
@endsection

@section('content')

@include('inc.errors')

<div class="add-book-box">
  <h2>Edit Category {{ $cat->title }}</h2>
  <form method="POST" action="{{ route("cats.update" , $cat->id) }}">

    @csrf

    <div class="book-box">
      <input type="text" name="name" value="{{ old('name') ?? $cat->name }}">
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
