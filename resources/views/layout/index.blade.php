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
        <!-- <nav class="navBar">
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
        </nav>    -->
        <header class="w-100 d-flex justify-content-between shadow-lg px-2" style="height: 70px;position: relative; overflow: hidden; background-color: #f8f9fa;">
            <div class="d-flex justify-content-center align-items-center">
                <img src="images/logo-icon.png" class="mr-2" width="50" alt="">
                <img src="images/logo-text.png" class="d-none d-sm-block" width="250" alt="">
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex flex-column justify-content-start align-items-end mr-2">
                        <h5 class="mb-0 font-weight-bold">Daniel Ramirez</h5>
                        <small class="text-right">Premium</small>
                    </div>
                    <span class="rounded-circle bg-info p-1 d-flex justify-content-center align-items-center" style="width: 38px;">
                        <i class="fa fa-user text-white" style="font-size: 30px;"></i>
                    </span>
                </div>
            </div>
        </header>
        <div id="header">Bicycle route information Dashboard</div>
        @yield('content')
</body>
</html>
@yield('js')
