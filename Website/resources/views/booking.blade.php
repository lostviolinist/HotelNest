<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="{{ asset('jquery-3.4.1/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>Booking Form</title>
</head>
<body>
<div class="container-fluid mt-3">
    <section class="row">
      <div class="col-md-8">
        <h1 class="title">HotelNest</h1>
      </div>
      <div class="col-md-4">
        <div class=" float-right" role="group">
          <a class="btn btn-secondary btn-md  mr-3" style="background-color: #586BA4;" href="#"> Register </a>
          <a class="btn btn-md btn-outline-secondary" tyle="border-color: #586BA4;" href="#"> Sign In </a>
        </div>
      </div>
    </section>
  </div>
    <div class="ml-5 mt-3">
        <h2>The St. Regis </h2>
    </div>
    <div class="container mt-5">
  <div class="row">
    <div class="col-sm">
      Twin Room
    </div>
    <div class="col-sm">
      Description description
    </div>
    <div class="col-sm">
      RM719/night
    </div>
  </div>
</div>
<div class="ml-5 mt-5">
    <form class="form-inline">
      <label class="sr-only" for="inlineFormInputName2">Name</label>
      <input type="text" class="form-control mb-2 mr-5" id="inlineFormInputName2" placeholder="Where">

      <label class="sr-only" for="inlineFormInputGroupUsername2">Check in</label>
      <div class="input-group mb-2 mr-sm-2">

        <input type="date" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Check in">
      </div>

      <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
      <div class="input-group mb-2 mr-sm-2">

        to
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Check Out</label>
      <div class="input-group mb-2 mr-5">

        <input type="date" class="form-control" id="inlineFormInputGroupUsername3" placeholder="Check Out">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Pax</label>
      <div class="input-group mb-2 mr-sm-2">

        <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername4"
          placeholder="1">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Pax</label>
      <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
      <div class="input-group mb-2 mr-5">

        Adults
      </div>
      <div class="input-group mb-2 mr-sm-2">

        <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername5"
          placeholder="1">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
      <div class="input-group mb-2 mr-5">

        Children
      </div>
      <div class="input-group mb-2 mr-sm-2">

        <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername5"
          placeholder="1">
      </div>
      
      <div class="input-group mb-2 mr-5">

       Rooms
      </div>
      


      
    </form>
  </div>
  <div class="container mt-5">
  <form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Full Name</label>
      <input type="text" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Check in time</label>
      <input type="time" class="form-control" id="inputPassword4">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Special request</label>
      <input type="text" class="form-control" id="inputPassword4">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputAddress">Phone</label>
    <input type="text" class="form-control" id="inputAddress">
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputAddress2">Country</label>
    <input type="text" class="form-control" id="inputAddress2" >
  </div>
  </div>
  <div class="container align-self-center">
  <button type="submit" class="btn btn-outline-primary">Book</button>
  </div>
  
</form>
  </div>
</body>
</html>