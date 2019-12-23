<!DOCTYPE html>
<html lang="en">

<?php

use App\Http\Controllers\SelectController;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;

$checkInDate =  $_REQUEST['cid'];
$checkOutDate =  $_REQUEST['cod'];
$hotelId = $_REQUEST['id'];
$adult =  $_REQUEST['adult'];
$child =  $_REQUEST['child'];
$room =  $_REQUEST['room'];
$roomList =  $_REQUEST['room'];


$data = json_decode($_REQUEST['data']);

$arr = json_decode(SelectController::getHotelInfo($hotelId));
$image = json_decode(ImageController::getImage($hotelId));
$room = json_decode(SelectController::getRoomInfo($hotelId, $checkInDate, $checkOutDate));

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="{{ asset('jquery-3.4.1/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <title>Booking Confirmed!</title>
</head>

<body>
    <div class="container-fluid mt-3">
        <section class="row">
            <div class="col-md-8">
                <h1 class="title"><a href="{{ route('mainhome') }}">HotelNest</a></h1>
            </div>
            <div class="col-md-4">
                <div class=" float-right" role="group">
                    <a class="btn btn-secondary btn-md  mr-3" style="background-color: #586BA4;" href="#"> Register </a>
                    <a class="btn btn-md btn-outline-secondary" style="border-color: #586BA4;" href="#"> Sign In </a>
                </div>
            </div>
        </section>
    </div>

    <div class="card mt-5 container shadow-sm" style="width: 30rem;">
        <div class="card-body">
            <h4 class="card-title pl-2" ;> Your booking is confirmed!</h4>
            <h5 class="card-title pl-2" style="color: #586BA4;"> <?php echo $arr[0]->name ?></h5>
            <h6 class="card-subtitle mb-2 pl-2 text-muted"></h6>
            <p class="card-text pl-2"><?php print_r($checkInDate) ?> to <?php print_r($checkOutDate) ?> <br>
            <?php print_r($adult) ?> Adult and <?php print_r($child) ?> Children <br><br><br>
            <?php print_r($data->fullName) ?> <br>
            <?php print_r($data->email) ?>     <br>
            <?php print_r($data->phone) ?> <br>
            <?php print_r($data->icNum) ?><br>
            <?php print_r($data->remark) ?><br><br><br><br><br><br><br><br>
            </p>

        </div>
    </div>
</body>
<script>
      $(document).ready(function () {
    $('#bookBtn').click(function() {
      var sum = 0;
    
    var url = new URL(window.location.href);

var search_params = new URLSearchParams(url.search); 

// iterate over the query parameters
for(var i of search_params) {
	// i an an array
	// i[0] => name 
	// i[1] => value
	console.log(i[0] + ' : ' + i[1]);
}
      var data = JSON.parse(search_params.get('data'));
      var idList = [];
      var addBedList=[];
      var sum = 0;
      for (var i=0; i<data.length; i++){
        if (data[i]['num'] > 0) {
          idList.push(data[i]['roomId']);
        addBedList.push(data[i]['addBed']);
        sum += parseInt(data[i]['price']) * parseInt(data[i]['num']);
        }
        
      }

      var json = {
        _token: "{{ csrf_token() }}",
        fullName: search_params.get('fullName'),
        email: search_params.get('email'),
        phone: search_params.get('phone'),
        icNum: search_params.get('icNum'),
        checkInDate:formatDate(search_params.get('cid')),
        checkOutDate:formatDate(search_params.get('cod')),
        remark: search_params.get('remark'),
        adult: search_params.get('adult'),
        child: search_params.get('child'),
        totalPrice: sum,
        hotelId: search_params.get('id'),
        roomId: JSON.stringify(idList), // [1,1,2,3]
        addBed: JSON.stringify(addBedList), // [0,1,0,1]
    }
    console.log(json);
      
    
  })
  });
    
</script>

</html>
