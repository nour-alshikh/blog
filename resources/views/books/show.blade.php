@extends('layout')

@section('title')
    {{ $book->title }}
@endsection

@section('content')
    <h2>@lang('site.book_title') : {{ $book->title }}</h2>
    <h4>@lang('site.book_desc') : {{ $book->desc }}</h4>
    <h2>@lang('site.cats') : </h2>
    @foreach ($book->cats as $cat)
        <h4 class="btn btn-primary">
            {{ $cat->name }}
        </h4>
    @endforeach


    <hr>

    <a href="{{ route('books') }}" class="btn btn-success">@lang('site.back')</a>

    @include('inc.errors')
    <div class="search-book-box" style="width: 90%; min-height: 250px; margin-top: 50px;">

        @foreach ($notes as $note)
            <div>
                @if (Auth::user()->id == $note->user->id)
                    <p class="text-secondary m-0">@lang('site.me')</p>
                @else
                    <p class="text-success m-0">{{ $note->user->name }}</p>
                @endif
                <p>{{ $note->content }}</p>
            </div>
        @endforeach

        <form class="p-3" method="POST" action="{{ route('notes.store') }}">

            @csrf

            <div class="book-box m-0">
                <input class="m-0" type="text" name="content" value="{{ old('content') ?? '' }}">
                <label class="m-0">@lang('site.comments')</label>
            </div>

            <input type="hidden" name="book_id" value="{{ $book->id }}">

            <button class="m-0 mt-3 p-2" type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                @lang('site.add_comment')
            </button>
        </form>
    </div>
@endsection


@section('style')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
