@extends('layout')

@section('title')
    Edit Category - {{ $cat->name }}
@endsection

@section('content')
    @include('inc.errors')

    <div class="add-book-box">
        <h2>@lang('site.edit_cat') - {{ $cat->name }}</h2>
        <form method="POST" action="{{ route('cats.update', $cat->id) }}">

            @csrf

            <div class="book-box">
                <input type="text" name="name" value="{{ old('name') ?? $cat->name }}">
                <label>@lang('site.name')</label>
            </div>
            <button type="submit">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                @lang('site.edit')
            </button>
        </form>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
