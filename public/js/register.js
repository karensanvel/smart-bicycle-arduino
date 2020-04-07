$(document).ready(function() {
    var submit=$('input[type=submit]');
    //$('#username').val('prueba');

    /*$('#cambio').on('click', function () {
        if(submit.attr('value')=='Log in'){
            $('h3')[0].textContent= 'Sign up here';
            $('input[type=submit]').attr('value','Sign up');
            $('a')[0].textContent= 'I already have an account';
            $('#login').css('height','550px')
            $('.newUser').show();
            $('.newUser').css('display','block');
        }else{
            $('#username').val('');
            $('#password').val('');
            $('.newUser').hide();
            $('h3')[0].textContent= 'Log in here';
            $('input[type=submit]').attr('value','Log in');
            $('a')[0].textContent= 'Create an account';
            $('#login').css('height','450px')
        }
        
    });*/
    $('#submit').on('click', function () {
        console.log('ha entrado al submit')
            /*var $data = new FormData();
            $data.append('_token', '{{ csrf_token() }}');
            $data.append('_method', 'POST');
            $data.append('numero', $('#serialnumber').val());
            $data.append('name', $('#name').val());
            $data.append('username', $('#username').val());
            $data.append('password', $('#password').val());
            $data.append('password_confirmation', $('#password-confirmation').val());
            
            $.ajax({
                type: "POST",
                url: "/api/users/create",
                data: $data,
                cache: false,
                dataType: 'json',
                        
                //  

            })
            .done(function sucess(response) {
                $('#name').val("hola");
                $('#username').val("hola1");
                $('#password').val("");
                console.log('si')
                swal("¡Genial!", "¡Actualizado exitosamente!", "success");
            }).fail(function error(response){
                swal("Ups...", "¡Ha ocurrido un error!", "error");
                console.log(response);
            });*/

            var numero = $('#serialnumber').val();
            var name = $('#name').val();
            var username = $('#username').val();
            var password = $('#password').val();
            var nuevo_password_confirmation = $('#password_confirmation').val();
            var data = {"_token": "{{ csrf_token() }}", "serialNumber":numero, "name": name, "username": username, "password":password, "password_confirmation":nuevo_password_confirmation};
            
            $.post("{{route('user.datos.store')}}", data)
                .done(function sucess(response) {
                    $('#name').val("");
                    $('#username').val("");
                    $('#password').val("");
                    console.log('si')
                }).fail(function error(response) {
                    console.log(response);
                });
       
    } );
}); 