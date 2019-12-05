@extends('management/layout')

@section('title')
Bookings
@endsection

@section('head-extra')
<!-- DataTables-1.10.20 -->
<link rel="stylesheet" href="{{ asset('datatables-1.10.20/datatables.min.css') }}">
<script src="{{ asset('datatables-1.10.20/datatables.min.js') }}" charset="utf-8"></script>
@endsection

@section('content')
<!-- The Modal -->
<div class="modal" id="myModal" data-backdrop="static" data-keyboard="false" data-show="false">
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
</script>
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
        <a href="#" id="clear-filter" class="float-right">Clear</a>
        <h5>Filter</h5>
      </div>
      <div class="filter-container">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-check-in-today">
          <label class="form-check-label" for="filter-check-in-today">
            Check-in today
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-check-out-today">
          <label class="form-check-label" for="filter-check-out-today">
            Check-out today
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input js-room-type-filter" type="checkbox" value="" id="filter-single-room">
          <label class="form-check-label" for="filter-single-room">
            Single room
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input js-room-type-filter" type="checkbox" value="" id="filter-double-room">
          <label class="form-check-label" for="filter-double-room">
            Double room
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="filter-has-children">
          <label class="form-check-label" for="filter-has-children">
            Has children
          </label>
        </div>
      </div>
    </aside>
    <div class="col-9">
      <table id="bookings-table" class="table table-hover table-fixed text-center booking-table" width="100%">
        <thead class="thead-light">
          <tr>
            <th>No.</th>
            <th>Booking Date</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Guest Name</th>
            <th>Guest Email</th>
            <th>Guest Mobile</th>
            <th>Adult</th>
            <th>Child</th>
            <th>Room</th>
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
                d[5]+
              '</div>'+
              '<div class="text-nowrap">'+
                '<i class="fas fa-phone"></i>&nbsp'+
                d[6]+
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
            '<i class="fas fa-fw fa-edit"></i>'+
            '<i class="fas fa-fw fa-trash"></i>'+
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

$(document).ready( function () {
  var table = $('#bookings-table').DataTable({
    language: {
      searchPlaceholder: "Booking # / Room # / Guest Name"
    },
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
    "order": [[0, 'desc']]
  });
  $('#bookings-table td').on('click', function () {
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