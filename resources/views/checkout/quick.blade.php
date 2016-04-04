<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quick</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/login.css')!!}
{{--
	<style type="text/css">
	body{
		background: url("{{asset('images/backgrounds/'.$config->background)}}") center center no-repeat fixed !important;
  		background-size: cover !important;
	}
	</style>--}}
	
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

				<a href="{{url('/')}}">
					@if($config->logo)
						<img src="{{asset('images/logos/'.$config->logo)}}" alt="logo" class="logo">
					@endif
				</a>
				
				{!!Form::open(['url'=>'login'])!!}
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<input name="first" type="text" class="form-control" placeholder="First Name">
							</div>
							<div class="form-group">
								<input name="last" type="text" class="form-control" placeholder="Last Name">
							</div>
							<div class="form-group">
								<input name="number" type="text" class="form-control" placeholder="Number">
							</div>
							<div class="form-group">
								<input name="email" type="text" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<p>
									<b style="color:white;">
										I have read the terms and conditions notice and I agree to it:
									</b>
									<input name="terms" type="checkbox">
								</p>					
								<a href="#">Terms and Conditions.</a>
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<a class="btn btn-primary">Pay</a>
						</div>				
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