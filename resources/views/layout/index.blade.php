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
<body id="body-layout">
        {{-- <nav class="navBar"> --}}
            {{-- <div id="logo"><img src="/images/logo3.png" alt="logo"></div>
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
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </nav>  --}}
        <header class="w-100 d-flex justify-content-between shadow-lg px-2">
            <div class="d-flex justify-content-center align-items-center">
                <img src="images/logo-icon.png" class="mr-2" width="50" alt="">
                
                <img src="images/logo-text.png" class="d-none d-sm-block" width="250" alt="">
            </div>
            <div class="d-flex justify-content-end align-items-center">
                <div class="d-flex justify-content-end align-items-center">
                    <div class="d-flex flex-column justify-content-start align-items-end mr-2">
                        <h5 class="mb-0 font-weight-bold profile-info">{{Auth::user()->username}}</h5>
                        <small class="text-right profile-info">{{Auth::user()->numero->numero}}</small>
                    </div>
                    <span class="rounded-circle bg-info p-1 d-flex justify-content-center align-items-center" style="width: 38px;">
                        <i class="fa fa-user text-white" style="font-size: 30px;"></i>
                    </span>
                    <button id="toggle">
                        <i class="fa fa-sort-desc" aria-hidden="true"></i>
                    </button>
                    <div id="navmenu">
                        <ul>
                            <li><a href="{{ route('user.index') }}"><i class="fa fa-line-chart" aria-hidden="true"></i>Main Dashboard</a></li>
                            <li><a href="{{ route('lectura.history') }}"><i class="fa fa-history" aria-hidden="true"></i>History</a></li>
                            <li><a href="javascript:alert('Profile')"><i class="fa fa-user" aria-hidden="true"></i>Profile</a></li>
                            <li id="logout"><a href="{{ route('user.auth.logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" style="color:#0053bf;"> 
                                <i class="fa fa-sign-out" aria-hidden="true"></i>Log Out</a></li>
                            <form id="logout-form" action="{{ route('user.auth.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <div id="header" class="mb-2">Bicycle route information Dashboard</div>
        @yield('content')
</body>
</html>
@yield('js')
<script type="text/javascript">
     $(document).ready(function() {
         console.log('AQUI ANDAMOSSS')
        var opened = false;
        $("#toggle").click(function() {
            if(!opened) {
                $('#navmenu').css('display', 'block');
                opened = true;
            }
            else {
                $('#navmenu').css('display', 'none');
                opened = false
            }

        });
     });
</script>
