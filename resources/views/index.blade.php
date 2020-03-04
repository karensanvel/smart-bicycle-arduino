@extends('layout.index')

@section('css')
<link rel="stylesheet" href="/css/stylesheet.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css">
@endsection

@section('content')
    <div id="divgps">
        <div class="titleDash">Route traveled</div>
        <div id="datosMapa"></div>
        <div id="app">
            <example-component></example-component>
        </div>
    </div>
    <div id="divtemperatura">
        <div class="titleDash">Temperature and Moisture</div>
        <div id="temp">temperature</div>
        <div id="moist">Humedity</div>
    </div>
    <div id="divdistancia">
        <div class="titleDash">Proximity</div>
        <div id="images">
            <div id="dib1"><img src="/images/IconoCiclista.png" alt="ciclista" ></div>
            <div id="dib2"><img src="/images/CarroIcono.png" alt="auto" height="100px" width="100px"></div>
        </div>
        <div id="infoProx"></div>
    </div>
@endsection
@section('js')
<script src="js/app.js"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->   
<script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
@endsection


    
    
