<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @if(!isset($title))
            {{ Request::is('login') ? 'Авторизация' : 'Регистрация' }}
        @else
            {{ $title }}
        @endif
    </title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="@auth {{ url('/home') }} @else {{ url('/') }} @endauth">
                            Growth
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @guest
                                <li><a href="{{ route('login') }}">Войти</a></li>
                                <li><a href="{{ route('register') }}">Регистрация</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Выйти
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        @auth
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    {{ Auth::user()->name }}
                    <div class="panel">
                        <ul class="nav nav-pills nav-stacked">
                            <li class="{{ Request::is('execute') ? 'active' : '' }}" ><a href="{{ url('/execute') }}"><span class="glyphicon glyphicon-education"></span> Преподаватели</a></li>
                            <li class="{{ Request::is('#') ? 'active' : '' }}" ><a href="#"><span class="glyphicon glyphicon-calendar"></span> Расписание</a></li>
                            <li class="{{ Request::is('client') ? 'active' : '' }}" ><a href="{{ url('/client') }}"><span class="glyphicon glyphicon-user"></span> Клиенты</a></li>
                            <li class="{{ Request::is('#') ? 'active' : '' }}" ><a href="#"><span class="glyphicon glyphicon-ruble"></span> Финансовый учет</a></li>
                            <li class="{{ Request::is('#') ? 'active' : '' }}" ><a href="#"><span class="glyphicon glyphicon-hourglass"></span> Занятие</a></li>
                            <li class="{{ Request::is('#') ? 'active' : '' }}" ><a href="#"><span class="glyphicon glyphicon-home"></span> Филиалы</a></li>
                            <li class="{{ Request::is('direction') ? 'active' : '' }}" ><a href="{{ url('/direction') }}"><span class="glyphicon glyphicon-transfer"></span> Направление</a></li>
                            <li class="{{ Request::is('season') ? 'active' : '' }}" ><a href="{{ url('/season') }}"><span class="glyphicon glyphicon-credit-card"></span> Абонименты</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-10">
                    @yield('content')
                </div>
            </div>
        </div>
        @else
            @yield('content')
        @endauth
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
</body>
</html>
