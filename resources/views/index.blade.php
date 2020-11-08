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
            <div class="col-12 col-md-7 mb-4">
                <div id="graph-speed-div" class="mb-4">
                    graficas de velocidades
                    <div class="graph-speed"></div>
                    <div class="graph-speed"></div>
                    <div class="graph-speed"></div>
                </div>
                <div id="divgps" class="bg-white">
                    <div class="titleDash">Route traveled</div>
                    <div id="app">
                        <map-component></map-component>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-5 mb-4">
                <div class="col-12 col-md-12 container-two-box mb-4">
                    <div id="divtemperatura" class="col-12 col-md-5">
                        {{-- <div class="titleDash">Temperature and Moisture</div> --}}
                        <div id="temp">
                            <div class="titleTempHum">Temperature</div>
                            <div class="tempHum-data-icon">
                                <div class="data" id="dataT"></div>
                                <div class="tempHum-icon">
                                    <img src="/images/sun.png">
                                </div>
                            </div>
                            <div class="indicador">
                                <i class="fa fa-thermometer-empty" aria-hidden="true"></i>
                                <span>Celsius</span>
                            </div>
                        </div>
                        <div id="moist">
                            <div class="titleTempHum">Moisture</div>
                            <div class="tempHum-data-icon">
                                <div class="data" id="dataH"></div>
                                <div class="tempHum-icon">
                                    <img src="/images/humidity-icon.png">
                                </div>
                            </div>
                            <div class="indicador">
                                <i class="fa fa-tint" aria-hidden="true"></i>
                                <span>Water vapor</span>
                            </div>
                        </div>
                    </div>
                    <div id="alarm" class="col-12 col-md-7">
                        <div id="panicbutton-legend">Panic button disabled</div>
                        <div class="panicbutton">
                            <div id="circle-out">
                                <div id="circle-in">
                                    <span>SOS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             
                <div id="divdistancia">
                    {{-- <div class="titleDash">Proximity</div> --}}
                    {{-- <div id="images">
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
                    </div> --}}
                    <div class="prox-title">Distance between cyclist and object</div>
                    <div class="prox-data">deployment of data... datos de la proximidad aqui...</div>
                    <div class="prox-icons">
                        <i class="fa fa-cloud" aria-hidden="true"></i>
                        <img class=" fa-cloud diff-cloud" src="/images/cloud2.png">
                        <img class="fa-cloud moon-icon" src="/images/cloud-moon.png">
                    </div>
                    <div class="prox-icons box-icons-arbustos">
                        <img class="arbusto-icon" src="/images/arbusto1.png">
                        <img class="arbusto-icon" src="/images/arbusto2.png">
                        <img class="arbusto-icon" src="/images/arbusto3.png">
                        <img class="arbusto-icon" src="/images/arbusto4.png">
                    </div>
                    <div class="prox-road">
                        <div class="car-area"><img class="car-icon" src="/images/carr.png"></div>
                        <div class="cyclist-area"><img class="cyclist-icon" src="/images/cyclist.png"></div>
                    </div>
                    <div class="prox-green">
                        <img class="roca-icon" src="/images/roca.png">
                        <img class="roca-icon" src="/images/roca2.png">
                        <img class="roca-icon" src="/images/roca.png">
                        <img class="roca-icon" src="/images/roca3.png">
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


    
    
