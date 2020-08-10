<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBicycle | dashboard</title>
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/stylesheet.css">

    @yield('css')
</head>
<body>
        <nav class="navBar">
            <div id="logo"><img src="/images/logo3.png" alt="logo"></div>
            <div id="user">
                <div id="profile_info">
                    <h4>Welcome, {{Auth::user()->username}}</h4>
                    <div>
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <h3>{{Auth::user()->name}}</h3>
                    </div>
                    <div>
                        <i class="fa fa-bicycle" aria-hidden="true"></i>
                        <h5>{{Auth::user()->numero->numero}}</h5>
                    </div>
                    {{-- <h5>{{Auth::user()->getNumber(Auth::user()->idNumero)[0]->numero}}</h5> --}}
                </div>
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="{{ route('user.index') }}"><i class="fa fa-line-chart" aria-hidden="true"></i>Main Dashboard</a></li>
                    <li><a href="http://facebook"><i class="fa fa-bolt" aria-hidden="true"></i>Weather</a></li>
                    <li><a href="javascript:alert('Something else')"><i class="fa fa-thermometer-three-quarters" aria-hidden="true"></i>Something else</a></li>
                    <li id="logout"><a href="{{ route('user.auth.logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" style="color:white;"> 
                        <i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
                    <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </ul>
            </nav>
        </nav>   
        <div id="header">Bicycle route information Dashboard</div>
        @yield('content')
</body>
</html>
@yield('js')
