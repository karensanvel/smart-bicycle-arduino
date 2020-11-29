@extends('layout.index')

@section('css')
<link rel="stylesheet" href="/css/historyStyles.css">
@endsection

@section('content')
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    </head>
    <div id="header" class="mb-2 header">History</div>
    <div id="app" class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-5">
                <div class="table-viajes box-container mb-4">
                    <route-list-component></route-list-component>
                </div>
                <div class="routes-map box-container">
                    <current-route-component></current-route-component>
                </div>
            </div>                
            <div class="col-12 col-sm-12 col-md-7">
                <div class="mb-4 box-container">
                    <current-route-chart-component></current-route-chart-component>
                </div>
                <div class="col two-boxes">
                    <div class="col-12 col-sm-12 col-md-6 ml-n3 box-container table-incidents">
                        <span>Incident Log</span>
                        <div class="table-container">
                            <table id="alarmTable" class="table" cellspacing="0" width="100%">
                                <tbody>
                                </tbody>
                              </table>
                        </div> 
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 ml-4 box-container table-weather">
                        <span>Temperature and moisture</span>
                        <div class="table-container">
                            <table id="tempHumTable" class="table" cellspacing="0" width="100%">
                                <tbody>
                                </tbody>
                              </table>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="js/app.js"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->   

<script type="text/javascript">
    $(document).ready(function() {
        $.get("/api/history-tempHum/")
            .done(function sucess(response) {
                $.each(response.datos,function(key, value) {
                    $('#tempHumTable tbody').append(
                        `<tr>
                            <td>${value.fecha}</td>
                            <td><img src="/images/sun.png">${value.temperatura.toFixed(2)}°</td>
                            <td><img src="/images/humidity-icon.png">${value.humedad.toFixed(2)}%</td>
                        </tr>`             
                    );
                });
            }).fail(function error(response){
                console.log(response.error)
            });
        
            $.get("/api/history-alarm/")
            .done(function sucess(response) {
                console.log(response);
                $.each(response.datos,function(key, value) {
                    $('#alarmTable tbody').append(
                        `<tr>
                            <td>${value.fecha}</td>
                            <td>at ${value.hora} hrs</td>
                            <td><img src="/images/sos.png"></td>
                        </tr>`             
                    );
                });
            }).fail(function error(response){
                console.log(response.error)
            });
    });
</script>
@endsection


    
    
