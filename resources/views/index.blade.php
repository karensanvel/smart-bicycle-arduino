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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <div id="divgps" class="bg-white">
                    <div class="titleDash">Route traveled</div>
                    <div id="datosMapa"></div>
                    <div id="app">
                        <map-component></map-component>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <div id="divtemperatura" class="mb-4">
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
                        <div id="dib2"><img id="car" src="/images/CarroIcono.png" alt="auto" height="100px" width="100px"></div>
                    </div>
                    <div id="infoProx">
                        <div class="item-prox">
                            <span id="titleProximity"></span>
                        </div>
                        <div class="item-prox">
                            <div class="proximidad">
                                <span id="meters"></span>
                            </div>
                        </div>
                        <div class="item-prox">
                            <span id="datetime">fecha y hora</span>
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
        setInterval(() => {
            loadDashboard();
        }, 1000);

        function loadDashboard (){
            $.get("/api/getLastData/")
            .done(function sucess(response) {
                console.log(response);
                var mts = parseFloat(response.datos[0].proximity_back) / 100;
                var centimetros = parseInt(response.datos[0].proximity_back);
                var fecha= response.datos[0].lectura_fecha.split(' ')[0];
                var hora= response.datos[0].lectura_fecha.split(' ')[1];
                if(centimetros <= 70){
                    $('#titleProximity').css('color', 'red')
                    $('#titleProximity').html("Lock out!");
                    $('.proximidad').css("border-color", "red" );
                    $('#meters').css('color', 'red')
                    $('#car').css("margin-bottom", "92px");
                }
                else if(centimetros > 70 && centimetros < 140){
                    $('#titleProximity').html("Warning! Object close");
                    $('#titleProximity').css('color', 'orange');
                    $('.proximidad').css( "border-color", "yellow" );
                    $('#meters').css('color', 'orange');
                    $('#car').css('margin-bottom', '60px'); 
                }
                else{
                    $('.proximidad').css( "border-color", "rgb(136, 207, 248)" );
                    $('#car').css('margin-bottom', '0px');
                }	
                $('#dataT').html(response.datos[0].lectura_temperatura+"°");
                $('#dataH').html(response.datos[0].lectura_humedad+"%");
                $('#meters').html(mts);
                $('#datetime').html(hora);
            });  
        }
    });
</script>
@endsection


    
    
