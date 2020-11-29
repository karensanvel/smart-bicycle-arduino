<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartBicycle | </title>
    <!-- NProgress -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="/css/login.css">
  </head>
  <body>
      <div class="mask">
        <header>
            <div><img src="/images/logo-icon.png"> SmartBicycle</div>
        </header>
        <div id="big">
            <div id="text">
                <div id="slogan">
                    SmartBicycle, por la seguridad del ciclista
                </div>
                <div id="mensaje">
                    "Buscamos brindar la seguridad del ciclista a partir de un producto conformado por tecnología para la prevención de accidentes” <br/><br/><br/>
                     Team SmartBicycle
                </div>
            </div>
            <div id="loginSection">
                <div id="login">
                    <h3>Login here</h3>
                    <form method="POST" action="{{ route('user.login.submit') }}">
                        {{ csrf_field() }}
                        @if(session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <label for="username">Username</label>
                        <input type="text" id="username" class="login-input" name="username" value="{{ old('username') }}" placeholder="Enter username" required autofocus>
                        <label for="password">Password</label>
                        <input type="password" id="password" class="login-input" name="password" value="{{ old('password') }}" placeholder="Enter password" required autofocus>
                        <input type="submit" value="Log in" id="submit">
                        <div class="href-log-reg">
                            <a id="cambio" href="{{ route('user.register') }}">Create a new account</a>
                        </div> 
                    </form>
                </div> 
            </div>
          </div>   
      </div>
    
  </body>
</html>