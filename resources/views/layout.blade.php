<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('style')
</head>
<body>
    <nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="logo fs-3" href="{{route('books')}}">Library</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('books')}}">
            Home
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('books')}}">
            Books
        </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{route('cats')}}">
            Categories
        </a>
        </li>
        @guest
        <li class="nav-item mx-3">
          <a class="nav-link reg" href="{{route('auth.register')}}">
            Register
        </a>
        </li>
        <li class="nav-item mx-3">
          <a class="nav-link login" href="{{route('auth.login')}}">
            Log in
        </a>
        </li>
        @endguest
        @auth
        <li class="nav-item mx-3">
          <a class="nav-link logout" href="{{route('auth.logout')}}">
            Log out
        </a>
        </li>
        <li class="nav-item mx-3">
          <a class="logo disabled" href="#">
            {{ Auth::user()->name }}
        </a>
        </li>

        @endauth
      </ul>
    </div>
  </div>
</nav>
    <div class="container py-5">
        @yield('content')
    </div>
    @yield('script')
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-3.6.1.min.js')}}"></script>
</body>
</html>
