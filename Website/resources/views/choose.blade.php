<!DOCTYPE html>
<html lang="en">

<?php

use App\Http\Controllers\SearchController;

$city =  $_REQUEST['city'];
$checkInDate =  $_REQUEST['checkInDate'];
$checkOutDate =  $_REQUEST['checkOutDate'];
$adult =  $_REQUEST['adult'];
$child =  $_REQUEST['child'];
$room =  $_REQUEST['room'];


$arr = json_decode(SearchController::getHotelDetails($city, $checkInDate, $checkOutDate, $adult, $child, $room));

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/bootstrap-4.3.1/css/bootstrap.min.css">
  <title>Choose a Hotel</title>
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

  <div class="ml-5 mt-5">
    <div class="row">
      <div class="col-sm">
        <div class="card" style="width: 18rem;">
          <form method="get" action="{{ route('choose') }}">
            <div class="form-group p-2">
              <label for="exampleInputEmail1">City</label>
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a city..." name="city">

            </div>
            <div class="container">

              Start Date <input id="checkInDate" width="260" name="checkInDate" />
              End Date <input id="checkOutDate" width="260" name="checkOutDate" />
            </div>
            <script>
              var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
              $('#checkInDate').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                minDate: today,
                maxDate: function() {
                  return $('#checkOutDate').val();
                }
              });
              $('#checkOutDate').datepicker({
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'fontawesome',
                minDate: function() {
                  return $('#checkInDate').val();
                }
              });
            </script>
            <div class="form-row p-2">
              <div class="form-group col-md-3 m-3">
                <label for="inputCity">Adults</label>
                <input type="number" class="form-control" id="inputCity" min="1" name="adult">
              </div>
              <div class="form-group col-md-3 m-3">
                <label for="inputState">Children</label>
                <input type="number" class="form-control" id="inputCity" min="0" name="child">
              </div>
              <div class="form-group col-md-3 m-3">
                <label for="inputState">Rooms</label>
                <input type="number" class="form-control" id="inputCity" min="1" name="room">
              </div>
            </div>

            <button type="submit" class="btn btn-primary ml-4 mb-3">Search</button>
          </form>
        </div>
      </div>
      <div class="col-md-9">
        <div class="row">
          <div class="col"> <button class="btn btn-success"> Recommended </button> </div>
        </div>


        <div style="height: 300px overflow = scroll;">

          <?php
          for ($i = 0; $i < count($arr); $i++) {
          ?>
            <div class="card mb-3 mt-3" style="max-width: 1000px;">
              <div class="row no-gutters">
                <div class="col-md-4">
                  <img src="<?php echo $arr[$i]->picturePath ?>" class="card-img" style="height:250px " alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?php echo $arr[$i]->name ?></h5>
                    <p class="card-text"><?php echo $arr[$i]->description ?></p>
                    <p class="card-text">RM<?php echo $arr[$i]->lowestPrice ?>/night</p>
                    <a class="btn btn-primary float-right float-bottom mt-2 mb-2" href="{{ route('hotelpage', ['id'=> $arr[$i]->hotelId, 'cid'=> $checkInDate, 'cod'=>$checkOutDate, 'adult'=>$adult, 'child'=>$child, 'room'=>$room ]) }}" role="button">See More</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>

      </div>

    </div>
  </div>


</body>

</html>