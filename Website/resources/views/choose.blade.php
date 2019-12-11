<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/bootstrap-4.3.1/css/bootstrap.min.css">
  <title>Choose a Hotel</title>
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

  <div class="ml-5 mt-5">
    <form class="form-inline">
      <label class="sr-only" for="inlineFormInputName2">Name</label>
      <input type="text" class="form-control mb-2 mr-5" id="inlineFormInputName2" placeholder="Where">

      <label class="sr-only" for="inlineFormInputGroupUsername2">Check in</label>
      <div class="input-group mb-2 mr-sm-2">

        <input type="date" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Check in">
      </div>

      <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
      <div class="input-group mb-2 mr-sm-2">

        to
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Check Out</label>
      <div class="input-group mb-2 mr-5">

        <input type="date" class="form-control" id="inlineFormInputGroupUsername3" placeholder="Check Out">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Pax</label>
      <div class="input-group mb-2 mr-sm-2">

        <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername4"
          placeholder="1">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">Pax</label>
      <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
      <div class="input-group mb-2 mr-5">

        Adults
      </div>
      <div class="input-group mb-2 mr-sm-2">

        <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername5"
          placeholder="1">
      </div>
      <label class="sr-only" for="inlineFormInputGroupUsername2">to</label>
      <div class="input-group mb-2 mr-5">

        Children
      </div>
      <div class="input-group mb-2 mr-sm-2">

        <input type="number" class="form-control" style="width: 50px;" id="inlineFormInputGroupUsername5"
          placeholder="1">
      </div>
      
      <div class="input-group mb-2 mr-5">

       Rooms
      </div>
      


      <button type="submit" class="btn btn-primary mb-2" style="background-color: #586BA4;">Search</button>
    </form>
  </div>

  <div class="ml-5 mt-5">
    <div class="row">
      <div class="col-sm">
        <div class="card" style="width: 18rem;">
          <div class="card-body">
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Non-smoking
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Bath Tub
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Free Wifi
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Breakfast
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Free Parking
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Late CheckOut
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">1 Star
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">2 Stars
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">3 Stars
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">4 Stars
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">5 Stars
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">24hr Reception
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Fitness Centre
              </label>
            </div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="">Coffee Maker
              </label>
            </div>



          </div>
        </div>
      </div>
      <div class="col-md-9">
        <div class="row">
          <div class="col"> <button class="btn btn-success"> Our Top Pick </button> </div>
          <div class="col"> <button class="btn btn-outline-info">Cheapest</button></div>
          <div class="col"><button class="btn btn-outline-info">Lowest Stars</button></div>
          <div class="col"><button class="btn btn-outline-info">Star and Price</button></div>
          <div class="col"><button class="btn btn-outline-info">Top Reviewed</button></div>

        </div>
        <div style="height: 300px overflow: scroll;">
          <div class="card mb-3 mt-5" style="max-width: 1000px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="112963088.png" class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">The St. Regis</h5>
                  <p class="card-text">Description description description description description Description
                    description description description description</p>

                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3 mt-5" style="max-width: 1000px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="112963088.png" class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">The St. Regis</h5>
                  <p class="card-text">Description description description description description Description
                    description description description description</p>

                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3 mt-5" style="max-width: 1000px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="112963088.png" class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">The St. Regis</h5>
                  <p class="card-text">Description description description description description Description
                    description description description description</p>

                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3 mt-5" style="max-width: 1000px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="112963088.png" class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">The St. Regis</h5>
                  <p class="card-text">Description description description description description Description
                    description description description description</p>

                </div>
              </div>
            </div>
          </div>
          <div class="card mb-3 mt-5" style="max-width: 1000px;">
            <div class="row no-gutters">
              <div class="col-md-4">
                <img src="112963088.png" class="card-img" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">The St. Regis</h5>
                  <p class="card-text">Description description description description description Description
                    description description description description</p>

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>


</body>

</html>
