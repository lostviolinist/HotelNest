<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="{{ asset('jquery-3.4.1/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>
    
    <!-- FontAwesome 5 -->
    <script src="https://kit.fontawesome.com/a06c7371fc.js" crossorigin="anonymous"></script>
    
    <!-- master.css -->
    <link rel="stylesheet" href="{{ asset('css/management/master.css') }}">
    
    <!-- Moment (For datetimepicker)-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" charset="utf-8"></script>
    
    <!-- Datetimepicker -->
    <link rel="stylesheet" href="{{ asset('css/management/bootstrap-datetimepicker.min.css') }}">
    <script src="{{ asset('js/management/bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>
</head>
<body>
    <header class="header">
      <nav class="navbar navbar-expand-md navbar-light container">
        @if (session('management_admin_id') != null)
            <!-- Brand -->
            <a class="" href="{{ url('management/book') }}">
                <img src="{{ asset('images/management/logo.png') }}" alt="logo" style="width: 64px;" />
            </a>

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse ml-5" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item nav-item-header">
                    <a class="nav-link text-default nav-link-header" href="{{ url('management/book') }}">Book</a>
                    </li>
                    <li class="nav-item nav-item-header">
                    <a class="nav-link text-default nav-link-header" href="{{ url('management/bookings') }}">Bookings</a>
                    </li>
                    <li class="nav-item nav-item-header">
                    <a class="nav-link text-default nav-link-header" href="#">Rooms</a>
                    </li>
                </ul>
            </div>
            <div class="btn-group">
                <a type="button" class="btn btn-default" href="{{ url('management/profile') }}">
                    <i class="fas fa-home fa-fw"></i>&nbsp;
                    {{ session('management_hotel_name') }}
                </a>
                <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"></button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="{{ url('management/change-password') }}">Change password</a>
                    <a class="dropdown-item" href="{{ route('management/sign-out') }}">Sign out</a>
                </div>
            </div>
        @else
            <img src="{{ asset('images/management/logo.png') }}" alt="logo" style="width: 64px;" />
        @endif
      </nav>
    </header>
    @yield('content')
</body>
</html>
