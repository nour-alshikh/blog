@extends('layout')

@section('title')
    {{ $cat->title }}
@endsection

@section('content')
    <h2>@lang('site.cat_name') : {{ $cat->name }}</h2>
    <h4>Books</h4>
    @foreach ($cat->books as $book)
        <h5>
            <a class="btn btn-primary" href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a>
        </h5>
    @endforeach

    <hr>
    <a href="{{ route('cats') }}" class="btn btn-success">@lang('site.back')</a>
@endsection
