@extends('layout')

@section('title')
    Add New Book
@endsection

@section('content')

@include('inc.errors')

<div class="add-book-box">
  <h2>@lang('site.add_n')</h2>
  <form method="POST" action="{{ route("books.store") }}" enctype="multipart/form-data">

    @csrf

    <div class="book-box">
      <input type="text" name="title" value="{{ old('title') ?? '' }}">
      <label>@lang('site.title')</label>
    </div>
    <div class="book-box">
      <input type="text" name="desc" value="{{ old('desc') ?? '' }}">
      <label>@lang('site.desc')</label>
    </div>
    <div class="mb-3">
        <input class="form-control" type="file" name="img">
    </div>
    @foreach ($cats as $cat)
    <div class="form-check">
        <input class="form-check-input" name="cat_ids[]" type="checkbox" value="{{ $cat->id }}" id="flexCheckDefault">
        <label class="form-check-label" for="flexCheckDefault">
            {{ $cat->name }}
        </label>
    </div>
    @endforeach

    <button type="submit">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      @lang('site.add')
    </button>
  </form>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
