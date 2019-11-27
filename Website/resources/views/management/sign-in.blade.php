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
    <form class="" action="{{ route('management/sign-in') }}" method="post">
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
        <a href="#">Forgot password?</a>
      </div>
      <!-- <button type="button" name="button" class="btn btn-default btn-block font-weight-bold">Sign In</button> -->
      <input type="submit" class="btn btn-default btn-block font-weight-bold" value="Sign in">
      <!-- <a type="button" name="button" class="btn btn-default btn-block font-weight-bold" href="{{ url('management/book') }}">Sign In</a> -->
    </form>
  </div>
</div>
@endsection