@extends('layouts.app')

@section('content')

<?php

use App\Http\Controllers\SelectController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;

$checkInDate =  $_REQUEST['cid'];
$checkOutDate =  $_REQUEST['cod'];
$hotelId = $_REQUEST['id'];
$adult =  $_REQUEST['adult'];
$child =  $_REQUEST['child'];
$roomList =  $_REQUEST['room'];


$arr = json_decode(SelectController::getHotelInfo($hotelId));
$image = json_decode(ImageController::getImage($hotelId));
$room = json_decode(SelectController::getRoomInfo($hotelId, $checkInDate, $checkOutDate));

?>

<!-- <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> 
  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <title>Hotel</title>
</head> -->

<!-- <div class="container-fluid mt-3">
    <section class="row">
      <div class="col-md-8">
        <h1 class="title"><a href="{{ route('mainhome') }}">HotelNest</a></h1>
      </div>
      <div class="col-md-4">
        <div class=" float-right" role="group">
          <a class="btn btn-secondary btn-md register-button mr-3" href="#"> Register </a>
          <a class="btn btn-md btn-outline-secondary signin-button" href="#"> Sign In </a>
        </div> 
      </div>
    </section>
  </div> -->
  <div class="container">
    <hr class="mt-2 mb-5">

    <div class="container px-0">
      <div class="row px-0 mx-0">
        <img class="picture-big col-lg-4 col-md-6 col-sm-8 px-0" src="<?php print_r($image[0]) ?>" style="height:310px" alt="hotel" />
        <div class="col-lg-8 col-md-6 col-sm-4 px-0 mx-0">
          <div class="row px-0 mx-0">
            <div class="col-lg-4 col-md-6 px-0 mx-0 d-flex d-sm-block">
              <img class="picture-small col-6 col-sm-12 px-0" style="width:250.5px; height:155px" src="<?php print_r($image[1]) ?>" alt="hotel" />
              <img class="picture-small col-6 col-sm-12 px-0" style="width:250.5px; height:155px" src="<?php print_r($image[2]) ?>" alt="hotel" />
            </div>
            <div class="col-lg-4 col-md-6 px-0 d-none d-md-block">
              <img class="picture-small col-sm-12 px-0" style="width:250.5px; height:155px" src="<?php print_r($image[3]) ?>" alt="hotel" />
              <img class="picture-small col-sm-12 px-0" style="width:250.5px; height:155px" src="<?php print_r($image[4]) ?>" alt="hotel" />
            </div>
            <div class="col-md-4 px-0 d-none d-lg-block">
              <img class="picture-small col-12 px-0" style="width:250.5px; height:155px" src="<?php print_r($image[5]) ?>" alt="hotel" />
              <img class="picture-small col-12 px-0" style="width:250.5px; height:155px" src="<?php print_r($image[6]) ?>" alt="hotel" />
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <h1><?php echo $arr[0]->name ?></h1>
        <h4><?php echo $arr[0]->city ?></h4>
        <p><?php echo $arr[0]->operationTime ?><br>
          <?php echo $arr[0]->description ?>
        </p>
      </div>
      <div class="col">
        <div class="container">
          Start Date:  <?php print_r($checkInDate) ?> <br> <br>
          End Date:  <?php print_r($checkOutDate) ?>
        </div>
        


      </div>
      <div class="col">
        <a class="btn btn-md btn-outline-secondary signin-button" href="#"> More Photos </a>
      </div>
    </div>

  </div>
  <div class="container mt-5">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Room type</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Pax</th>
          <th scope="col">Number of Rooms</th>
        </tr>
      </thead>
      <tbody id="searchResult">
        <?php for ($i = 0; $i < count($room); $i++) { ?>
          <tr>

            <th scope="row" rowspan="{{ ($room[$i]->addBed > 0 ? 2 : 1) }}"><?php echo $room[$i]->type ?></th>
            <td rowspan="{{ ($room[$i]->addBed > 0 ? 2 : 1) }}"><?php echo $room[$i]->description ?></td>
            <td>RM{{ $room[$i]->price}}/night</td>
              <td>{{ $room[$i]->pax }}</td>
              <td class="ml-5"><input type="number" min="0" value="0" max="<?php echo $room[$i]->availableNum?>" data-roomId="{{$room[$i]->roomId}}" data-addBedId="0" data-price="{{$room[$i]->price}}" ></td>
            </tr>
            <?php 
            if ($room[$i]->addBed > 0){
            ?>
               <tr>
            <td>RM{{ $room[$i]->price  + ($room[$i]->addBed > 0 ? 30 : 0 ) }}/night</td>
              <td>{{ $room[$i]->pax }}  + {{ $room[$i]->addBed }} bed </td>
              <td class="ml-5"><input type="number" min="0" value="0" max="{{ $room[$i]->availableNum }}" data-roomId="{{$room[$i]->roomId}}" data-addBedId="1" data-price="{{ $room[$i]->price  + ($room[$i]->addBed > 0 ? 30 : 0 ) }}"></td>
             </tr>
            
            
          
        <?php }} ?>
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center mb-3 mt-3">

    
    <a id="bookBtn" class= "btn btn-primary" role="button">Book Now</a>

  </div>
</body>
<script>
  $(document).ready(function () {
    
    $('#bookBtn').click(function() {
    var list = $('#searchResult').find('input');
    var json = [];
    for (var i = 0; i < list.length; i++) {
      var obj = {};
      obj['roomId'] = $(list[i]).attr('data-roomId');
      obj['addBed'] = $(list[i]).attr('data-addBedId');
      obj['num'] = $(list[i]).val();
      obj['price'] = $(list[i]).attr('data-price');
     
      
      json.push(obj);
    }
    console.log(json);
    console.log('hello');
    console.log("{{$arr[0]->hotelId}}");
    console.log("{{$checkInDate}}");
    console.log("{{$checkOutDate}}");
    

    var url ='{{ route("booking") }}';
    url+='?id={{$arr[0]->hotelId}}&cid={{$checkInDate}}&cod={{$checkOutDate}}&adult={{$adult}}&child={{$child}}&room={{$roomList}}&data=' + JSON.stringify(json);
    console.log(url);
    // "{{ session(['booking_check_in' => $checkInDate]) }}";
    // "{{ session(['booking_check_out' => $checkOutDate]) }}";
    // "{{ session(['booking_adult' => $checkInDate]) }}";
    $(location).attr('href', url);
    
  })
  });
  
</script>
@endsection