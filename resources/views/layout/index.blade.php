<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/stylesheet.css">

    @yield('css')
</head>
<body>
    <div id="app" class="content"><!--La equita id debe ser app, como hemos visto en app.js-->
        <nav class="navBar">
            <div id="logo"><img src="/images/logo3.png" alt="logo"></div>
            <nav id="nav">
                <ul>
                    <li><a href="javascript:alert('Main')">Main Dshboard</a></li>
                    <li><a href="http://facebook">Weather</a></li>
                    <li><a href="javascript:alert('Something else')">Something else</a></li>
                </ul>
            </nav>
        </nav>   
        <div id="header">Bicycle route information Dashboard</div>
        @yield('content')
    </div>
    @yield('js')
    <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
</body>
</html>
