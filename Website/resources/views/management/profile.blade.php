@extends('management.layout')

@section('title')
Profile
@endsection

@section('content')
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
          <input readonly class="form-control-plaintext font-weight-bold" type="text" name="" value="{{ session('management_hotel_name') }}">
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
@endsection