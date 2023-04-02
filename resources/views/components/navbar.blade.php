<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="logo fs-3" href="{{ route('books') }}">@lang('site.library')</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('books') }}">
                        @lang('site.home')
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('books') }}">
                        @lang('site.books')
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @lang('site.cats')
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('cats') }}">@lang('site.all_cats')</a></li>
                        @foreach ($cats as $cat)
                            <li><a class="dropdown-item"
                                    href="{{ route('cats.show', $cat->id) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @guest
                    <li class="nav-item mx-3">
                        <a class="nav-link reg" href="{{ route('auth.register') }}">
                            Register
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link login" href="{{ route('auth.login') }}">
                            Log in
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item mx-3">
                        <a class="nav-link logout" href="{{ route('auth.logout') }}">
                            @lang('site.logout')
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            @lang('site.chan')
                        </a>
                        <ul class="dropdown-menu">

                            <li><a class="dropdown-item" href="{{ route('lang', 'en') }}">EN</a></li>
                            <li><a class="dropdown-item" href="{{ route('lang', 'ar') }}">AR</a></li>
                        </ul>
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
