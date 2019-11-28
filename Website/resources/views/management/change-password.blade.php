@extends('management/layout')

@section('title')
Change Password
@endsection

@section('content')
<div class="">
  <div class="change-password-container mx-auto">
    <h1 class="text-center">Change Password</h1>
    <hr />
    <!-- <form class="" action="{{ route('management/change-password') }}" method="post"> -->
    <form id="change-password-form">
      @csrf
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" class="form-control" name="current-password" value="" placeholder="Current password" id="current-password">
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" class="form-control" name="new-password" value="" placeholder="New password" id="new-password">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" name="confirm-password" value="" placeholder="Confirm password" id="confirm-password">
      </div>
      <!-- <input type="submit" class="btn btn-default btn-block font-weight-bold" value="Change Password" /> -->
      <div class="form-group">
        <span id='change-password-validator'></span>
      </div>
      <button id="change-password-btn" class="btn btn-default btn-block font-weight-bold">Change Password</button>
    </form>
  </div>
</div>
<script>
  $('#change-password-form').on('submit', function (e) {
    e.preventDefault();
    $('#change-password-btn').prop('disabled', true);
    var error = '';
    if ( $('#new-password').val() !== $('#confirm-password').val() ) {
      error = 'New password and confirm password must be the same';
    }
    if ( !$('#confirm-password').val() ) {
      error = 'Confirm password cannot be empty';
    }
    if ( !$('#new-password').val() ) {
      error = 'New password cannot be empty';
    }
    if ( !$('#current-password').val() ) {
      error = 'Current password cannot be empty';
    }
    if (error !== '') {
      $('#change-password-validator').css('color', 'red');;
      $('#change-password-validator').html(error);
      $('#change-password-btn').prop('disabled', false);
    } else {
      $.ajax({
        url: "{{ route('management/change-password') }}",
        method: "POST",
        data: $('#change-password-form').serialize(),
        success:function(data) {
          var html = '';
          if (data['status'] === true) {
            console.log('Password changed successfully');
            $('#change-password-validator').css('color', 'green');
            html = 'Password changed successfully';
            $('#change-password-form').trigger('reset');
          } else {
            console.log('Failed: ' + data['error']);
            $('#change-password-validator').css('color', 'red');;
            html = data['error'];
          }
          $('#change-password-validator').html(html);
          $('#change-password-btn').prop('disabled', false);
        },
        error:function(error) {
          console.log('Error: ' + error);
          $('#change-password-btn').prop('disabled', false);
        }
      });
    }
  });
</script>
@endsection