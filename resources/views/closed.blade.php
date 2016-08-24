<!DOCTYPE html>
<html lang="en">
<head>
	<title>Closed</title>
	@include('sections.headersCommon')
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
		
		@media (max-width: 991px) {
			.text-cerrado {
				padding: 1em;
				background: rgba(0,0,0,.2);
				border-radius: 3px;
			}
		}

	</style>
	
	@if(isset($background))
		<style type="text/css">
			body{
			background: url("{{asset('images/backgrounds/'.$background)}}") center center no-repeat fixed !important;
			background-size: cover !important;
			}
		</style>		
	@endif

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
							@if(isset($title))
								<h2>{{$title}}</h2>
							@else
								<h2>Closed</h2>
							@endif
							
						</div>
						<div class="col-xs-12">
							@if(isset($message))
								<p>{{$message}}</p>
							@elseif(isset($mon))
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