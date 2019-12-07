@extends('management/layout')

@section('title')
Sign In
@endsection

@section('content')
<div class="">
  <div class="sign-in-container mx-auto">
    <h3 class="text-center">Management</h4>
    <h1 class="text-center">Sign In</h1>
    <hr />
    <form id="sign-in-form">
      @csrf
      <div class="form-group">
        <label for="sign-in-email">Email</label>
        <input type="text" class="form-control" name="email" value="" placeholder="Email" id="sign-in-email">
      </div>
      <div class="form-group">
        <label for="sign-in-password">Password</label>
        <input type="password" class="form-control" name="password" value="" placeholder="Password" id="sign-in-password">
      </div>
      <div class="form-group">
        <span id='sign-in-validator'></span>
      </div>
      <div class="form-group">
        <button id="sign-in-btn" class="btn btn-default btn-block font-weight-bold">Sign In</button>
      </div>
      <div class="text-center">
        <a href="#">Forgot password?</a>
      </div>
    </form>
  </div>
</div>
<script>
  $('#sign-in-form').on('submit', function (e) {
    e.preventDefault();
    $('#sign-in-btn').prop('disabled', true);
    var error = '';
    if ( !$('#sign-in-password').val() ) {
      error = 'Password cannot be empty';
    }
    if ( !$('#sign-in-email').val() ) {
      error = 'Email cannot be empty';
    }
    if (error !== '') {
      $('#sign-in-validator').css('color', 'red');;
      $('#sign-in-validator').html(error);
      $('#sign-in-btn').prop('disabled', false);
    } else {
      $.ajax({
        url: "{{ route('management/sign-in') }}",
        method: "POST",
        data: $('#sign-in-form').serialize(),
        success:function(data) {
          if (data['status'] === true) {
            console.log('Signed in successfully.');
            $(location).attr('href', data['redirect']);
          } else {
            console.log('Failed: ' + data['error']);
            $('#sign-in-validator').css('color', 'red');;
            $('#sign-in-validator').html(data['error']);
          }
          $('#sign-in-btn').prop('disabled', false);
        },
        error:function(error) {
          console.log('Error: ' + error);
          $('#sign-in-btn').prop('disabled', false);
        }
      });
    }
  });
</script>
@endsection