@extends('layout.index')

@section('css')
{{-- <link rel="stylesheet" href="/css/stylesheet.css"> --}}
@endsection

@section('content')
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    </head>
    <div id="divgps">
        <div class="titleDash">Route traveled</div>
        <div id="datosMapa"></div>
        <div id="app">
            <map-component></map-component>
        </div>
    </div>
    <div id="divtemperatura">
        <div class="titleDash">Temperature and Moisture</div>
        <div id="temp">
            <div class="data" id="dataT"></div>
            <div id="indicador" class="indicador"><i class="fa fa-thermometer-empty" aria-hidden="true"></i> Celsius</div>
        </div>
        <div id="moist">
            <div class="data" id="dataH"><h2></h2></div>
            <div id="indicador" class="indicador"><i class="fa fa-tint" aria-hidden="true"></i> Water vapor</div>
        </div>
    </div>
    <div id="divdistancia">
        <div class="titleDash">Proximity</div>
        <div id="images">
            <div id="dib1"><img src="/images/IconoCiclista.png" alt="ciclista" ></div>
            <div id="dib2"><img src="/images/CarroIcono.png" alt="auto" height="100px" width="100px"></div>
        </div>
        <div id="infoProx">
            <span id="titleProximity">titulo</span>
            <div class="proximidad">
                <span id="meters"></span>
            </div>
            <span id="datetime">fecha y hora</span>
        </div>
    </div>
@endsection
@section('js')
<script src="js/app.js"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->   
<!-- <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $.get("/api/getLastData/")
        .done(function sucess(response) {
            console.log(response);
            var mts = parseFloat(response.datos[0].proximity_back) / 100;
            var fecha= response.datos[0].lectura_fecha.split(' ')[0];
            var hora= response.datos[0].lectura_fecha.split(' ')[1];
            console.log(`fecha es ${fecha} y la hora es ${hora}`);
            $('#dataT').html(response.datos[0].lectura_temperatura+"°");
            $('#dataH').html(response.datos[0].lectura_humedad+"%");
            $('#meters').html(mts);
        });  
    });
</script>
@endsection


    
    
