@extends('layout')

@section('title')
    All Categories
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center py-5">
        <h1>@lang('site.all_cats')</h1>

        <a href="{{ route('cats.create') }}" class="btn btn-primary">@lang('site.add_new_cat')</a>

    </div>
    @foreach ($cats as $cat)
        <div class="d-flex justify-content-between align-items-center my-5 mx-auto" style="width: 70%">
            <a class="d-block text-decoration-none" href="{{ route('cats.show', $cat->id) }}">
                <h3>
                    {{ $cat->name }}
                </h3>
            </a>
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('cats.show', $cat->id) }}" class="btn btn-primary d-block mx-2">@lang('site.show')</a>
                @auth
                    <a href="{{ route('cats.edit', $cat->id) }}" class="btn btn-success d-block mx-2">@lang('site.edit')</a>
                    <a href="{{ route('cats.delete', $cat->id) }}" class="btn btn-danger d-block mx-2">@lang('site.delete')</a>
                @endauth
            </div>
        </div>
        <hr>
    @endforeach
@endsection
