<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Closed</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/login.css')!!}
	<style type="text/css">
	.text-cerrado h2{
		color:white;
		text-align: center;
		margin-bottom: 1em;
	}
	.text-cerrado{
		color:#bbb;
	}
	.text-cerrado p{
		margin: 0;
	}
	.login-box{
		top:-150px;
	}

	@media (max-width: 991px) {
		.login-box{
			top:0;
		}
	}
	</style>
</head>
<body>

<div class="center-center">
	<div class="container">
		<div class="row">
			
			<div class="col-md-offset-4 col-md-4">
			<div class="login-box">

				<a href="{{url('/')}}">
					@if($logo)
						<img src="{{asset('images/logos/'.$logo)}}" alt="logo" class="logo">
					@endif
				</a>
				<div class="text-cerrado">
					<div class="row">
						<div class="col-xs-12">
							<h2>Closed</h2>
						</div>
						<div class="col-xs-12">
							@if($message)
								<p>{{$message}}</p>
							@else
								<table class="table">
									<tr>
										<td><b>Monday</b></td>
										<td>{{$mon}}</td>
									</tr>

									<tr>
										<td><b>Tuesday</b></td>
										<td>{{$tue}}</td>
									</tr>
									<tr>
										<td><b>Wedesday</b></td>
										<td>{{$wed}}</td>
									</tr>
									<tr>
										<td><b>Thursday</b></td>
										<td>{{$thu}}</td>
									</tr>
									<tr>
										<td><b>Friday</b></td>
										<td>{{$fri}}</td>
									</tr>
									<tr>
										<td><b>Saturday</b></td>
										<td>{{$sat}}</td>
									</tr>
									<tr>
										<td><b>Sunday</b></td>
										<td>{{$sun}}</td>
									</tr>
								</table>
							@endif
						</div>
					</div>
				</div>
			</div>
			</div>

		</div>
	</div>
</div>
	@include('sections.footer')
</body>
</html>