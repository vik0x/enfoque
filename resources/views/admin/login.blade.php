<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.bootcss.com/animate.css/3.4.0/animate.css">
	<style>
		body{
			background: #111517;
			color:  #F9F9F9;
		}
		.container-login{
			/*width: 50%;*/
			margin:auto;
			text-align: center;
			padding: 3%;
			/*border:3px solid #F9F9F9;*/
			margin-top: 2%;
			border-radius:5px;
			float: initial;
			overflow:  hidden;
		}
		.container-login form
		{
			width: 80%;
			margin: auto;
		}
		.login-footer{
			text-align: right;;
		}
		.login-footer .btn
		{
			width: 100%;
			background: transparent;;
			border :2px solid white;
			color :white;
		}
		.login-header{
			text-align: center;
		}
		.login-header h3{
			margin: 4%
		}
		.login-header p{
			font-size: 0.9em;
			font-style: italic;
			margin-bottom: 10%;
		}
		.logo img
		{
			width: 39%;
			margin: 4%;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-xs-12 col-sm-12">
				<div class="container-login col-sm-6">
					<form action="{{url('validar.html')}}" class="animate " style="animation-duration:0.7s;" method="post">
						<input type="hidden" name="_method" value="patch"><input type="hidden" name="_token" value="{{csrf_token()}}">
						<div class="login-header fadeInDown" style="animation-duration:.9s; ">
							<div class="logo">
								<img src="{{asset('assets/img/enfoquelogo.png')}}" alt="">
							</div>
							<h3 >ADMINISTRADOR</h3>
						</div>
						<div class="form-group animate slideInLeft" style="animation-duration:0.9s; ">
							<div class="input-group">
								<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-user"></span></span>
							<input type="text" class="form-control" placeholder="Usuario" aria-describedby="sizing-addon2" name="usuario">
							</div>
						</div>
						<div class="form-group animate slideInRight" style="animation-duration:0.9s; ">
							<div class="input-group">
								<span class="input-group-addon" id="sizing-addon2"><span class="glyphicon glyphicon-lock"></span></span>
								<input type="password" class="form-control" placeholder="Contraseña" aria-describedby="sizing-addon2" name="psw">
							</div>
						</div>
						<div class="login-footer animate flipInX" style="animation-duration:.9s; ">
							<button type="submit" class="btn btn-default">INICIAR SESIÓN</button>
						</div>
					</form>
		
				</div>
			</div>
		</div>
	</div>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>