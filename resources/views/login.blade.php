<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/login.css')!!}
	
</head>
<body>

@if( Session::has('message-error') )
	<div class="alert alert-danger alert-dismissable">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <strong>Warning!</strong> {{Session::get('message-error')}}.
	</div>
@endif


<div class="center-center">
	<div class="container">
		<div class="row">
			
			<div class="col-md-offset-4 col-md-4 login-box">
			<?php
				$config = DB::table('config')->select('logo')->first();
			?>
				<a href="{{url('/')}}">
					@if($config->logo)
						<img src="{{asset('images/logos/'.$config->logo)}}" alt="logo" class="logo">
					@endif
				</a>
				
				
				{!!Form::open(['url'=>'login'])!!}
					<div class="row">
						<div class="input-group col-xs-12">
							<input name="email" type="text" class="form-control" placeholder="Username or Email">
						</div>
						<div class="input-group col-xs-12">
							<input name="password" type="password" class="form-control" placeholder="Password">
						</div>

						<a href="#">Forgot your password?</a>
					</div>

					<div class="row">
						<input class="btn btn-primary" type="submit" value="Login">
						<a href="{{url('register')}}" class="btn btn-success">Register</a>
						<a href="{{url('choose')}}" class="btn btn-warning">Skip</a>
					</div>
					{!!Form::token()!!}
				{!!Form::close()!!}
			</div>

		</div>
	</div>
</div>

	@include('sections.footer')
</body>
</html>