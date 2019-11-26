<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - HotelNest</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/css/bootstrap.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="{{ asset('bootstrap-4.3.1/js/bootstrap.min.js') }}" charset="utf-8"></script>
    <script src="https://kit.fontawesome.com/a06c7371fc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/management/master.css') }}">
  </head>
  <body>
    <header class="header">
      <nav class="navbar navbar-expand-md navbar-light container">
        <!-- Brand -->
        <a class="navbar-brand text-default font-weight-bold" href="{{ url('management/book') }}">
          <img src="{{ asset('images/management/logo.png') }}" alt="logo" style="width: 64px;">
        </a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse ml-5" id="collapsibleNavbar">
          <ul class="navbar-nav">
            <li class="nav-item nav-item-header">
              <a class="nav-link text-default nav-link-header" href="{{ url('management/book') }}">Book</a>
            </li>
            <li class="nav-item nav-item-header">
              <a class="nav-link text-default nav-link-header" href="{{ url('management/bookings') }}">Bookings</a>
            </li>
            <li class="nav-item nav-item-header">
              <a class="nav-link text-default nav-link-header" href="#">Rooms</a>
            </li>
          </ul>
        </div>
        <div class="btn-group">
          <a type="button" class="btn btn-default" href="{{ url('management/profile') }}">
            <i class="fas fa-home fa-fw"></i>&nbsp;
            Shangri-La Hotel
          </a>
          <button type="button" class="btn btn-default dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
          </button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ url('management/change-password') }}">Change password</a>
            <a class="dropdown-item" href="{{ url('management/sign-in') }}">Sign out</a>
          </div>
        </div>
      </nav>
    </header>
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
            <a href="#" class="float-right">Clear</a>
            <h5>Filter</h5>
          </div>
          <div class="filter-container">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
              <label class="form-check-label" for="defaultCheck1">
                Check-in today
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
              <label class="form-check-label" for="defaultCheck2">
                Check-out today
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
              <label class="form-check-label" for="defaultCheck3">
                Single room
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck4">
              <label class="form-check-label" for="defaultCheck4">
                Double room
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck5">
              <label class="form-check-label" for="defaultCheck5">
                Has children
              </label>
            </div>
          </div>
        </aside>
        <div class="col-9">
          <table class="table table-hover table-fixed text-center booking-table">
            <thead class="thead-light">
              <tr>
                <th>No.</th>
                <th>Booking</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Night</th>
                <th>Room</th>
                <th>Adult</th>
                <th>Child</th>
                <th>Total (RM)</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr data-toggle="collapse" data-target="#booking2" aria-expanded="false">
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr id="booking2" class="expanded-row collapse">
                <td colspan="5" class="text-left" style="border-top: none;">
                  <span>
                    <i class="fas fa-user"></i>
                    Jackson Armstrong
                    &nbsp
                  </span>
                  <span class="text-nowrap">
                    <i class="fas fa-envelope"></i>
                    email@email.com
                    &nbsp
                  </span>
                  <span class="text-nowrap">
                    <i class="fas fa-phone"></i>
                    012-345 6789
                  </span>
                </td>
                <td colspan="3" class="text-left" style="border-top: none;">
                  <!-- <pre> -->
                    1x Single Room (603)<br />
                    1x Double Room (614)
                  <!-- </pre> -->
                </td>
                <td style="border-top: none;"><i class="fas fa-trash"></i></td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
              <tr>
                <td>45690</td>
                <td>12 Oct 2019</td>
                <td>25 Oct 2019</td>
                <td>28 Oct 2019</td>
                <td>3</td>
                <td>2</td>
                <td>2</td>
                <td>2</td>
                <td>674.90</td>
              </tr>
            </tbody>
            <tfoot>
              <tr class="text-right">
                <td colspan="9">
                  Showing&nbsp;
                  <label class="radio-inline"><input type="radio" name="optradio" checked>10</label>&nbsp;
                  <label class="radio-inline"><input type="radio" name="optradio">25</label>&nbsp;
                  <label class="radio-inline"><input type="radio" name="optradio">50</label>&nbsp;
                  out of 56 results
                </td>
              </tr>
              <tr>
                <td colspan="9" class="h5">
                  <a href="#">&laquo; Prev</a>&nbsp
                  <a href="#">1</a>&nbsp
                  <a href="#">2</a>&nbsp
                  <u>3</u>&nbsp
                  <a href="#">4</a>&nbsp
                  <a href="#">5</a>&nbsp
                  <a href="#">Next &raquo;</a>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
