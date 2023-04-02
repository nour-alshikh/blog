@extends('layout')

@section('title')
    Register
@endsection

@section('content')

@include('inc.errors')

<div class="add-book-box">
  <h2>Register</h2>
  <form method="POST" action="{{ route("auth.handleRegister") }}">

    @csrf

    <div class="book-box">
      <input type="text" name="name" value="{{ old('name') }}">
      <label>Name</label>
    </div>
    <div class="book-box">
      <input type="email" name="email" value="{{ old('email') }}">
      <label>Email</label>
    </div>
    <div class="book-box">
      <input type="password" name="password" value="{{ old('password') }}">
      <label>Password</label>
    </div>

    <button type="submit">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit
    </button>
  </form>
  <a href="{{ route('auth.redirect') }}">Github</a>
</div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/create.css') }}">
@endsection
