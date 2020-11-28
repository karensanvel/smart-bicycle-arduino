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

        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/highcharts-more.js"></script>
        <script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    </head>
    <div id="header" class="mb-2">Bicycle route information Dashboard</div>
    <div id="app" class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-7 mb-4">
                <div class="mb-4 d-flex">
                    <div class="graph-speed">
                        <last-route-travel-time-component></last-route-travel-time-component>
                    </div>
                    <div class="graph-speed">
                        <last-route-distance-traveled-component></last-route-distance-traveled-component>
                    </div>
                    <div class="graph-speed">
                        <last-route-speed-component></last-route-speed-component>
                    </div>
                </div>
                <div id="divgps" class="bg-white">
                    <div class="titleDash">Route traveled</div>
                    <last-route-component></last-route-component>
                </div>
            </div>
            <div class="col-12 col-md-5 mb-4">
                <div class="col-12 col-md-12 container-two-box mb-4">
                    <div id="divtemperatura" class="col-12 col-md-5">
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
                                    <div>
                                        <span>SOS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="divdistancia">
                    <div class="prox-title">Distance between cyclist and object</div>
                    <div class="prox-data">
                        <div class="container-data-prox">
                            <span id="datetime">september, 25th 23:45:54 pm</span>
                        </div>
                        <div class="container-data-prox">
                            <div class="item-prox">
                                <div class="proximidad data-label">
                                    <span id="meters">3.56 Mts</span>
                                </div>
                                <div class="label">Close distance to object</div>
                            </div>
                            <div class="item-prox">
                                <div class="data-label">
                                    <span id="calle">Lazaro Cardenas 9564</span>
                                </div>
                                <div class="label">Ubication</div>
                            </div>
                            <div class="item-prox">
                                <span id="titleProximity">Everything is ok</span>
                            </div>
                        </div>
                    </div>
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
        var ocupado = false;
       
        function loadDashboard (){
            $.get("/api/getLastData/")
            .done(function sucess(response) {
                console.log(response);
                var mts = parseFloat(response.datos[0].proximity_back) / 100;
                var centimetros = parseInt(response.datos[0].proximity_back);
                var fecha= response.datos[0].lectura_fecha.split(' ')[0];
                var hora= response.datos[0].lectura_fecha.split(' ')[1];
                var alarma = response.datos[0].alarm;
                
                if(alarma === '1') {
                    console.log('LA ALARMA ES ', alarma);
                    if(ocupado != true) {
                        sendAlert(alarma);
                    }
                    $('#panicbutton-legend').html('Alarm activated')
                    $('#panicbutton-legend').css('color', 'red')
                    $('#circle-in div').fadeIn(300, function () {
                        $('#circle-in div').css('background', 'red');
                        $('#circle-in div span').css('color', 'white');

                    });
                    $('#circle-in div').fadeOut(300, function () {
                        $('#circle-in div').css('background', 'transparent');
                        $('#circle-in div span').css('color', 'red');
                    });
                }
                else {
                    ocupado = false;
                    $('#panicbutton-legend').html('Panic button disabled');
                    $('#panicbutton-legend').css('color', 'white');
                    $('#circle-in div').css('display', 'flex');
                }

                if(centimetros <= 70){
                    $('#titleProximity').css('color', 'red')
                    $('#titleProximity').html("Lock out!");
                    $('#car').css("margin-bottom", "92px");
                }
                else if(centimetros > 70 && centimetros < 140){
                    $('#titleProximity').html("Warning! Object close");
                    $('#titleProximity').css('color', 'orange');
                    $('#car').css('margin-bottom', '60px'); 
                }
                else {
                    $('#titleProximity').html("Everything is ok");
                    $('#titleProximity').css('color', '#13da13');
                    $('#car').css('margin-bottom', '0px');
                }	
                $('#dataT').html(response.datos[0].lectura_temperatura+"°");
                $('#dataH').html(response.datos[0].lectura_humedad+"%");
                $('#meters').html(mts);
                $('#datetime').html(hora);
            });  
        }
        function sendAlert(alarm) {  
            $.get("/api/sendAlertEmail/" + "{{Auth::user()->username}}")
            .done(function sucess(response) {
                console.log('SE HA ENVIADO EL CORREO (SOLO UNA VEZ)');
            });
            ocupado = true;
        }
    });
</script>

@endsection


    
    
