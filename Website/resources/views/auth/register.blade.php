<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type = "text/css" href="/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title>Register</title>
    </head>
    <body>  
        <div class="regmain">
            <p class="sign" align="center">Create a new account. </p>
            <form method="POST" action="{{ route('register') }}" class="form1">
                @csrf
                <div>
                    <div>
                        <input id="firstName" type="text" class="firstname" name="firstName" align="center" placeholder="First Name" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>
                    </div>
                </div>
            
                <div>
                    <div>
                        <input id="lastName" type="text" class="lastname" align="center" placeholder="Last Name" name="lastName" value="{{ old('lastName') }}" required autocomplete="lastName" autofocus>
                    </div>
                </div>
            
                <div>
                    <div>
                        <input id="email" type="email"  name="email" class="un " align="center" placeholder="Fill in your email" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div>
            
                <div>
                    <div>
                        <input id="password" type="password"  name="password" class="pass" align="center" placeholder="Choose a strong password" required autocomplete="new-password">     
                    </div>
                </div>
            
                <div>
                    <div>
                        <input id="password-confirm" type="password" name="password_confirmation" class="pass" align="center" placeholder="Confirm your password" required autocomplete="new-password">
                    </div>
                </div>
            
                <div>
                    <div>
                        <input id="phone" type="text" name="phone" class="lastname" align="center" placeholder="Phone number" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    </div>
                </div>
            
                <div>
                    <div>
                        <button type="submit" align="center" class="submit"> 
                            {{ __('Register') }}
                        </button>
                        
                    </div>
                    
                </div>
                <div></div>
                <div></div>
                
            </form>
        </div>
    </body>
</html>
