<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - HotelNest</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/a06c7371fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/management/master.css') }}">
    <!-- Moment (For datetimepicker)-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" charset="utf-8"></script>
    <!-- Datetimepicker -->
    <link rel="stylesheet" href="css/management/bootstrap-datetimepicker.min.css">
    <script src="{{ asset('js/management/bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>
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
    <div class="">
      <div class="container px-0">
        <div class="row px-0 mx-0">
          <img class="picture-big col-lg-4 col-md-6 col-sm-8 px-0" src="{{ asset('images/management/hotel.png') }}" alt="hotel" />
          <div class="col-lg-8 col-md-6 col-sm-4 px-0 mx-0">
            <div class="row px-0 mx-0">
              <div class="col-lg-4 col-md-6 px-0 mx-0 d-flex d-sm-block">
                <img class="picture-small col-6 col-sm-12 px-0" src="{{ asset('images/management/hotel2.png') }}" alt="hotel" />
                <img class="picture-small col-6 col-sm-12 px-0" src="{{ asset('images/management/hotel3.png') }}" alt="hotel" />
              </div>
              <div class="col-lg-4 col-md-6 px-0 d-none d-md-block">
                <img class="picture-small col-sm-12 px-0" src="{{ asset('images/management/hotel4.png') }}" alt="hotel" />
                <img class="picture-small col-sm-12 px-0" src="{{ asset('images/management/hotel5.png') }}" alt="hotel" />
              </div>
              <div class="col-md-4 px-0 d-none d-lg-block">
                <img class="picture-small col-12 px-0" src="{{ asset('images/management/hotel6.png') }}" alt="hotel" />
                <img class="picture-small col-12 px-0" src="{{ asset('images/management/hotel7.png') }}" alt="hotel" />
              </div>
            </div>
          </div>
        </div>
        <div class="row px-0 mx-0">
          <div class="col-12 mt-3">
            <button class="btn btn-default float-right" type="button" name="button">
              <i class="fas fa-camera"></i>&nbsp;
              Change Photos
            </button>
          </div>
        </div>
      </div>
      <div class="container profile-container">
        <form class="" action="index.html" method="post">
          <div class="form-group row">
            <label for="" class="col-sm-3 col-form-label">Hotel Name</label>
            <div class="col-sm-9">
              <input readonly class="form-control-plaintext font-weight-bold" type="text" name="" value="Shangri-La Hotel">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="check-in-timepicker">Check-in Time</label>
              <input type="text" class="form-control" id="check-in-timepicker" placeholder="Hotel check-in time">
            </div>
            <div class="form-group col-md-6">
              <label for="check-out-timepicker">Check-out Time</label>
              <input type="text" class="form-control" id="check-out-timepicker" placeholder="Hotel check-out time">
            </div>
            <script type="text/javascript">
              $(function () {
                $('#check-in-timepicker').datetimepicker({
                  format: 'LT'
                });
                $('#check-out-timepicker').datetimepicker({
                  format: 'LT'
                });
              });
            </script>
          </div>
          <div class="form-group">
            <label for="hotel-description">Description</label>
            <textarea class="form-control" name="name" rows="8" cols="80" id="hotel-description" placeholder="Hotel description"></textarea>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="button" name="button" class="btn btn-default float-right">
                <i class="fas fa-pen fa-fw"></i>&nbsp;
                Update
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
