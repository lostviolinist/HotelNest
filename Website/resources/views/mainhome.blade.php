<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Bootstrap 4.3.1 -->
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="{{ asset('jquery-3.4.1/jquery-3.4.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>

    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <title>
        HotelNest
    </title>
</head>

<body>
<div class="container-fluid mt-3">
    <section class="row">
      <div class="col-md-8">
        <h1 class="title">HotelNest</h1>
      </div>
      <div class="col-md-4">
        <div class=" float-right" role="group">
          <a class="btn btn-secondary btn-md  mr-3" style="background-color: #586BA4;" href="#"> Register </a>
          <a class="btn btn-md btn-outline-secondary" tyle="border-color: #586BA4;" href="#"> Sign In </a>
        </div>
      </div>
    </section>
  </div>
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
                            <div class="form-group col-md-4 mr-5">
                                <label for="inputAddress">Start Date</label>
                                <input type="date" class="form-control" id="inputAddress" placeholder="12 Oct 2019" name="checkInDate">
                            </div>


                            <div class="form-group col-md-4 ml-3">
                                <label for="inputAddress">End Date</label>
                                <input type="date" class="form-control" id="inputAddress" placeholder="13 Oct 2019" name="checkOutDate">
                            </div>
                        </div>


                        <div class="form-row p-3">
                            <div class="form-group col-md-2 mr-5">
                                <label for="inputCity">Adults</label>
                                <input type="number" class="form-control" id="inputCity" min="1" name="adult">
                            </div>
                            <div class="form-group col-md-2 ml-5">
                                <label for="inputState">Children</label>
                                <input type="number" class="form-control" id="inputCity" min="0" name="child">
                            </div>
                            <div class="form-group col-md-2 ml-5">
                                <label for="inputState">Rooms</label>
                                <input type="number" class="form-control" id="inputCity" min="1" name="room">
                            </div>

                        </div>

                        <button type="submit" class="ml-3 mt-5 mb-5 btn btn-primary">Search</button>
                    </form>
                </div>
            </td>
            <td>
                <div class="recommended">
                    <p>Kuala Lumpur</p>
                    
                    <?php
                        $arr = json_decode(ImageController::getHomeImage("Kuala Lumpur"));
                        //for ($i = 0; $i < count($arr); $i++) { ?>

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
                        //for ($i = 0; $i < count($arr); $i++) { ?>

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
</body>

</html>