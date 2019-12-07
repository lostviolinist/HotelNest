@extends('management/layout')

@section('title')
Rooms
@endsection

@section('head-extra')
<!-- DataTables-1.10.20 -->
<link rel="stylesheet" href="{{ asset('datatables-1.10.20/datatables.min.css') }}">
<script src="{{ asset('datatables-1.10.20/datatables.min.js') }}" charset="utf-8"></script>

<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endsection

@section('content')
<!-- The Modal -->
<div class="modal" id="editRoomTypeModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Room Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input class="form-control" hidden readonly id="editRoomTypeModalRoomId" />
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label>Room Name</label>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="form-group">
                            <input class="form-control" value="" placeholder="Room name" 
                                id="editRoomTypeModalRoomType" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Room Description</label>
                    <textarea class="form-control" rows="8" cols="80" id="editRoomTypeModalDescription"
                        placeholder="Room description"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container mb-3">
    <div class="bg-default text-white text-center p-2 rounded collapsed" data-toggle="collapse" data-target="#roomTypeCollapse" 
        aria-expanded="false" aria-controls="roomTypeCollapse" style="cursor: pointer;">
        <h5>
            <i class="fa" aria-hidden="true"></i>
            Room Type
        </h5>
    </div>
    <div class="collapse" id="roomTypeCollapse">
        <table id="room-type-table" class="table table-hover table-fixed text-center booking-table" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Room Type</th>
                    <th>Pax</th>
                    <th class="text-center">Room Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Single Room</td>
                    <td>1 + 1</td>
                    <td>This single room has air conditioning.</td>
                    <td>
                        <button class="btn btn-outline-primary" onclick="editRoomType(this, 1)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Double Room</td>
                    <td>2 + 1</td>
                    <td>This double room features a electric kettle, air conditioning and satellite TV.</td>
                    <td>
                        <button class="btn btn-outline-primary" onclick="editRoomType(this, 2)">
                            <i class="fas fa-edit"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <hr />
    <div class="form-group bg-default text-white text-center p-2 rounded" data-toggle="collapse" data-target="#roomListCollapse" 
        aria-expanded="true" aria-controls="roomListCollapse" style="cursor: pointer;">
        <h5>
            <i class="fa" aria-hidden="true"></i>
            Room List
        </h5>
    </div>
    <div class="show" id="roomListCollapse">
        <!-- <div class="form-group">
            <div class="row">
                <div class="col-3">
                    <input class="form-control" placeholder="Room No."/>
                </div>
                <div class="col-7">
                    <select class="form-control">
                        <optgroup label="Select room type">
                            <option>Single Room</option>
                            <option>Double Room</option>
                            <option>Quadruple Room</option>
                        </optgroup>
                    </select>
                </div>
                <div class="col-2">
                    <button class="btn btn-outline-primary" style="width:100%;">
                        <i class="fas fa-plus"></i>
                        Add Room
                    </button>
                </div>
            </div>
        </div> -->
        <div class="form-group">
            <select class="form-control" id="js-rooms-table-filter" style="width: 100%;" multiple="multiple">
                <optgroup label="Availability">
                    <option>Enabled</option>
                    <option>Disabled</option>
                </optgroup>
                <optgroup label="Room Type">
                    <option>Single Room</option>
                    <option>Double Room</option>
                    <option>Quadruple Room</option>
                </optgroup>
            </select>
        </div>
        <table id="rooms-table" class="table table-hover table-fixed text-center booking-table" width="100%">
            <thead class="thead-light">
                <tr>
                    <th>Room No.</th>
                    <th>Room Type</th>
                    <th></th>
                    <th>Availability</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>601</td>
                    <td>Single Room</td>
                    <td>Enabled</td>
                    <td>
                        <label class="text-success"><i class="fas fa-check"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>611</td>
                    <td>Double Room</td>
                    <td>Disabled</td>
                    <td>
                        <label class="text-danger"><i class="fas fa-minus"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>601</td>
                    <td>Single Room</td>
                    <td>Enabled</td>
                    <td>
                        <label class="text-success"><i class="fas fa-check"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>611</td>
                    <td>Double Room</td>
                    <td>Disabled</td>
                    <td>
                        <label class="text-danger"><i class="fas fa-minus"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>601</td>
                    <td>Single Room</td>
                    <td>Enabled</td>
                    <td>
                        <label class="text-success"><i class="fas fa-check"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>611</td>
                    <td>Double Room</td>
                    <td>Disabled</td>
                    <td>
                        <label class="text-danger"><i class="fas fa-minus"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>601</td>
                    <td>Single Room</td>
                    <td>Enabled</td>
                    <td>
                        <label class="text-success"><i class="fas fa-check"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>611</td>
                    <td>Double Room</td>
                    <td>Disabled</td>
                    <td>
                        <label class="text-danger"><i class="fas fa-minus"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>601</td>
                    <td>Single Room</td>
                    <td>Enabled</td>
                    <td>
                        <label class="text-success"><i class="fas fa-check"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>611</td>
                    <td>Double Room</td>
                    <td>Disabled</td>
                    <td>
                        <label class="text-danger"><i class="fas fa-minus"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>601</td>
                    <td>Single Room</td>
                    <td>Enabled</td>
                    <td>
                        <label class="text-success"><i class="fas fa-check"></i></label>
                    </td>
                </tr>
                <tr>
                    <td>611</td>
                    <td>Double Room</td>
                    <td>Disabled</td>
                    <td>
                        <label class="text-danger"><i class="fas fa-minus"></i></label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
$(document).ready( function () {
    $('[data-toggle="tooltip"]').tooltip();
    var typeTable = $('#room-type-table').DataTable({
        searching: false, paging: false, info: false,
        columns: [
            { orderable: false, }, 
            null,
            { orderable: false, searchable: false, className: 'text-left', },
            { orderable: false, searchable: false, className: 'text-right', },
        ],
        order: [[1, 'asc']]
    });
    var roomTable = $('#rooms-table').DataTable({
        dom: 
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'d-flex justify-content-end'<B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                text: 'Select filtered',
                action: function() {
                    roomTable.rows({
                        search: 'applied'
                    }).select();
                }
            },
            'selectNone',
            {
                text: 'Enable selected',
                enabled: false,
                action: function ( e, dt, node, config ) {
                    // dt.ajax.reload();
                }
            },
            {
                text: 'Disable selected',
                enabled: false,
                action: function ( e, dt, node, config ) {
                    // dt.ajax.reload();
                }
            },
        ],
        select: true,
        language: {
            searchPlaceholder: 'Room No.',
        },
        columns: [
            null, 
            { orderable: false, },
            { orderable: false, visible: false, },
            { orderable: false, searchable: false, },
        ],
    });
    roomTable.on( 'select deselect', function () {
        var selectedRows = roomTable.rows( { selected: true } ).count();
 
        roomTable.button( 2 ).enable( selectedRows > 0 );
        roomTable.button( 3 ).enable( selectedRows > 0 );
    } );
    $('#js-rooms-table-filter').select2({
        tokenSeparators: [',', ' '],
        placeholder: 'Select filters'
    });
    // $('#js-rooms-table-filter').on('select2:select', select);
    $('#js-rooms-table-filter').on('select2:close', select);

});

function select(e) {
    var data = $('#js-rooms-table-filter').select2('data');
    console.log(data);
    var roomTable = $('#rooms-table').DataTable();
    var query = '';
    for (var i = 0; i < data.length; i++) {
        query += data[i].text + ' ';
    }
    roomTable.search(query).draw();
}

function editRoomType(element, roomId) {
    var data = $(element).closest('tr').find('td');
    $('#editRoomTypeModalRoomId').val(roomId);
    $('#editRoomTypeModalRoomType').val($(data[0]).text());
    $('#editRoomTypeModalDescription').val($(data[2]).text());
    $('#editRoomTypeModal').modal('toggle');
}
</script>
@endsection
