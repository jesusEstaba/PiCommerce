<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/selection.css">
	
	<style type="text/css">
		body{
			background: url('images/backgrounds/wood.jpg') center center no-repeat fixed;
			background-size: cover;
		}
	</style>
</head>
<body>

@if( Session::has('message-error') )
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <strong>Warning!</strong> {{Session::get('message-error')}}.
	</div>
@endif



	<div class="container selections">
		<div class="row">
			<div class="col-md-offset-4 col-md-4 login-box">
				<img src="images/logos/one.png" alt="logo" class="logo-login">
				
				{!!Form::open(['url'=>'login'])!!}
					<div class="row">
						<div class="input-group col-xs-12">
							<input name="email" type="text" class="form-control" placeholder="Username or Email">
						</div>
						<div class="input-group col-xs-12">
							<input name="password" type="password" class="form-control" placeholder="Password">
						</div>
					</div>

					<div class="row">
						{!!Form::submit('Login', ['class'=>'btn btn-primary'])!!}

						{{-- <a class="btn btn-primary">Login</a> --}}
						<a href="/register" class="btn btn-success">Register</a>
						<a href="/choose" class="btn btn-warning">Skip</a>
					</div>
					{!!Form::token()!!}
				{!!Form::close()!!}
			</div>
		</div>
	</div>
	<div class="separator-fix-footer"></div>
	<footer>
		<p>
			3895 Lake Emma Rd #151, Lake Mary, FL 32746 Phone: (407) 333-2733 Fax: (407) 333-2733
		</p>
	</footer>
</body>
</html>