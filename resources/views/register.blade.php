<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SmartBicycle | </title>
    <!-- NProgress -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    {{-- <script src="/js/register.js" type="text/javascript"></script> --}}
    <link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/login.css">
  </head>
  <body>
      <header>
          <div><img src="/images/logo-icon.png">SmartBicycle</div>
      </header>
      <div id="big">
        <div id="text">
            <div id="slogan">
                SmartBicycle, por la seguridad del ciclista
            </div>
            <div id="mensaje">
                "Buscamos brindar la seguridad del ciclista a partir de un producto conformado por tecnología para la prevención de accidentes” <br/><br/><br/>
                 Team SmartBicycle
            </div>
        </div>
        <div id="loginSection">
            <div id="loginRegister">
                <h3>Sign up here</h3>
                {{-- <form method="POST" action="{{ route('user.store.add') }}"> 
                    {{ csrf_field() }} --}}
                    <label for="serialnumber" class="newUser">Serial number</label>
                    <div>
                        <input type="number" class="newUser" id="serialnumber" name="serialnumber" placeholder="Enter serial number">
                        {{-- <i class="fa fa-question-circle" id="icon-question" aria-hidden="true"></i> --}}
                    </div>
                    <h6 class="error" id="errNumber">error</h6>
                    <label for="name" class="newUser">Name</label>
                    <input type="text" class="newUser" id="name" name="name" placeholder="Enter full name">
                    <h6 class="error" id="errName">error</h6>
                    <label for="username">Username</label> 
                    <input type="text" id="username" name="username" placeholder="Enter username" required autofocus>
                    <h6 class="error basic" id="errUsername">error</h6>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" required autofocus>
                    <h6 class="error basic" id="errPassword">error</h6>
                    <label for="password-confirmation" class="newUser">Password confirmation</label>
                    <input type="password" class="newUser" id="password_confirmation" name="password_confirmation" placeholder="Enter confirmation password">
                    <h6 class="error basic" id="errPasswordCon">error</h6>
                    <button type="submit" id="submit">Sign up</button>
                    {{-- <input type="submit" value="Sign up" id="submit" onclick=""> --}}
                    <a id="cambio" href="{{ route('user.login') }}">I already have an account</a>
                {{-- </form> --}}
            </div> 
        </div>
      </div>   
  </body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        var numser;
        $('#serialnumber').on('input', function(){
            var numero = $('#serialnumber').val();
            if(numero.length==10){
                $.get("/api/numeroSerial/"+numero)
                .done(function sucess(response) {
                    if(response.length==1){  //encontro el numero en la bd
                        console.log(response);
                        numser= response[0].id; //toma el id del numero
                        $.get("/api/numeroserial/"+numser)
                        .done(function sucess(response){
                            if(response.length==1){ //encontro el id del numero serial ya usado
                                $('#serialnumber').css('color', 'red');
                                $('#errNumber').css('visibility','visible')
                                $('#errNumber').html('*serial number not available')
                            }else{                                              //el numero no esta usado
                                console.log('este numero no esta usado');
                                $('#serialnumber').css('color', 'black');
                                $('#errNumber').css('visibility','hidden')
                            }     
                        }).fail(function error(response){ console.log(response);});
                        $('#serialnumber').css('color', 'black');
                        $('#errNumber').css('visibility','hidden')
                    }else{
                        console.log(response.length);
                        $('#serialnumber').css('color', 'red');
                        $('#errNumber').css('visibility','visible')
                        $('#errNumber').html('*wrong serial number')
                    } 
                }).fail(function error(response) {
                    console.log('NO SE ENCONTRO')
                    console.log(response);
                    
                });     
            }else{
                $('#errNumber').css('visibility','visible')
                $('#errNumber').html('*serial number must be 10 numbers');
            }  
        });

        $('#username').on('input', function(){
            var username = $('#username').val();
            if(username.length>4 && username.length<21){
                $.get("/api/user/"+username)
                .done(function sucess(response) {
                    if(response.length==1){
                        console.log(response);
                        $('#username').css('color', 'red');
                        $('#errUsername').html('*username not available')
                        $('#errUsername').css('visibility','visible')
                    }else{
                        console.log(response.length);
                        $('#username').css('color', 'black')
                        $('#errUsername').css('visibility','hidden')
                    } 
                }).fail(function error(response) {
                    console.log('NO SE ENCONTRO')
                    console.log(response);
                });   
            }else{
                $('#errUsername').html('*username between 5 to 20 characteres')
                $('#errUsername').css('visibility','visible')
                $('#username').css('color', 'red');
            }
              
        });
        $('#name').on('input', function(){
            var nombre=$('#name').val();
            if(nombre.split(' ').length > 1){
                $('#errName').css('visibility','hidden')
            }
            else{
                $('#errName').css('visibility','visible')
                $('#errName').html('*name and lastname')
            }
        });
        $('#password').on('input', function(){
            var pass=$('#password').val();
            if(pass.length > 6 && pass.length <21){
                $('#errPassword').css('visibility','hidden')
            }
            else{
                $('#errPassword').css('visibility','visible')
                $('#errPassword').html('*password must be at least 7 characteres')
            }
        });
        $('#password_confirmation').on('input', function(){
            var pass=$('#password_confirmation').val();
            if($('#password_confirmation').val()==$('#password').val()){
                $('#errPasswordCon').css('visibility','hidden')
            }
            else{
                $('#errPasswordCon').css('visibility','visible')
                $('#errPasswordCon').html('*password confirmation does not match')
            }
        });
        $('#submit').on('click', function () {
                var numero = $('#serialnumber').val();
                var name = $('#name').val();
                var username = $('#username').val();
                var password = $('#password').val();
                var nuevo_password_confirmation = $('#password_confirmation').val();
                var data = {"_token": "{{ csrf_token() }}", "serialNumber":numser, "name": name, "username": username, "password":password, "password_confirmation":nuevo_password_confirmation};
                $.post("{{route('user.datos.store')}}", data)
                    .done(function sucess(response) {
                        $('#serialnumber').val("");
                        $('#name').val(""); 
                        $('#username').val("");
                        $('#password').val("");
                        $('#password_confirmation').val("");
                        console.log('si')
                        var dominio='/login';
                        window.location.href=dominio;
                    }).fail(function error(response){
                        console.log(response);
                        // if(response.status==500){
                        //     $('.basic').css('visibility', 'visible');
                        //     $('.basic').html('*please fill out this field')
                        // }
                        // if(response.status==422){
                        //     $('.basic').css('visibility', 'visible');
                        //     $('.basic').html('*please fill out this field')
                        // }
                    });
        } );
    }); 
</script>