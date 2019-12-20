@extends('management/layout')

@section('title')
Bookings
@endsection

@section('head-extra')
<!-- DataTables-1.10.20 -->
<link rel="stylesheet" href="{{ asset('datatables-1.10.20/datatables.min.css') }}">
<script src="{{ asset('datatables-1.10.20/datatables.min.js') }}" charset="utf-8"></script>

<!-- Moment (For datetimepicker)-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment-with-locales.min.js" charset="utf-8"></script>

<!-- Datetimepicker -->
<link rel="stylesheet" href="{{ asset('css/management/bootstrap-datetimepicker.min.css') }}">
<script src="{{ asset('js/management/bootstrap-datetimepicker.min.js') }}" charset="utf-8"></script>
@endsection

@section('content')
<!-- The Booking Edit Modal -->
<div class="modal" id="editBookingModal">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Booking</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group bg-default text-white p-2 rounded collapsed" data-toggle="collapse" data-target="#editBookingDetailCollapse" 
              aria-expanded="false" aria-controls="editBookingDetailCollapse" style="cursor: pointer;">
            <h6>
              <i class="fa" aria-hidden="true"></i>
              Booking Detail (#<span id="js-modal-booking-id"></span>)
            </h6>
          </div>
          <div class="collapse" id="editBookingDetailCollapse">
            <div class="form-group row">
              <label class="col-4 col-lg-3">Booking Number:</label>
              <div class="col-8 col-lg-9">
                <input readonly class="form-control" type="text" value="" id="editBookingDetailBookingNumber" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Booking Date:</label>
              <div class="col-8 col-lg-9">
                <input readonly class="form-control" value="" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Check-in Date:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" value="" id="check-in-datepicker" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Check-out Date:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" value="" id="check-out-datepicker" />
              </div>
            </div>
            <script type="text/javascript">
              $(function () {
                $('#check-in-datepicker').datetimepicker({
                  format: 'D MMM YYYY'
                });
                $('#check-out-datepicker').datetimepicker({
                  format: 'D MMM YYYY'
                });
              });
            </script>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Guest Name:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="text" value="" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Guest Email:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="email" value="" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Guest Mobile Number:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="tel" value="" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Adult:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="number" min="1" value="" readonly />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Children:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="number" min="0" value="" readonly />
              </div>
            </div>
          </div>
          <hr />
          <div class="form-group bg-default text-white p-2 rounded" data-toggle="collapse" data-target="#editBookingRoomCollapse" 
              aria-expanded="true" aria-controls="editBookingRoomCollapse" style="cursor: pointer;">
            <h6>
              <i class="fa" aria-hidden="true"></i>
              Room Assignment
            </h6>
          </div>
          <div class="show" id="editBookingRoomCollapse">
            <!-- <div class="form-group row mr-0">
              <label class="col-4 col-lg-3 font-weight-bold">Add Room</label>
              <div class="col-8">
                <select class="form-control" id="js-modal-room-type-select">
                </select>
              </div>
              <button class="btn btn-outline-primary col-1" type="button" onclick="addRoom()">
                  <i class="fas fa-plus"></i>
                </button>
            </div> -->
            <!-- <div class="form-group row mr-0">
              <label class="col-4 col-lg-3">Single Room</label>
              <div class="col-8">
                <select class="form-control">
                  <optgroup label="Select Room">
                    <option>601</option>
                    <option>602</option>
                    <option>603</option>
                  </optgroup>
                </select>
              </div>
              <button class="btn btn-outline-danger col-1" type="button" onclick="removeRoom(this)">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="form-group row mr-0">
              <label class="col-4 col-lg-3">Single Room</label>
              <div class="col-8">
                <select class="form-control">
                  <optgroup label="Select Room">
                    <option>601</option>
                    <option>602</option>
                    <option>603</option>
                  </optgroup>
                </select>
              </div>
              <button class="btn btn-outline-danger col-1" type="button" onclick="removeRoom(this)">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="form-group row mr-0">
              <label class="col-4 col-lg-3">Double Room</label>
              <div class="col-8">
                <select class="form-control">
                  <optgroup label="Select Room">
                    <option>601</option>
                    <option>602</option>
                    <option>603</option>
                  </optgroup>
                </select>
              </div>
              <button class="btn btn-outline-danger col-1" type="button" onclick="removeRoom(this)">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
          </div>
          <div class="d-none justify-content-center" id="editBookingRoomSpinner">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="updateBooking(this)">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Booking Edit Modal -->
<div class="container">
  <div class="row">
    <aside class="query-container col-3">
      <div>
        <button id="clear-filter" class="float-right btn btn-link p-0">Clear</button>
        <h5>Filter</h5>
      </div>
      <div class="filter-container">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-check-in-today">
          <label class="form-check-label" for="filter-check-in-today">
            Check-in Today
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-check-out-today">
          <label class="form-check-label" for="filter-check-out-today">
            Check-out Today
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-has-children">
          <label class="form-check-label" for="filter-has-children">
            Has Children
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-added-bed">
          <label class="form-check-label" for="filter-added-bed">
            Added Bed
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-not-assigned">
          <label class="form-check-label" for="filter-not-assigned">
            Not Assigned
          </label>
        </div>
        <div id="filter-room-type">
          <div class="d-flex justify-content-center my-3">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
          <!-- <div class="form-check">
            <input class="form-check-input js-room-type-filter" type="checkbox" value="" id="filter-single-room">
            <label class="form-check-label" for="filter-single-room">
              Single Room
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input js-room-type-filter" type="checkbox" value="" id="filter-double-room">
            <label class="form-check-label" for="filter-double-room">
              Double Room
            </label>
          </div> -->
        </div>
      </div>
    </aside>
    <div class="col-9">
      <p>
        <i class="far fa-clock"></i>
        Data last fetched on:
        <span id="fetch-data-datetime"></span>
      </p>
      <table id="bookings-table" class="table table-hover table-fixed text-center booking-table" width="100%">
        <thead class="thead-light">
          <tr>
            <th>No.</th>
            <th>Booking Date</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Guest Name</th>
            <!-- Hidden Start -->
            <th>Guest Email</th>
            <th>Guest Mobile</th>
            <th>Adult</th>
            <th>Child</th>
            <th>Room</th>
            <th>Remark</th>
            <!-- Hidden End -->
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <td>45690</td>
            <td>12 Oct 2019</td>
            <td>24 Oct 2019</td>
            <td>27 Oct 2019</td>
            <td>Jackson Armstrong</td>
            <td>jackson@hotmail.com</td>
            <td>0123456789</td>
            <td>2 Adult</td>
            <td>2 Child</td>
            <td>
              1x Single Room (603)<br />
              1x Double Room (614)
            </td>
          </tr>
          <tr>
            <td>65690</td>
            <td>13 Oct 2019</td>
            <td>25 Oct 2019</td>
            <td>28 Oct 2019</td>
            <td>Heng Jun Xi</td>
            <td>hengjx@gmail.com</td>
            <td>0142356789</td>
            <td>1 Adult</td>
            <td></td>
            <td>
              1x Single Room (604)
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
function formatExtraBookingDetail ( d ) {
    // `d` is the original data object for the row
    return '<div class="row">'+
              '<div class="col-4 text-left">'+
              '<div class="text-nowrap">'+
                '<i class="fas fa-envelope"></i>&nbsp'+
                '<span>'+d[5]+'</span>'+
              '</div>'+
              '<div class="text-nowrap">'+
                '<i class="fas fa-phone"></i>&nbsp'+
                '<span>'+d[6]+'</span>'+
              '</div>'+
            '</div>'+
            '<div class="col-2 text-left">'+
              '<span class="text-nowrap"><i class="fas fa-child"></i>&nbsp' + d[7] + '</span>'+
              (d[8] 
                ? '<br /><span class="text-nowrap"><i class="fas fa-baby"></i>&nbsp' + d[8] + '</span>'
                : '') +
            '</div>'+
            '<div class="col-5 text-left">'+
              d[9]+
            '</div>'+
            '<div class="col-1">'+
            '<button class="btn btn-outline-primary px-1 py-0" onclick="editBooking(this)"><i class="fas fa-fw fa-edit"></i></button>'+
            '<button class="btn btn-outline-danger px-1 py-0" onclick="deleteBooking(this)"><i class="fas fa-fw fa-trash"></i></button>'+
            '</div>'+
          '</div>'+
          (d[10] == '' 
            ? ''
            : '<div class="text-left">'+
            '<span class="font-weight-bold">Remark:&nbsp;</span><span>'+d[10]+'</span>'+
          '</div>');
}

function applyCumulativeFilter(filterList, column, filterControl, item) {
  if (filterControl.checked) {
    filterList.push(item);
  } else {
    var index = filterList.indexOf(item);
    if (index != -1) filterList.splice(index, 1);
  }
  var filterText = '';
  for (var i = 0; i < filterList.length; i++) {
    filterText += filterList[i] + ' ';
  }
  column.search(filterText).draw();
}

function addRoom() {
  var html = '<div class="form-group row mr-0">'+
                '<label class="col-4 col-lg-3">'+
                  $('#js-modal-room-type-select option:selected').text()+
                '</label>'+
                '<div class="col-8">'+
                  '<select class="form-control">'+
                    '<optgroup label="Select Room">'+
                      '<option>601</option>'+
                      '<option>602</option>'+
                      '<option>603</option>'+
                    '</optgroup>'+
                  '</select>'+
                '</div>'+
                '<button class="btn btn-outline-danger col-1" type="button" onclick="removeRoom(this)">'+
                  '<i class="fas fa-times"></i>'+
                '</button>'+
              '</div>';
  $('#editBookingRoomCollapse').append(html);
}

function removeRoom(element) {
  $(element).closest('.form-group').remove();
}

function editBooking(element) {

  // TODO: populate edit modal
  var tr = $(element).closest('tr').prev();
  var row = $('#bookings-table').DataTable().row( tr );
  var data = row.data();
  $('#js-modal-booking-id').text(data[0]);
  $('#editBookingModal').find('input').each(function(index, element) {
    if (index === 7)
      $(element).val(data[index].slice(0, data[index].indexOf(' Adult')));
    else if (index === 8) {
      if (data[index])
        $(element).val(data[index].slice(0, data[index].indexOf(' Child')));
      else
        $(element).val(0);
    } else 
      $(element).val(data[index]);
  });
  var bookingNum = data[0];
  // show loading
  $('#editBookingRoomCollapse').css('display', 'none');
  $('#editBookingRoomSpinner').addClass('d-flex');
  $.ajax({
    url: "{{ route('management/getAvailableRoomNo') }}",
    method: "GET",
    data: {
      _token: "{{ csrf_token() }}",
      hotelId: "{{ session('management_hotel_id') }}",
      checkInDate: moment(data[2]).format('YYYY-MM-DD'),
      checkOutDate: moment(data[3]).format('YYYY-MM-DD'),
    },
    success:function(data) {
      var json = JSON.parse(data);
      var res = {};
      console.log(json);
      for (var i = 0; i < json.length; i++) {
        if (res.hasOwnProperty(json[i]['roomId'])) {
          res[json[i]['roomId']]['rooms'].push(json[i]['roomNum']);
        } else {
          res[json[i]['roomId']] = {
            type: json[i]['type'],
            price: json[i]['price'],
            addBed: json[i]['addBed'],
            rooms:[
              json[i]['roomNum']
            ]
          };
          // $('#js-modal-room-type-select').append('<option value='+json[i]['roomId']+'>'+json[i]['type']+'</option>');
        } 
      }
      // var list = $('#editBookingRoomCollapse select');
      // for (var i = 0; i < list.length; i++) {
      //   var html = '';
      //   var arr = res[$(list[i]).attr('data-roomId')]['rooms'];
      //   for (var j = 0; j < arr.length; j++)
      //     html += '<option>' + arr[j] + '</option>';
      //   $(list[i]).append(html);
      // }

      // console.log(list);
      // console.log(res);
      $.ajax({
        url: "{{ route('management/getBookingRoom') }}",
        method: "GET",
        data: {
          _token: "{{ csrf_token() }}",
          bookingNum: bookingNum
        },
        success:function(data) {
          var json = JSON.parse(data);
          var html = '';
          for (var i = 0; i < json.length; i++) {
            html += '<div class="form-group row mr-0">'+
                  '<label class="col-4 col-lg-4 font-weight-bold">'+json[i]['type']+(json[i]['addBed']>0?'&nbsp;+&nbsp;<i class="fas fa-bed"></i>':'')+'</label>'+
                  '<div class="col-8">'+
                    '<select class="form-control" data-roomId="'+json[i]['roomId']+'" data-no="'+json[i]['no']+'">'+
                      // (json[i]['roomNum'] == null
                        '<option>N/A</option>'+
                        // : '<option value='+json[i]['roomNum']+'>'+json[i]['roomNum']+'</option>')+
                    '</select>'+
                  '</div>'+
                '</div>';
          }
          console.log(json);
          console.log(res);
          for (var i = 0; i < json.length; i++) {
            if (json[i]['roomNum'] != null)
              res[json[i]['roomId']]['rooms'].push(json[i]['roomNum']);
          }
          $('#editBookingRoomCollapse').html(html);
          $('#editBookingRoomCollapse select').each(function(index) {
            var roomId = $(this).attr('data-roomId');
            var list = res[roomId]['rooms'];
            var html = '';
            for (var i = 0; i < list.length; i++) {
              html += '<option value='+list[i]+'>'+list[i]+'</option>';
            }
            $(this).append(html);
            if (json[index]['roomNum'] != null) {
              // $(this).prepend("<option value="+json[index]['roomNum']"+>"+json[index]['roomNum']+"</option>");
              // $(this).prepend("<option value="+json[index]['roomNum']+">"+json[index]['roomNum']+"</option>");
              $(this).val(json[index]['roomNum']);
            }
          });
          // initialise
          var selected = [];
          $('#editBookingRoomCollapse select').each(function() {
            $(this).find('option').prop('hidden', false);     // reset all to visible
            selected.push($(this).val());                     // record all selected into array
          });
          $('#editBookingRoomCollapse select').each(function() {
            for (var i = 0; i < selected.length; i++) {
              if ($(this).val() != selected[i])
                $(this).find('option[value="'+selected[i]+'"]').prop('hidden', true); // hide if selected
            }
          });
          // end initialise 
          $('#editBookingRoomCollapse select').change(function() {
            selected = [];                                      // reset array
            $('#editBookingRoomCollapse select').each(function() {
              $(this).find('option').prop('hidden', false);     // reset all to visible
              selected.push($(this).val());                     // record all selected into array
            });
            $('#editBookingRoomCollapse select').each(function() {
              for (var i = 0; i < selected.length; i++) {
                if ($(this).val() != selected[i])
                  $(this).find('option[value="'+selected[i]+'"]').prop('hidden', true); // hide if selected
              }
            });
          });
          $('#editBookingRoomCollapse').css('display', 'block');
          $('#editBookingRoomSpinner').removeClass('d-flex');
          $('#editBookingRoomSpinner').addClass('d-none');
        },
        error:function(error, a, b) {
          console.log('Error: ' + error);
          console.log('Error: ' + a);
          console.log('Error: ' + b);
          // $(element).prop("disabled", false);
        }
      });
    },
    error:function(error, a, b) {
      console.log('Error: ' + error);
      console.log('Error: ' + a);
      console.log('Error: ' + b);
    }
  });
  
  // TODO: show edit modal
  $("#editBookingModal").modal('toggle');
  $('#editBookingDetailCollapse').collapse('hide');
  $('#editBookingRoomCollapse').collapse('show');
}

function deleteBooking(element) {
  $(element).prop("disabled", true);
  var tr = $(element).closest('tr').prev();
  var row = $('#bookings-table').DataTable().row( tr );
  var data = row.data();
  var url = "{{ route('management/hotel/booking/delete', [session('management_hotel_id'), ':bookingNum']) }}";
  url = url.replace(':bookingNum',data[0]);
  $.ajax({
    url: url,
    method: "POST",
    data: {
      _token: "{{ csrf_token() }}"
    },
    success:function(data) {
      if (data === "true") {
        console.log("Delete booking success");
        $('#bookings-table').DataTable().ajax.reload();
        $('#fetch-data-datetime').text(new Date().toLocaleString('en-GB', { dateStyle: 'full', timeStyle: 'full' }));
      } else {
        console.log("Delete booking failed");
      }
      $(element).prop("disabled", false);
    },
    error:function(error) {
      console.log('Error: ' + error);
      $(element).prop("disabled", false);
    }
  });
  $('#js-modal-booking-id').text(data[0]);
}

$(document).ready( function () {
  var filter = [];
  $.ajax({
    url: "{{ route('management/hotel/roomTypes', session('management_hotel_id')) }}",
    method: "GET",
    success:function(data) {
      var json = JSON.parse(data);
      console.log(json['data']);
      console.log('Get room types successfully.');
      var res = "";
      for (var i = 0; i < json['data'].length; i++) {
        var type = json['data'][i][0];
        var text = '<div class="form-check">'+
            '<input class="form-check-input js-room-type-filter" type="checkbox" value="" id="filter-'+type+'">'+
            '<label class="form-check-label" for="filter-'+type+'">'+
              type+
            '</label>'+
          '</div>';
        res += text;
      }
      $('#filter-room-type').html(res);
      $('.js-room-type-filter').each(function(index, element) {
        $(this).change(function() {
          applyCumulativeFilter(filter, table.column(9), element, $(this).next().text().trim());
        });
      });
    },
    error:function(error) {
        console.log('Error: ' + error);
    }
  });
  $('#fetch-data-datetime').text(new Date().toLocaleString('en-GB', { dateStyle: 'full', timeStyle: 'full' }));
  var table = $('#bookings-table').DataTable({
    createdRow: function( row, data, dataIndex ) {
      $(row).addClass( 'js-bookings-td' );
    },
    language: {
      searchPlaceholder: "Booking # / Room # / Guest Name",
      loadingRecords: '<div class="d-flex justify-content-center my-3"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
      // '<span class="sr-only text-primary">Loading...</span> ',
    },
    ajax: '{{ route("management/hotel/bookings", session("management_hotel_id")) }}',
    columns: [
      null, 
      { searchable: false }, 
      null, 
      null,
      { orderable: false, },
      { orderable: false, visible: false, searchable: false },
      { orderable: false, visible: false, searchable: false },
      { orderable: false, visible: false, searchable: false },
      { orderable: false, visible: false },
      { orderable: false, visible: false },
      { orderable: false, visible: false, searchable: false },
    ],
    order: [[0, 'desc']]
  });
  $('#bookings-table').on('click', '.js-bookings-td', function () {
      var tr = $(this).closest('tr');
      var row = table.row( tr );

      if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
          // Open this row
          row.child( formatExtraBookingDetail(row.data()) ).show();
          tr.addClass('shown');
      }
  });
  
  

  $('#filter-check-in-today').change(function() { 
    const date = new Date().toLocaleString('en-GB', { dateStyle: 'medium'});
    if (this.checked) {
      table.column(2).search(date, false, false).draw();
    } else {
      table.column(2).search('').draw();
    }
  });
  $('#filter-check-out-today').change(function() { 
    const date = new Date().toLocaleString('en-GB', { dateStyle: 'medium'});
    if (this.checked) {
      table.column(3).search(date, false, false).draw();
    } else {
      table.column(3).search('').draw();
    }
  });
  $('#filter-has-children').change(function() {
    if (this.checked) {
      table.column(8).search('child').draw();
    } else {
      table.column(8).search('').draw();
    }
  });
  $('#filter-added-bed').change(function() {
    applyCumulativeFilter(filter, table.column(9), this, ' + ');
  });
  $('#filter-not-assigned').change(function() {
    applyCumulativeFilter(filter, table.column(9), this, 'N/A');
  });
  $('#clear-filter').click(function() {
    table.column(2).search('');
    table.column(3).search('');
    table.column(8).search('');
    table.column(9).search('');
    table.draw();
    $('#filter-check-in-today').prop('checked', false);
    $('#filter-check-out-today').prop('checked', false);
    filter = [];
    $('.js-room-type-filter').each(function() {
      $(this).prop('checked', false);
    });
    $('#filter-has-children').prop('checked', false);
  });
} );
function updateBooking(element) {
  $(element).prop('disabled', true);
  console.log('fire');
  console.log(element);
  var list = $('#editBookingRoomCollapse').find('select');
  var no = [];
  var roomNum = [];
  for (var i = 0; i < list.length; i++) {
    no.push($(list[i]).attr('data-no'));
    var value = $(list[i]).val();
    roomNum.push( ( value === 'N/A' ? null : value) );
    console.log($(list[i]).attr('data-no'));
    console.log(( value === 'N/A' ? null : value));
  }
  $.ajax({
    url: "{{ route('management/updateBooking') }}",
    method: "POST",
    data: {
      _token: "{{ csrf_token() }}",
      hotelId: "{{ session('management_hotel_id') }}",
      bookingNum: $('#editBookingDetailBookingNumber').val(),
      checkInDate: moment($('#check-in-datepicker').val()).format('YYYY-MM-DD'),
      checkOutDate: moment($('#check-out-datepicker').val()).format('YYYY-MM-DD'),
      no: no,
      roomNum: roomNum,
    },
    success:function(data) {
      console.log('Update booking successfully.');
      $(element).prop('disabled', false);
      $('#editBookingModal').modal('toggle');
      $('#bookings-table').DataTable().ajax.reload();
      $('#fetch-data-datetime').text(new Date().toLocaleString('en-GB', { dateStyle: 'full', timeStyle: 'full' }));
    },
    error:function(error) {
      console.log('Error: ' + error);
      $(element).prop('disabled', false);
    }
  });
}
</script>
@endsection