@extends('management/layout')

@section('title')
Book
@endsection

@section('head-extra')
<!-- Moment (For datetimepicker)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" charset="utf-8"></script>

<!-- Datetimepicker -->
<link rel="stylesheet" href="{{ asset('css/management/bootstrap-datetimepicker.min.css') }}">
<script src="{{ asset('js/management/bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>
@endsection

@section('content')
<!-- The Modal -->
<div class="modal" id="bookModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Guest Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="bookForm">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Full Name</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input class="form-control" value="" placeholder="Full name" 
                                    id="inputFullName" name="fullName" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Guest Email</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input class="form-control" value="" placeholder="Guest email" 
                                    id="inputGuestEmail" name="guestEmail" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Phone Number</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input class="form-control" value="" placeholder="Phone number" 
                                    id="inputPhoneNumber" name="phoneNumber" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>IC Number</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input class="form-control" value="" placeholder="IC number" 
                                    id="inputICNumber" name="icNumber" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Booking Remark</label>
                        <textarea class="form-control" rows="4" cols="80" id="inputRemark"
                            placeholder="Booking remark" name="remark"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label class="h4">Total Price:</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <span class="h4" id="modalTotalPrice"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <span id='editRoomTypeModalValidator'></span>
                    </div>
                    <button type="submit" class="btn btn-primary" id="confirmBookingBtn">Confirm booking</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-12 col-lg-4">
      <div class="form-group">
        <label class="font-weight-bold">When</label>
        <form class="form-inline" id="searchForm">
          @csrf
          <input readonly hidden class="form-control" name="hotelId" value="{{ session('management_hotel_id')}}" />
          <div>
            <input class="form-control" id="inputCheckIn" name="checkInDate" style="width: 128px;" />
          </div>
          <label class="mx-2">To</label>
          <div>
            <input class="form-control" id="inputCheckOut" name="checkOutDate" style="width: 128px;" />
          </div>
          <script type="text/javascript">
            $(function () {
              var now = moment().startOf('day');
              var tomorrow = moment().startOf('day').add(1, 'day');
              $('#inputCheckIn').datetimepicker({
                format: "D MMM YYYY",
                minDate: now,
                defaultDate: now,
              });
              $('#inputCheckOut').datetimepicker({
                format: "D MMM YYYY",
                defaultDate: tomorrow,
                minDate: tomorrow,
              });
              $('#inputCheckIn').on('dp.change', function(e){ 
                var checkOut = $('#inputCheckOut').data("DateTimePicker");
                if (e.date.isSameOrAfter(checkOut.date()))
                  checkOut.clear();
                checkOut.minDate(e.date.add(1, 'day'));
               });
            });
          </script>
        </form>
      </div>
    </div>
    <div class="col-9 col-lg-6">
      <div class="form-group">
        <label class="font-weight-bold">Who</label>
        <div class="form-inline">
          <input type="number" class="form-control" id="inputAdult" min="1" value="1" name="adult" style="width: 64px;">
          <label class="ml-2 mr-4">Adults</label>
          <input type="number" class="form-control" id="inputChildren" min="0" value="0" name="children" style="width: 64px;">
          <label class="ml-2 mr-4">Children</label>
          <input type="number" class="form-control" id="inputRoom" min="1" value="1" name="room" style="width: 64px;">
          <label class="ml-2 mr-4">Rooms</label>
        </div>
      </div>
    </div>
    <div class="col-3 col-lg-2">
      <div class="form-group">
        <label>&nbsp;</label>
        <div class="form-inline justify-content-end">
          <button class="btn btn-default" id="searchBtn">
            <i class="fas fa-search fa-fw"></i>&nbsp;
            Search
          </button>
        </div>
      </div>
    </div>
  </div>
  <div class="d-none justify-content-center my-5" id="loadingSpinner">
    <div class="spinner-border text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <div class="mt-5" id="resultTable" style="display: none;">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Room type</th>
          <th scope="col">Description</th>
          <th scope="col">Pax</th>
          <th scope="col">Price</th>
          <th scope="col">Number of Rooms</th>
        </tr>
      </thead>
      <tbody id="searchResult">
        
      </tbody>
    </table>
    <div class="d-flex justify-content-end">
      <div class="form-group">
        <span class="text-danger" id="bookValidator"></span>
      </div>
    </div>
    <div class="d-flex justify-content-end align-items-center mb-5">
      <div class="form-group">
        <span class="h4" id="totalPrice"></span>
      </div>
      <div class="form-group ml-5">
        <button class="btn btn-primary" id="bookBtn">Book now</button>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $('#searchBtn').click(function() {
    $('#searchBtn').prop("disabled", true);
    $('#resultTable').css('display', 'none');
    $('#loadingSpinner').addClass('d-flex');
    $.ajax({
      url: "{{ route('roomAvailable') }}",
      method: "POST",
      data: $('#searchForm').serialize(),
      success:function(data) {
        if (data === "false") {
          console.log("Search failed");
        } else {
          console.log("Search success");
          var html = '';
          var json = JSON.parse(data);
          console.log(json);
          for (var i = 0; i < json.length; i++) {
            html += '<tr>';
            html += '<td class="font-weight-bold">' + json[i]['type'] + '</td>';
            html += '<td>' + json[i]['description'] + '</td>';
            html += '<td class="text-center">' + json[i]['pax'] + '</td>';
            html += '<td>' + 'RM' + json[i]['price'] + '/night' + '</td>';
            html += '<td><input class="form-control" type="number" min="0" max="' + json[i]['availableNum'] + '" value="0" style="width: 128px;" data-roomId="' + json[i]['roomId'] + '" data-addBed="0" data-price="'+json[i]['price']+'" onchange="updateTotal()" />';
            html += '</tr>';
            if (json[i]['addBed'] > 0) {
              html += '<tr>';
              html += '<td class="font-weight-bold">' + json[i]['type'] + '</td>';
              html += '<td>' + json[i]['description'] + '</td>';
              html += '<td class="text-center">' + json[i]['pax'] + '+' + json[i]['addBed'] + '&nbsp;<i class="fas fa-bed"></i>' + '</td>';
              html += '<td>' + 'RM' + (json[i]['price'] + 30) + '/night' + '</td>';
              html += '<td><input class="form-control" type="number" min="0" max="' + json[i]['availableNum'] + '" value="0" style="width: 128px;" data-roomId="' + json[i]['roomId'] + '" data-addBed="1" data-price="'+(json[i]['price'] + 30)+'" onchange="updateTotal()" />';
              html += '</tr>';
            }
          }
          $('#resultTable').css('display', 'block');
          $('#searchResult').html(html);
        }
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#searchBtn').prop("disabled", false);
      },
      error:function(error) {
        console.log('Error: ' + error);
        $('#loadingSpinner').removeClass('d-flex');
        $('#loadingSpinner').addClass('d-none');
        $('#searchBtn').prop("disabled", false);
      }
    });
  });
  $('#bookBtn').click(function() {
    var list = $('#searchResult').find('input');
    var num = 0;
    for (var i = 0; i < list.length; i++) {
      num += parseInt($(list[i]).val());
    }
    console.log(num);
    
    var room = $('#inputRoom').val();
    if (room == 0) {
      $('#inputRoom').focus();
      $('#bookValidator').text('Please specify the number of rooms to book');
      return;
    }

    if (num != room) {
      $('#bookValidator').text('Please select ' + room + ' room(s)');
      return;
    }
    $('#modalTotalPrice').text($('#totalPrice').text());
    $('#bookModal').modal('toggle');
  });
  $('#confirmBookingBtn').click(function() {
    $('#confirmBookingBtn').prop("disabled", true);
    var list = $('#searchResult').find('input');
    var sum = 0;
    var idList = [];
    var addBedList = [];
    for (var i = 0; i < list.length; i++) { 
      var num = $(list[i]).val();
      sum += $(list[i]).attr('data-price') * num;
      for (var j = 0; j < num; j++) {
        idList.push($(list[i]).attr('data-roomId'));
        addBedList.push($(list[i]).attr('data-addBed'));
      }
    }
    // var checkInDate = new Date ($('#inputCheckIn').val());
    // checkInDate.setDate(checkInDate.getDate() + 1);
    // var checkOutDate = new Date ($('#inputCheckOut').val());
    // checkOutDate.setDate(checkOutDate.getDate() + 1);
    var json = {
        _token: "{{ csrf_token() }}",
        fullName: $('#inputFullName').val(),
        email: $('#inputGuestEmail').val(),
        phone: $('#inputPhoneNumber').val(),
        icNum: $('#inputICNumber').val(),
        checkInDate: moment($('#inputCheckIn').val()).format('YYYY-MM-DD'),
        checkOutDate: moment($('#inputCheckOut').val()).format('YYYY-MM-DD'),
        remark: $('#inputRemark').val(),
        adult: $('#inputAdult').val(),
        child: $('#inputChildren').val(),
        totalPrice: sum,
        hotelId: '{{ session("management_hotel_id") }}',
        roomId: idList,
        addBed: addBedList,
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
          $(location).attr('href', '{{ route("management/bookings") }}');
        }
        $('#confirmBookingBtn').prop("disabled", false);
      },
      error:function(error) {
        console.log('Error: ' + error);
        
        $('#confirmBookingBtn').prop("disabled", false);
      }
    });
  });
});
function updateTotal() {
  $('#bookValidator').text('')
  var list = $('#searchResult').find('input');
  var sum = 0;
  for (var i = 0; i < list.length; i++) { 
    sum += $(list[i]).attr('data-price') * $(list[i]).val();
  }
  $('#totalPrice').text('RM' + sum + '/night');
}
</script>
@endsection