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
@endsection
@section('js')
<script src="js/app.js"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->   

<script type="text/javascript">
    $(document).ready(function() {
    });
</script>
@endsection


    
    
