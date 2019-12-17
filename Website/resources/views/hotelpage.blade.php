<!DOCTYPE html>
<html lang="en">

<?php

use App\Http\Controllers\SelectController;
use Illuminate\Http\Request;

$url = $request->path(); 
echo $url;

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <title>Hotel</title>
</head>
<body>
    <div class="container-fluid mt-3">
        <section class="row">
            <div class="col-md-8">
                <h1 class="title">HotelNest</h1>
            </div>
            <div class="col-md-4">
                <div class=" float-right" role="group">
                    <a class="btn btn-secondary btn-md register-button mr-3" href="#"> Register </a>
                    <a class="btn btn-md btn-outline-secondary signin-button" href="#"> Sign In </a>
                </div>
            </div>
        </section>
    </div>

    <div class="container">

  

  <hr class="mt-2 mb-5">

  <div class="row text-center text-lg-left">

    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aob0ukAYfuI/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EUfxH-pze7s/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/M185_qYH8vg/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/sesveuG_rNo/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/AvhMzHwiE_0/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/2gYsZUmockw/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/EMSDtjVHdQ8/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/8mUEy0ABdNE/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/G9Rfc1qccH4/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/aJeH0KcFkuc/400x300" alt="">
          </a>
    </div>
    <div class="col-lg-3 col-md-4 col-6">
      <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/p2TQ-3Bh3Oo/400x300" alt="">
          </a>
    </div>
  </div>

</div>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h1>The St. Regis</h1>
                <h4>Kuala Lumpur</h4>
                <p>Description description description
                    description description description
                    description description description.
                </p>
            </div>
            <div class="col">
                    <div class="container">
                            Start Date: <input id="startDate" width="276" />
                            End Date: <input id="endDate" width="276" />
                        </div>
                        <script>
                            var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
                            $('#startDate').datepicker({
                                uiLibrary: 'bootstrap4',
                                iconsLibrary: 'fontawesome',
                                minDate: today,
                                maxDate: function () {
                                    return $('#endDate').val();
                                }
                            });
                            $('#endDate').datepicker({
                                uiLibrary: 'bootstrap4',
                                iconsLibrary: 'fontawesome',
                                minDate: function () {
                                    return $('#startDate').val();
                                }
                            });
                        </script>

                
            </div>
            <div class="col">
                    <a class="btn btn-md btn-outline-secondary signin-button" href="#"> More Photos </a>
                    RM719/night
            </div>
        </div>

    </div>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col">Room type</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Twin Room</th>
                <td>Description description</td>
                <td>RM719/night</td>
                <td class="ml-5"><button type="button" class="btn btn-outline-primary">Book now</button> </td>
              </tr>
              <tr>
                <th scope="row">King Room</th>
                <td>Description description</td>
                <td>RM819/night</td>
                <td class="ml-5"><button type="button" class="btn btn-outline-primary">Book now</button> </td>
              </tr>
              <tr>
                <th scope="row">Family Room</th>
                <td>Description description</td>
                <td>RM1000/night</td>
                <td class="ml-5"><button type="button" class="btn btn-outline-primary">Book now</button> </td>
              </tr>
              <tr>
                <th scope="row">Family Room</th>
                <td>Description description</td>
                <td>RM1000/night</td>
                <td class="ml-5"><button type="button" class="btn btn-outline-primary">Book now</button> </td>
              </tr>
              <tr>
                <th scope="row">Family Room</th>
                <td>Description description</td>
                <td>RM1000/night</td>
                <td class="ml-5"><button type="button" class="btn btn-outline-primary">Book now</button> </td>
              </tr>
            </tbody>
          </table>
    </div>
</body>
</html>