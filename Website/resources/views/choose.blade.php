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
              <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a city..." name = "city">

            </div>
            <div class="form-group p-2">
              <label for="exampleInputPassword1">Check-in-date</label>
              <input type="date" class="form-control" id="exampleInputPassword1" name = "checkInDate">
            </div>
            <div class="form-group p-2">
              <label for="exampleInputPassword1">Check-out-date</label>
              <input type="date" class="form-control" id="exampleInputPassword1" name = "checkOutDate">
            </div>
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
                    <a class="btn btn-primary float-right float-bottom mt-2 mb-2" href="{{ route('hotelpage', ['id'=> $arr[$i]->hotelId, 'cid'=> $checkInDate, 'cod'=>$checkOutDate])}}" role="button">See More</a>
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