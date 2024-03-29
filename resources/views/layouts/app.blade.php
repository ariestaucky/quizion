<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand mr-0" href="{{ url('/') }}">
                    {{ config('app.name', 'QUIZION') }}
                </a>
                <button class="navbar-toggler no-padding" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            @if(Request::is('quiz', 'subject'))
                                <li class="nav-item">
                                    <a href="/home" class="nav-link">Dashboard</a>
                                </li>
                            @endif
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @if(Request::is('quiz', 'subject', 'quiz/start', 'quiz/retry', 'quiz/save', 'quiz/*/*/result', 'login', 'register', 'password/reset'))
                <section class="py-5 with-margin no-padding-top-for-py-5">
                    <div class="container">
                        @yield('content')
                    </div>
                </section>     
            @else
                <div class="container-fluid">
                    <div class="row">
                        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                            <div class="sidebar-sticky">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('home') ? 'active' : ''}}" href="/home">
                                        <span data-feather="home"></span>
                                        Dashboard <span class="sr-only">(current)</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('list') ? 'active' : ''}}" href="/list">
                                        <span data-feather="file"></span>
                                        My Quiz
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('*/profile') ? 'active' : ''}}" href="/{{auth()->user()->id}}/profile">
                                        <span data-feather="shopping-cart"></span>
                                        My Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#">
                                        <span data-feather="users"></span>
                                        Setting
                                        </a>
                                    </li>
                                </ul>
                        
                                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                                    <span>Quick Shortcut</span>
                                    <a class="d-flex align-items-center text-muted" href="#">
                                        <span data-feather="plus-circle"></span>
                                    </a>
                                </h6>
                                <ul class="nav flex-column mb-2">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/quiz">
                                        <span data-feather="file-text"></span>
                                        Take a Test
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{Request::is('submitquiz') ? 'active' : ''}}" href="/submitquiz">
                                        <span data-feather="file-text"></span>
                                        New Quiz
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        @yield('content')
                    </div>
                </div>
            @endif     
        </main>
    </div>
    
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>
