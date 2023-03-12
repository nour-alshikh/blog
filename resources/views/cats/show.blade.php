@extends('layout')

@section('title')
    {{$cat->title}}
@endsection

@section('content')

<h2>Cat ID : {{ $cat->id }}</h2>
<h2>Cat Title : {{ $cat->name }}</h2>

<hr>

<button>
    <a href="{{ route("cats") }}">Back</a>
</button>

@endsection
