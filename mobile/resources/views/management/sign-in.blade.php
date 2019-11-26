<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - HotelNest</title>
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
        <img src="{{ asset('images/management/logo.png') }}" alt="logo" style="width: 64px;">
      </nav>
    </header>
    <div class="">
      <div class="sign-in-container mx-auto">
        <h1 class="text-center">Sign In</h1>
        <hr />
        <form class="" action="index.html" method="post">
          <div class="form-group">
            <label for="sign-in-username">Username</label>
            <input type="text" class="form-control" name="" value="" placeholder="Username" id="sign-in-username">
          </div>
          <div class="form-group">
            <label for="sign-in-password">Password</label>
            <input type="password" class="form-control" name="" value="" placeholder="Password" id="sign-in-password">
          </div>
          <div class="form-group">
            <a href="#">Forgot password?</a>
          </div>
          <!-- <button type="button" name="button" class="btn btn-default btn-block font-weight-bold">Sign In</button> -->
          <a type="button" name="button" class="btn btn-default btn-block font-weight-bold" href="{{ url('management/book') }}">Sign In</a>
        </form>
      </div>
    </div>
  </body>
</html>
