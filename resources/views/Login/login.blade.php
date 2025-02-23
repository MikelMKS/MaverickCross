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
@import url('https://fonts.googleapis.com/css?family=Poppins:400,700');

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
	font-family: Poppins, sans-serif;
}

body {
	background: #121212;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	position: relative;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('./../img/logo.png');
    background-repeat: repeat;
    background-size: 50px;
    opacity: 0.06;
    pointer-events: none;
    z-index: -1;
}

.container {
	background: #1e1e1e;
	padding: 40px;
	border-radius: 10px;
	box-shadow: 0px 5px 15px rgba(255, 255, 255, 0.1);
	width: 350px;
	text-align: center;
	color: white;
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}

.login__field {
	margin-bottom: 20px;
	position: relative;
}

.login__icon {
	position: absolute;
	top: 50%;
	left: 10px;
	transform: translateY(-50%);
	color: #3cb99b;
}

.login__input {
	width: 100%;
	padding: 10px 10px 10px 40px;
	border: 2px solid #3cb99b;
	border-radius: 5px;
	font-size: 16px;
	background: #252525;
	color: white;
}

.login__submit {
	background: #3cb99b;
	color: black;
	border: none;
	padding: 15px;
	width: 100%;
	border-radius: 5px;
	font-size: 16px;
	cursor: pointer;
	transition: background 0.3s;
}

.login__submit:hover {
	background: rgb(253, 134, 7);
	color: white;
}
  </style>
</head>
<body>
    <div class="container">
        <img width="100px" src="{{url('/img/logo.png')}}">
        <h1 style="color: #3cb99b; margin-bottom: 10px;">MAVERICK</h1>
        <h5 style="color: #3cb99b; margin-bottom: 20px;">Iniciar Sesión</h5>
        <form id="valida" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="login__field">
                <i class="login__icon fas fa-user"></i>
                <input type="text" class="login__input" id="username" name="username" placeholder="Usuario">
            </div>
            <div class="login__field">
                <i class="login__icon fas fa-lock"></i>
                <input type="password" class="login__input" id="password" name="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="login__submit">Iniciar Sesión</button>
        </form>
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

</script>
</html>
