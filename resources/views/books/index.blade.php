@extends('layout')

@section('title')
    All Books
@endsection

@section('content')
    <div class="search-book-box">
        <div class="book-box">
            <input type="text" id="keyword" placeholder="search...">
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center py-5">

        <h1>@lang('site.all')</h1>

        @auth
            <a href="{{ route('books.create') }}" class="btn btn-primary">@lang('site.add_n')</a>
        @endauth
    </div>

    <div id="books">
        @foreach ($books as $book)
            <div class="d-flex justify-content-between align-items-center my-5 mx-auto" style="width: 70%">
                <a href="{{ route('books.show', $book->id) }}">
                    <h3>
                        {{ $book->title }}
                    </h3>
                </a>
                <h4>{{ $book->desc }}</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('books.show', $book->id) }}"
                        class="btn btn-primary d-block mx-2">@lang('site.show')</a>
                    @auth
                        <a href="{{ route('books.edit', $book->id) }}"
                            class="btn btn-success d-block mx-2">@lang('site.edit')</a>
                        @if (Auth::user()->is_admin == 1)
                            <a href="{{ route('books.delete', $book->id) }}"
                                class="btn btn-danger d-block mx-2">@lang('site.delete')</a>
                        @endif
                    @endauth
                </div>
            </div>
            <hr>
        @endforeach
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection

@section('script')
    <script>
        $('#keyword').keyup(function() {
            let keyword = $(this).val();
            let url = "{{ route('books.search') }}" + "?search=" + keyword

            $.ajax({
                type: "GET",
                url: url,
                contentType: false,
                processDate: false,
                success: function(data) {
                    $('#books').empty();
                    for (book of data) {
                        $('#books').append(`<h3>${book.title}</h3>
                        <h4>${book.desc}</h4>`)
                    }
                }
            })
        })
    </script>
@endsection
