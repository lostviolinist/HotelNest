<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book - HotelNest</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/a06c7371fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/management/master.css') }}">
  </head>
  <body>
    <header class="header">
      <nav class="navbar navbar-expand-md navbar-light container">
        <!-- Brand -->
        <a class="navbar-brand text-default font-weight-bold" href="{{ url('management/book') }}">
          <img src="{{ asset('images/management/logo.png') }}" alt="logo" style="width: 64px;">
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
            Shangri-La Hotel
          </a>
          <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ url('management/change-password') }}">Change password</a>
            <a class="dropdown-item" href="{{ url('management/sign-in') }}">Sign out</a>
          </div>
        </div>
      </nav>
    </header>
    <div class="container">
      <h1>Book</h1>
    </div>
  </body>
</html>
