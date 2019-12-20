@extends('management.layout')

@section('title')
Profile
@endsection

@section('head-extra')
<!-- Moment (For datetimepicker)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" charset="utf-8"></script>

<!-- Datetimepicker -->
<link rel="stylesheet" href="{{ asset('css/management/bootstrap-datetimepicker.min.css') }}">
<script src="{{ asset('js/management/bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>
@endsection

@section('content')

<?php
  use App\Http\Controllers\ImageController;
  $image = json_decode(ImageController::getImage(session('management_hotel_id')));
?>
<div class="">
  <div class="container px-0">
    <div class="row px-0 mx-0">
      <img class="picture-big col-lg-4 col-md-6 col-sm-8 px-0" src="{{ asset($image[0]) }}" alt="hotel" />
      <div class="col-lg-8 col-md-6 col-sm-4 px-0 mx-0">
        <div class="row px-0 mx-0">
          <div class="col-lg-4 col-md-6 px-0 mx-0 d-flex d-sm-block">
            <img class="picture-small col-6 col-sm-12 px-0" src="{{ asset($image[1]) }}" alt="hotel" />
            <img class="picture-small col-6 col-sm-12 px-0" src="{{ asset($image[2]) }}" alt="hotel" />
          </div>
          <div class="col-lg-4 col-md-6 px-0 d-none d-md-block">
            <img class="picture-small col-sm-12 px-0" src="{{ asset($image[3]) }}" alt="hotel" />
            <img class="picture-small col-sm-12 px-0" src="{{ asset($image[4]) }}" alt="hotel" />
          </div>
          <div class="col-md-4 px-0 d-none d-lg-block">
            <img class="picture-small col-12 px-0" src="{{ asset($image[5]) }}" alt="hotel" />
            <img class="picture-small col-12 px-0" src="{{ asset($image[6]) }}" alt="hotel" />
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
    <form id="update-profile-form">
      @csrf
      <div class="d-flex align-items-center">
        <h1>{{ $hotel->name }}</h1>
        <div class="ml-5">
          <?php
            $remain = 5 - $hotel->star;
            for ($i=0; $i < $hotel->star; $i++) {
              echo '<img src='.asset('images/icons/filled_star.png').' style="width: 24px;" />';
            }
            for ($i=0; $i < $remain; $i++) {
              echo '<img src='.asset('images/icons/empty_star.png').' style="width: 24px;" />';
            }
          ?>
        </div>
      </div>
      <h5 class="" for=""><i class="far fa-clock"></i>&nbsp;Open {{ $hotel->operationTime }}</h5>
      <div class="my-3">
        <h6>Hotel Facilities</h6>
        <div>
          <?php
            use App\Http\Controllers\SelectController;
            $hotelInfo = json_decode(SelectController::getHotelInfo($hotel->hotelId));
            // print_r($hotelInfo[0]);
            foreach($hotelInfo[0] as $attr => $value) {
              if ($value == 1 && $attr!="hotelId"&&$attr!="star"&&$attr!="description"&&$attr!="operationTime"&&$attr!="name"&&$attr!="city"&&$attr!="address")
                echo '<img class="m-2" src="' . asset('images/icons/'.$attr.'.png') . 
                  '" alt="'.$attr.'" data-toggle="tooltip" data-placement="bottom" title="'.$attr.'" style="width: 32px;" />';
            }
          ?>
        </div>
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="">Address</label>
        <input readonly class="form-control-plaintext" type="text" value="{{ $hotel->address }}">
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="">City</label>
        <input readonly class="form-control-plaintext" type="text" value="{{ $hotel->city }}">
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label class="font-weight-bold" for="check-in-timepicker">Check-in Time</label>
          <input type="text" class="form-control" name='check-in-time' id="check-in-timepicker" placeholder="Hotel check-in time">
        </div>
        <div class="form-group col-md-6">
          <label class="font-weight-bold" for="check-out-timepicker">Check-out Time</label>
          <input type="text" class="form-control" name='check-out-time' id="check-out-timepicker" placeholder="Hotel check-out time">
        </div>
        <script type="text/javascript">
          $(function () {
            $('#check-in-timepicker').datetimepicker({
              format: 'HH:mm',
              defaultDate: moment()
                .hours('{{ date_parse($hotel->checkInTime)["hour"] }}')
                .minutes('{{ date_parse($hotel->checkInTime)["minute"] }}')
            });
            $('#check-out-timepicker').datetimepicker({
              format: 'HH:mm',
              defaultDate: moment()
                .hours('{{ date_parse($hotel->checkOutTime)["hour"] }}')
                .minutes('{{ date_parse($hotel->checkOutTime)["minute"] }}')
            });
          });
        </script>
      </div>
      <div class="form-group">
        <label class="font-weight-bold" for="hotel-description">Description</label>
        <textarea class="form-control" name="description" rows="8" cols="80" id="hotel-description" 
          placeholder="Hotel description">{{ $hotel->description }}</textarea>
      </div>
      <div class="form-group">
        <span id="update-profile-validator"></span>
      </div>
      <div class="row">
        <div class="col-12">
          <button id="update-profile-btn" class="btn btn-default float-right">
            <i class="fas fa-pen fa-fw"></i>&nbsp;
            Update
          </button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
$(document).ready($(function () {
  $('[data-toggle="tooltip"]').tooltip();
}));
$('#update-profile-form').on('submit', function(e) {
  e.preventDefault();
  $('#update-profile-btn').prop('disabled', true);
  var error = '';
  if ( !$('#hotel-description').val() ) {
    error = "Description cannot be empty";
  }
  if ( !$('#check-out-timepicker').val() ) {
    error = "Check-out time cannot be empty";
  }
  if ( !$('#check-in-timepicker').val() ) {
    error = "Check-in time cannot be empty";
  }
  
  if (error !== '') {
    $('#update-profile-validator').css('color', 'red');;
    $('#update-profile-validator').html(error);
    $('#update-profile-btn').prop('disabled', false);
  } else {
    $.ajax({
      url: "{{ route('management/update-profile') }}",
      method: "POST",
      data: $('#update-profile-form').serialize(),
      success:function(data) {
        var html = '';
        if (data['status'] === true) {
          console.log('Profile updated successfully');
          $('#update-profile-validator').css('color', 'green');
          html = 'Profile updated successfully';
        } else {
          console.log('Failed: ' + data['error']);
          $('#update-profile-validator').css('color', 'red');;
          html = data['error'];
        }
        $('#update-profile-validator').html(html);
        $('#update-profile-btn').prop('disabled', false);
      },
      error:function(jqxhr, textStatus, error) {
        console.log('Error: ' + error);
        $('#update-profile-btn').prop('disabled', false);
      }
    });
  }
});
</script>
@endsection