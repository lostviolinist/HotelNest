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
<!-- The Modal -->
<!-- <div class="modal" id="myModal" data-backdrop="static" data-keyboard="false" data-show="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body text-center">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="spinner-border text-default" role="status">
          <span class="sr-only">Loading...</span>
        </div>
        <h5 class="mt-2">Processing...</h5>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#myModal').modal({
    backdrop: 'static',
    keyboard: false
  })
</script> -->
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
                <input readonly class="form-control" type="text" value="" />
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
                <input class="form-control" type="text" value="" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Guest Email:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="email" value="" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Guest Mobile Number:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="tel" value="" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Adult:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="number" min="0" value="" />
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-lg-3">Children:</label>
              <div class="col-8 col-lg-9">
                <input class="form-control" type="number" min="0" value="" />
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
            <div class="form-group row mr-0">
              <label class="col-4 col-lg-3 font-weight-bold">Add Room</label>
              <div class="col-8">
                <select class="form-control" id="js-modal-room-type-select">
                  <optgroup label="Select Room Type">
                    <option>Single Room</option>
                    <option>Double Room</option>
                    <option>Quadruple Room</option>
                  </optgroup>
                </select>
              </div>
              <button class="btn btn-outline-primary col-1" type="button" onclick="addRoom()">
                  <i class="fas fa-plus"></i>
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
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End Booking Edit Modal -->
<div class="container">
  <div class="row">
    <aside class="query-container col-3">
      <div class="search-container">
        <div class="form-group">
          <label for="sel1" class="h5">Search</label>
          <select class="form-control" id="sel1">
            <option>Booking Number</option>
            <option>Room Number</option>
            <option>Guest Name</option>
          </select>
        </div>
        <div class="form-group">
          <input class="form-control" type="text" name="" value="" placeholder="Query">
        </div>
        <div class="form-group row">
          <div class="col-12">
            <button type="button" name="button" class="btn btn-default float-right"  data-toggle="modal" data-target="#myModal">
              <i class="fas fa-search fa-fw"></i>&nbsp;
              Search
            </button>
          </div>
        </div>
      </div>
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
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-has-children">
          <label class="form-check-label" for="filter-has-children">
            Has Children
          </label>
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
            <!-- Hidden End -->
          </tr>
        </thead>
        <tbody>
          <tr>
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
          </tr>
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
            '<button class="btn btn-outline-danger px-1 py-0"><i class="fas fa-fw fa-trash"></i></button>'+
            '</div>'+
          '</div>';
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
                  $('#js-modal-room-type-select').val()+
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
  console.log(element);
  console.log($(element));
  console.log($(element).closest('.form-group'));
  $(element).closest('.form-group').remove();
}

function editBooking(element) {
  // console.log(element);
  // console.log($(element));
  // TODO: fetch latest data (refresh) ?
  // TODO: search the booking number / id ?
  // TODO: expand the row (show extra detail) ?
  
  // TODO: check last edit date

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
  // TODO: show edit modal
  $("#editBookingModal").modal('toggle');
  $('#editBookingDetailCollapse').collapse('hide');
  $('#editBookingRoomCollapse').collapse('show');
}

$(document).ready( function () {
  $('#fetch-data-datetime').text(new Date().toLocaleString('en-GB', { dateStyle: 'full', timeStyle: 'full' }));
  var table = $('#bookings-table').DataTable({
    language: {
      searchPlaceholder: "Booking # / Room # / Guest Name"
    },
    ajax: '{{ route("management/hotel/bookings", 1) }}',
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
    ],
    order: [[0, 'desc']]
  });
  $('#bookings-table').on('click', 'tbody tr td', function () {
    console.log("fire");
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
  
  var filter = [];
  $('.js-room-type-filter').each(function(index, element) {
    $(this).change(function() {
      applyCumulativeFilter(filter, table.column(9), element, $(this).next().text().trim());
    });
  });

  $('#filter-check-in-today').change(function() { 
    const date = new Date().toLocaleString('en-GB', { dateStyle: 'medium'});
    if (this.checked) {
      table.column(2).search(date).draw();
    } else {
      table.column(2).search('').draw();
    }
  });
  $('#filter-check-out-today').change(function() { 
    const date = new Date().toLocaleString('en-GB', { dateStyle: 'medium'});
    if (this.checked) {
      table.column(3).search(date).draw();
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
</script>
@endsection