<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MAVERICK</title>
  <link rel="icon" href="{{url('img/logo.png')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ url('js/funciones.js')}}"></script>
  <style>
@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	font-family: Raleway, sans-serif;
}

body {
    overflow: hidden;
	background: linear-gradient(90deg, #f4c5c5, #cc6b6b);
}

.container {
	display: flex;
	align-items: center;
	justify-content: center;
	min-height: 100vh;
}

.screen {
	background: linear-gradient(90deg, #a45454, #b87878);
	position: relative;
	height: 600px;
	width: 360px;
	box-shadow: 0px 0px 24px #965656;
}

.screen__content {
	z-index: 1;
	position: relative;
	height: 100%;
}

.screen__background {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;
	z-index: 0;
	-webkit-clip-path: inset(0 0 0 0);
	clip-path: inset(0 0 0 0);
}

.screen__background__shape {
	transform: rotate(45deg);
	position: absolute;
}

.screen__background__shape1 {
	height: 520px;
	width: 520px;
	background: #fff;
	top: -50px;
	right: 120px;
	border-radius: 0 72px 0 0;
}

.screen__background__shape2 {
	height: 159px;
	width: 188px;
	background: #ac6363;
	top: -114px;
	right: 11px;
	border-radius: 32px;
    overflow:hidden;
}

.screen__background__shape3 {
	height: 540px;
	width: 190px;
	background: linear-gradient(270deg, #a45454, #9e6767);
	top: 120px;
	right: 10;
	border-radius: 32px;
}

.screen__background__shape4 {
	height: 400px;
	width: 200px;
	background: #b97b7b;
	top: 420px;
	right: 80px;
	border-radius: 60px;
}

.login {
	width: 320px;
	padding: 30px;
	padding-top: 20px;
}

.login__field {
	padding: 20px 0px;
	position: relative;
}

.login__icon {
	position: absolute;
	top: 30px;
	color: #b57575;
}

.login__input {
	border: none;
	border-bottom: 2px solid #363636;
	background: none;
	padding: 10px;
	padding-left: 24px;
	font-weight: 700;
	width: 75%;
	transition: .2s;
}

.login__input:active,
.login__input:focus,
.login__input:hover {
	outline: none;
	border-bottom-color: #9e6767;
}

.login__submit {
	background: #fff;
	font-size: 14px;
	margin-top: 30px;
	padding: 16px 20px;
	border-radius: 26px;
	border: 1px solid #fff;
	text-transform: uppercase;
	font-weight: 700;
	display: flex;
	align-items: center;
	width: 100%;
	color: #9d4848;
	box-shadow: 0px 2px 2px #965656;
	cursor: pointer;
	transition: .2s;
}

.login__submit:active,
.login__submit:focus,
.login__submit:hover {
	border-color: #9e6767;
	outline: none;
}

.button__icon {
	font-size: 24px;
	margin-left: auto;
	color: #b57575;
}

.social-login {
	position: absolute;
	height: 140px;
	width: 160px;
	text-align: center;
	bottom: 0px;
	right: 0px;
	color: #fff;
}

.social-icons {
	display: flex;
	align-items: center;
	justify-content: center;
}

.social-login__icon {
	padding: 20px 10px;
	color: #fff;
	text-decoration: none;
	text-shadow: 0px 0px 8px #b57575;
}

.social-login__icon:hover {
	transform: scale(1.5);
}

.swal2-popup {
    font-size: 1.6rem !important;
}
  </style>
</head>
<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form class="login" id="valida" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div >
                        <img style="" width="100px" src="{{url('/img/logo.png')}}">
                        <br><br>
                        <img style="" width="80%" src="{{url('/img/text-logo.png')}}">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="text" class="login__input" id="username" name="username" placeholder="Usuario">
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" id="password" name="password" placeholder="Contraseña">
                    </div>
                    <button type="submit" class="button login__submit">
                        <span class="button__text">Iniciar Sesion</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div class="social-login">
                    {{-- <h3>log in via</h3> --}}
                    {{-- <div class="social-icons">
                        <a href="#" class="social-login__icon fab fa-instagram"></a>
                        <a href="#" class="social-login__icon fab fa-facebook"></a>
                        <a href="#" class="social-login__icon fab fa-twitter"></a>
                    </div> --}}
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function(e){
    $("#valida").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('valida')}}",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                beforeSend: function(){
                    swalLoading();
                },
                success: function(response){
                    if(response.sta == '0'){
                    window.location.href = '{{route('index')}}';
                    }else{
                    swalTimer('warning',response.msg,2000);
                    }
                },
                error: function (error){
                    swalTimer('error','HA OCURRIDO UN ERROR, INTENTALO NUEVAMENTE',2000);
                }
            });
        });
    });

        $(function() {

    $('#login-form-link').click(function(e) {
        $("#login-form").delay(100).fadeIn(100);
         $("#register-form").fadeOut(100);
        $('#register-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });
    $('#register-form-link').click(function(e) {
        $("#register-form").delay(100).fadeIn(100);
         $("#login-form").fadeOut(100);
        $('#login-form-link').removeClass('active');
        $(this).addClass('active');
        e.preventDefault();
    });

    });

    </script>
</html>
