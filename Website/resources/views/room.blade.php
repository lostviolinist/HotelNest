<!DOCTYPE html>
<html lang="en">
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
    <title>Room</title>
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
    
      <div class="container mt-5 mb-5">
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
                <td class="ml-5"><button type="button" class="btn btn-outline-primary">Boook now</button> </td>
              </tr>
            </tbody>
          </table>
    </div>
</body>
</html>