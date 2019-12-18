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
            <form id="editRoomTypeModalForm">
                @csrf
                <div class="modal-body">
                
                    <!-- <input class="form-control" value="{{ session('management_hotel_id') }}"
                        name="hotelId" hidden readonly id="editRoomTypeModalHotelId" /> -->
                    <input class="form-control" hidden readonly id="editRoomTypeModalRoomId"
                        name="roomId" />
                    <div class="row">
                        <div class="col-3">
                            <div class="form-group">
                                <label>Room Name</label>
                            </div>
                        </div>
                        <div class="col-9">
                            <div class="form-group">
                                <input class="form-control" value="" placeholder="Room name" 
                                    id="editRoomTypeModalRoomType" name="typeName" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Room Description</label>
                        <textarea class="form-control" rows="8" cols="80" id="editRoomTypeModalDescription"
                            placeholder="Room description" name="description"></textarea>
                    </div>
                
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <span id='editRoomTypeModalValidator'></span>
                    </div>
                    <button type="submit" class="btn btn-primary" id="editRoomTypeModalSaveChangesBtn">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
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
    // $('[data-toggle="tooltip"]').tooltip();
    var typeTable = $('#room-type-table').DataTable({
        ajax: '{{ route("management/hotel/roomTypes", session("management_hotel_id")) }}',
        searching: false, paging: false, info: false,
        columns: [
            { orderable: false, }, 
            null,
            { orderable: false, searchable: false, className: 'text-left', },
            { orderable: false, searchable: false, className: 'text-right', },
        ],
        order: [[1, 'asc']],
        language: {
            loadingRecords: '<div class="d-flex justify-content-center my-3"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
        }
    });
    var roomTable = $('#rooms-table').DataTable({
        ajax: '{{ route("management/hotel/rooms", session("management_hotel_id")) }}',
        dom: 
            "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
            "<'d-flex justify-content-end'<B>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        buttons: [
            {
                text: 'Select all',
                action: function() {
                    roomTable.rows({
                        search: 'applied'
                    }).select();
                }
            },
            'selectNone',
            {
                text: 'Enable rooms',
                enabled: false,
                action: function ( e, dt, node, config ) {
                    changeAvailability(e,dt,node,config,1);
                }
            },
            {
                text: 'Disable rooms',
                enabled: false,
                action: function ( e, dt, node, config ) {
                    changeAvailability(e,dt,node,config,0);
                }
            },
        ],
        select: true,
        language: {
            searchPlaceholder: 'Room No.',
            loadingRecords: '<div class="d-flex justify-content-center my-3"><div class="spinner-border text-primary" role="status"><span class="sr-only">Loading...</span></div></div>'
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
    var roomTableFilter = $('#js-rooms-table-filter').select2({
        tokenSeparators: [',', ' '],
        placeholder: 'Select filters',
        ajax: {
            url: '{{ route("management/hotel/roomTypesForSelect2", session("management_hotel_id")) }}',
            dataType: 'json',
            type: "GET",
            // quietMillis: 50,
            data: function (term) {
                // console.log(term);
                // console.log("term" + term);
                return {
                    term: term
                };
            },
            results: function (data) {
                // console.log("data" + data);
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.completeName,
                            slug: item.slug,
                            id: item.id
                        }
                    })
                };
            }
        }
    });
    // $('#js-rooms-table-filter').on('select2:select', select);
    roomTableFilter.on('select2:close', select);

    // roomTableFilter.on('select2:selecting', function(event) {
    //     console.log(event);
        
    //     var text = event.params.args.data['id'];
    //     if (text === 'Disabled' || text === 'Enabled') {
    //         console.log(roomTableFilter);
    //     } else {
    //         console.log(roomTableFilter);
    //     } 
    // });

    $('#editRoomTypeModalForm').on('submit', function (e) {
        e.preventDefault();
        $('#editRoomTypeModalSaveChangesBtn').prop('disabled', true);
        var error = '';
        if ( !$('#editRoomTypeModalDescription').val() ) {
            error = 'Room description cannot be empty';
        }
        if ( !$('#editRoomTypeModalRoomType').val() ) {
            error = 'Room type name cannot be empty';
        }
        if (error !== '') {
            $('#editRoomTypeModalValidator').css('color', 'red');;
            $('#editRoomTypeModalValidator').html(error);
            $('#editRoomTypeModalSaveChangesBtn').prop('disabled', false);
        } else {
            $.ajax({
                url: "{{ route('management/hotel/updateRoomType', session('management_hotel_id')) }}",
                method: "POST",
                data: $('#editRoomTypeModalForm').serialize(),
                success:function(data) {
                    // if (data['status'] === true) {
                    console.log('Edit room type successfully.');
                        // $(location).attr('href', data['redirect']);
                    // } else {
                        // console.log('Failed: ' + data['error']);
                        // $('#editRoomTypeModalValidator').css('color', 'red');;
                        // $('#editRoomTypeModalValidator').html(data['error']);
                    // }
                    $('#editRoomTypeModalSaveChangesBtn').prop('disabled', false);
                    $('#room-type-table').DataTable().ajax.reload();
                    // $('#rooms-table').DataTable().ajax.reload();
                    $('#editRoomTypeModal').modal('toggle');
                },
                error:function(error) {
                    console.log('Error: ' + error);
                    $('#editRoomTypeModalSaveChangesBtn').prop('disabled', false);
                }
            });
        }
    })
})

function changeAvailability( e, dt, node, config, availability ) {
    dt.buttons().disable();
    var data = dt.rows( { selected: true } ).data();
    var list = [];
    for (var i = 0; i < data.length; i++)
        list.push(data[i][0]);
    var json = {
        _token: "{{ csrf_token() }}",
        available: availability,
        rooms: list,
    }
    
    $.ajax({
        url: "{{ route('management/hotel/updateRoomsAvailability', session('management_hotel_id')) }}",
        method: "POST",
        data: json,
        success:function(data) {
            console.log('Change rooms availability successfully.');
            // node.prop('disabled', false);
            dt.button( 0 ).enable();
            dt.ajax.reload();
        },
        error:function(request, status, error) {
            console.log('Request: ' + request.responseText);
            console.log('Status: ' + status);
            console.log('Error: ' + error);
            dt.buttons().enable();
            // node.prop('disabled', false);
        }
    });
}

function select(e) {
    var data = $('#js-rooms-table-filter').select2('data');
    // console.log(data);
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
