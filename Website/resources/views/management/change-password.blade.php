@extends('management/layout')

@section('title')
Change Password
@endsection

@section('content')
<div class="">
  <div class="change-password-container mx-auto">
    <h1 class="text-center">Change Password</h1>
    <hr />
    <form class="" action="index.html" method="post">
      <div class="form-group">
        <label for="current-password">Current Password</label>
        <input type="password" class="form-control" name="" value="" placeholder="Current password" id="current-password">
      </div>
      <div class="form-group">
        <label for="new-password">New Password</label>
        <input type="password" class="form-control" name="" value="" placeholder="New password" id="new-password">
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" class="form-control" name="" value="" placeholder="Confirm password" id="confirm-password">
      </div>
      <button type="button" name="button" class="btn btn-default btn-block font-weight-bold">Change Password</button>
    </form>
  </div>
</div>
@endsection