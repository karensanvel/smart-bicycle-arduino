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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-5">
                <div class="table-viajes box-container mb-4">viajes</div>
                <div class="routes-map box-container">mapa</div>
            </div>                
            <div class="col-12 col-sm-12 col-md-7">
                <div class="line-graph mb-4 box-container">lines graph</div>
                <div class="col two-boxes">
                    <div class="col-12 col-sm-12 col-md-7 ml-n3 box-container table-incidents">incident log</div>
                    <div class="col-12 col-sm-12 col-md-5 ml-4 box-container table-weather">weather</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="js/app.js"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->   

<script type="text/javascript">
    $(document).ready(function() {
    });
</script>
@endsection


    
    
