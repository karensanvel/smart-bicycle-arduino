<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartBicycle|User</title>
    <link rel="stylesheet" href="/css/stylesheet.css">

    @yield('css')
</head>
<body>
        <nav class="navBar">
            <div id="logo"><img src="/images/logo3.png" alt="logo"></div>
            <div id="user">
                <div id="profile_pic"></div>
                <div id="profile_info">
                    <span> Welcome,</span>
                    <h4>{{Auth::user()->name}}</h4>
                </div>
            </div>
            <nav id="nav">
                <ul>
                    <li><a href="javascript:alert('Main')">Main Dshboard</a></li>
                    <li><a href="http://facebook">Weather</a></li>
                    <li><a href="javascript:alert('Something else')">Something else</a></li>
                    <li><a href="{{ route('user.auth.logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Log Out</a></li>
                    <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                </ul>
            </nav>
        </nav>   
        <div id="header">Bicycle route information Dashboard</div>
        @yield('content')
    @yield('js')
</body>
</html>
