<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type = "text/css" href="/css/style.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>Sign In</title>
</head>

<body>  
  <div class="main">
    <p class="sign" align="center">Sign in to your account. </p>
    <form method="POST" action="{{ route('login') }}" class="form1">
        @csrf
        <div>
            <div>
                <input id="email" type="email" class="@error('email') is-invalid @enderror un" align="center" placeholder="Enter your email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <!-- @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
            </div>
        </div>

        <div >
            <div>
                <input id="password" type="password" class="@error('password') is-invalid @enderror pass" align="center" placeholder="Enter your password" name="password" required autocomplete="current-password">
                <!-- @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror -->
            </div>
        </div>

        <!-- <div class="form-group row">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div> -->

        <div>
            <div>
                <button type="submit" class="submit">
                    {{ __('Sign In') }}
                </button>
                
                <p class="forgot" align="center"><a href="{{ route('register') }}"/>New user? Register here</p>    
                <!-- <a class="forgot" align="center" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a> -->
                
            </div>
        </div>
    </form>           
  </div>   
</body>
</html>
