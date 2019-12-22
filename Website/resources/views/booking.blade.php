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


$data = json_decode($_REQUEST['data']);

$arr = json_decode(SelectController::getHotelInfo($hotelId));
$image = json_decode(ImageController::getImage($hotelId));
$room = json_decode(SelectController::getRoomInfo($hotelId, $checkInDate, $checkOutDate));
print_r($data);
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
    <h2><?php echo $arr[0]->name ?> </h2>
  </div>
  <div class="container mt-5">
    
          <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Room type</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Pax</th>
          
        </tr>
      </thead>
      <tbody id="searchResult">
      
      <?php for ($j = 0; $j < count($data); $j++) { ?>
        <?php for ($i = 0; $i < count($room); $i++) { ?>
          <?php if ($data[$j]->num > 0) { ?>
        <?php if ($room[$i]->roomId == $data[$j]->roomId) { ?>
        
          <tr>

            <th scope="row"><?php echo $room[$i]->type ?></th>
            <td><?php echo $room[$i]->description ?></td>
            <td>RM{{ $room[$i]->price  + ($data[$j]->addBed > 0 ? 30 : 0 ) }}/night</td>
              <td>{{ $room[$i]->pax }}  + {{ $data[$j]->addBed }} bed </td>
              
            </tr>
           
        <?php } ?>
      <?php } ?>
      <?php } ?>
      <?php } ?>
      
      </tbody>
    </table>


         

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

                <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername4" placeholder="1">
              </div>
              <label class="sr-only" for="inlineFormInputGroupUsername2">Pax</label>
              <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
              <div class="input-group mb-2 mr-5">

                Adults
              </div>
              <div class="input-group mb-2 mr-sm-2">

                <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername5" placeholder="1">
              </div>
              <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
              <div class="input-group mb-2 mr-5">

                Children
              </div>
              <div class="input-group mb-2 mr-sm-2">

                <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername5" placeholder="1">
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
                  <label for="inputName">Full Name</label>
                  <input type="text" class="form-control" id="inputName" >
                </div>
                <div class="form-group col-md-6">
                  <label for="inputICNum">IC Number</label>
                  <input type="text" class="form-control" id="inputICNum">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputEmail4">Email</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="form-group col-md-6">
                  <label for="inputRemark">Remarks</label>
                  <input type="text" class="form-control" id="inputRemark">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputPhone">Phone</label>
                  <input type="text" class="form-control" id="inputPhone">
                </div>
              </div>
              
              <div class="container align-self-center">
                <button type="button" class="btn btn-outline-primary" id="bookBtn">Book</button>
              </div>

            </form>
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
        fullName: $('#inputName').val(),
        email: $('#inputEmail4').val(),
        phone: $('#inputPhone').val(),
        icNum: $('#inputICNum').val(),
        checkInDate:formatDate(search_params.get('cid')),
        checkOutDate:formatDate(search_params.get('cod')),
        remark: $('#inputRemark').val(),
        adult: search_params.get('adult'),
        child: search_params.get('child'),
        totalPrice: sum,
        hotelId: search_params.get('id'),
        roomId: idList, // [1,1,2,3]
        addBed: addBedList, // [0,1,0,1]
    }
    console.log(json);
      $.ajax({
      url: "{{ route('createBooking') }}",
      method: "POST",
      data: json,
      success:function(data) {
        if (data === "false") {
          console.log("Book failed");
        } else {
          console.log("Book success");
          console.log(data);
          // $(location).attr('href', '{{ route("confirm") }}');
        }
      },
      error:function(error) {
        console.log('Error: ' + error);
        
      }
    });
    
  })
  });
  function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
}
</script>


</html>