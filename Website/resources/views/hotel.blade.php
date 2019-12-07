<?php
use App\Http\Controllers\ImageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\SelectController;
?>

<?php

// $arr = ImageController::getHotelImage(2);

// print_r($arr);

// $room = ImageController::getRoomImage(2,2);

// print_r($room);
// echo "-----------------------------------------------------------------------\n";
// $all = ImageController::getImage(1);

// print_r($all);

// echo "------------ HOME -----------------------------------------------------------\n";

// $home = ImageController::getHomeImage("Sepang");

// print_r($home);

// $hotelss = SearchController::searchHotelList(" "," "," ", 3, 3 , 2);
// $list = json_decode($hotelss);


// for($i=0; $i < count($list); $i++){
//     $id = $list[$i] -> hotelId;
//     
// }

// $hotels = SearchController::getHotelDetails( );    
//     print_r($hotels);

// $filter = FilterController::getFilterItem();
// print_r(json_decode($filter));

$info = Selectcontroller::getHotelInfo(2);
print_r($info);

// $rooms = SearchController::getRoomDetails(1);

// print_r($rooms);

// $arr = SearchController::calculate(9,5);

// print_r($arr);

?>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>  
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <br />
    <h3 align="center">How to Delete or Remove Data From Mysql in Laravel 6 using Ajax</h3>
    <br />
    <div align="right">
    <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
    <br />
<div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="15%">Hotel Name</th>
                <th width="5%">Check In Time</th>
                <th width="5%">Check Out Time</th>
                <th width="10%">City</th>
                <th width="20%">Address</th>
                <th width="5%">Star</th>
                <th width="10%">Operation Time</th>
                <th width="20%">Description</th>
                <th width="20%">Action</th>
            </tr>
        </thead>
    </table>
</div>
<br />
<br />
</div>

<form method="POST" action="{{ route('search') }}" class="form1">
<input id="firstName" type="text" class="firstname" name="city" align="center" placeholder="First Name" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
<input id="lastName" type="date" class="lastname" align="center" placeholder="Last Name" name="checkInDate" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>
<input id="email" type="date"  name="checkOutDate" class="un " align="center" placeholder="Fill in your email" value="{{ old('email') }}" required autocomplete="email">
<input id="password" type="text"  name="adult" class="pass" align="center" placeholder="Choose a strong password" required autocomplete="new-password">     
<input id="password-confirm" type="text" name="child" class="pass" align="center" placeholder="Confirm your password" required autocomplete="new-password">
<input id="phone" type="text" name="room" class="lastname" align="center" placeholder="Phone number" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
<button type="submit" align="center" class="submit">
{{ __('Register') }}
</button>
</form>

</body>
</html>

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Record</h4>
            </div>
        <div class="modal-body">
            <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" action="{{ route('hotel.store') }}">
                @csrf
                    <div class="form-group">
                        <label class="control-label col-md-4" >Hotel Name : </label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Check in time:  </label>
                        <div class="col-md-8">
                            <input type="time" name="checkInTime" id="checkInTime" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Check Out Time:  </label>
                        <div class="col-md-8">
                            <input type="time" name="checkOutTime" id="checkOutTime" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">City located:  </label>
                        <div class="col-md-8">
                            <input type="text" name="city" id="city" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Hotel address:  </label>
                        <div class="col-md-8">
                            <input type="text" name="address" id="address" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Star rated:  </label>
                        <div class="col-md-8">
                            <input type="text" name="star" id="star" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Operation Time:  </label>
                        <div class="col-md-8">
                            <input type="text" name="operationTime" id="operationTime" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Description:  </label>
                        <div class="col-md-8">
                            <input type="text area" name="description" id="description" class="form-control" />
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" value="Add" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
            <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function(){

$('#user_table').DataTable({
processing: true,
serverSide: true,
ajax: {
url: "{{ route('hotel.index') }}",
},
columns: [
    {
        data: 'name',
        name: 'name'
    },
    {
        data: 'checkInTime',
        name: 'checkInTime'
    },
    {
        data: 'checkOutTime',
        name: 'checkOutTime'
    },
    {
        data: 'city',
        name: 'city'
    },
    {
        data: 'address',
        name: 'address'
    },
    {
        data: 'star',
        name: 'star'
    },
    {
        data: 'operationTime',
        name: 'operationTime'
    },
    {
        data: 'description',
        name: 'description'
    },
    {
        data: 'action',
        name: 'action',
        orderable: false
    }
]
});

    $('#create_record').click(function(){
        $('.modal-title').text('Add New Record');
        $('#action_button').val('Add');
        $('#action').val('Add');
        $('#form_result').html('');

        $('#formModal').modal('show');
});

$('#sample_form').on('submit', function(event){
    event.preventDefault();
    var action_url = '';

    if($('#action').val() == 'Add')
    {
        console.log("Here for testing");
        action_url = "{{ route('hotel.store') }}";
        console.log("Here for testing end");
    }

    if($('#action').val() == 'Edit')
    {

        action_url = "{{ route('hotel.update') }}";
    }

    console.log("Here for testing end 1");
    $.ajax({
        url: action_url,
        method:"POST",
        data:$(this).serialize(),
        dataType:"json",
        success:function(data)
        {
            console.log("Here for testing end 2");
            var html = '';
            if(data.errors)
            {
                html = '<div class="alert alert-danger">';
                for(var count = 0; count < data.errors.length; count++)
            {
                html += '<p>' + data.errors[count] + '</p>';
            }
                html += '</div>';
            }
            if(data.success)
            {
                html = '<div class="alert alert-success">' + data.success + '</div>';
                $('#sample_form')[0].reset();
                $('#user_table').DataTable().ajax.reload();
            }
        $('#form_result').html(html);
        }
    });
});

$(document).on('click', '.edit', function(){
var id = $(this).attr('hotelId');
$('#form_result').html('');
$.ajax({
url :"/hotel/"+id+"/edit",
dataType:"json",
success:function(data)
{
    $('#name').val(data.result.name);
    $('#checkInTime').val(data.result.checkInTime);
    $('#checkOutTime').val(data.result.checkOutTime);
    $('#city').val(data.result.city);
    $('#address').val(data.result.address);
    $('#star').val(data.result.star);
    $('#operationTime').val(data.result.operationTime);
    $('#description').val(data.result.description);
    $('#hidden_id').val(id);
    $('.modal-title').text('Edit Record');
    $('#action_button').val('Edit');
    $('#action').val('Edit');
    $('#formModal').modal('show');
}
})
});

var user_id;

$(document).on('click', '.delete', function(){
user_id = $(this).attr('id');
$('#confirmModal').modal('show');
});

$('#ok_button').click(function(){
$.ajax({
url:"hotel/destroy/"+user_id,
beforeSend:function(){
    $('#ok_button').text('Deleting...');
},
success:function(data)
{
    setTimeout(function(){
    $('#confirmModal').modal('hide');
    $('#user_table').DataTable().ajax.reload();
    alert('Data Deleted');
    }, 2000);
}
})
});

});
</script>