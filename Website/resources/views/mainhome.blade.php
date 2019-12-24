@extends('layouts.app')

@section('content')
<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\DB;

?>
<table class="ml-0">
        <tr>
            <td>
                <div class="card ml-5 mt-5 mt-5 " style="width: 700px">
                    <form class="container" method="get" action="{{ route('choose') }}">
                        <div class="form-row p-3">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Where</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder="City" name="city">
                            </div>

                        </div>
                        <div class="form-row p-3">
                            <div class="container">
                            
                                Start Date <input id="checkInDate" width="276" name="checkInDate"/>
                                End Date <input id="checkOutDate" width="276" name="checkOutDate"/>
                            </div>
                            <script>
                                var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                                $('#checkInDate').datepicker({
                                    uiLibrary: 'bootstrap4',
                                    iconsLibrary: 'fontawesome',
                                    minDate: today,
                                    maxDate: function() {
                                        return $('#checkOutDate').val();
                                    }
                                });
                                $('#checkOutDate').datepicker({
                                    uiLibrary: 'bootstrap4',
                                    iconsLibrary: 'fontawesome',
                                    minDate: function() {
                                        return $('#checkInDate').val();
                                    }
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
                        </div>


                        <div class="form-row p-3">
                            <div class="form-group col-md-2 mr-5">
                                <label for="inputCity">Adults</label>
                                <input type="number" class="form-control" id="inputCity" min="1" value="1" name="adult">
                            </div>
                            <div class="form-group col-md-2 ml-5">
                                <label for="inputState">Children</label>
                                <input type="number" class="form-control" id="inputCity" min="0" value="0" name="child">
                            </div>
                            <div class="form-group col-md-2 ml-5">
                                <label for="inputState">Rooms</label>
                                <input type="number" class="form-control" id="inputCity" min="1" value="1" name="room">
                            </div>

                        </div>

                        <button type="submit" class="ml-3 mt-5 mb-5 btn btn-primary">Search</button>
                    </form>
                </div>
            </td>
            <td>
                <div class="recommended" style="width:700px;">
                    <p>Kuala Lumpur</p>

                    <?php
                    $arr = json_decode(ImageController::getHomeImage("Kuala Lumpur"));
                    //for ($i = 0; $i < count($arr); $i++) { 
                    ?>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="thumbnail">


                                <img src="<?php print_r($arr[0]) ?>" alt="St.Regis" style="width:100%">


                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">



                                <img src="<?php print_r($arr[1]) ?>" alt="St.Regis" style="width:100%">




                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="thumbnail">



                                <img src="<?php print_r($arr[2]) ?>" alt="St.Regis" style="width:100%">




                            </div>
                        </div>

                    </div>
                    <div class="mt-5">
                        <p>Penang</p>

                        <?php
                                            $arr = json_decode(ImageController::getHomeImage("George Town"));
                                            //for ($i = 0; $i < count($arr); $i++) { 
                        ?>

                        <div class="row">

                            <div class="col-md-4">
                                <div class="thumbnail">


                                    <img src="<?php print_r($arr[0]) ?>" alt="St.Regis" style="width:100%">





                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">



                                    <img src="<?php print_r($arr[1]) ?>" alt="St.Regis" style="width:100%">




                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="thumbnail">



                                    <img src="<?php print_r($arr[2]) ?>" alt="St.Regis" style="width:100%">




                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                </div>
            </td>
        </tr>
    </table>
@endsection
