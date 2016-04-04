<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Selection</title>

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/selection.css')!!}

</head>
<body>
	<nav>
		<?php
				$config = DB::table('config')->select('logo')->first();
			?>
		<div class="container">
			@if($config->logo)
				<a href="{{url('choose')}}">
					<img src="{{asset('images/logos/'.$config->logo)}}" alt="logo" class="logo">
				</a>
				
			@endif
		</div>
	</nav>



		<div class="center-center">
			<div class="container">
				
				<div class="row">
					<div class="col-md-offset-3 col-md-6 ">
						<div class="row box">
							<a href="{{url('checkout/delivery')}}">
								<div class="col-md-6">
									<div class="orange-box box-type">
										<h2>Delivery</h2>
										<img src="{{asset('images/logos/pizza_delivery_man.png')}}" height="100">
									</div>
									
								</div>	
							</a>
							
							<a href="{{url('checkout/pickup')}}">
								<div class="col-md-6">
									<div class="blue-box box-type">
										<h2>Pick Up</h2>
										<img src="{{asset('images/logos/horno.png')}}" height="100">
									</div>
								</div>
							</a>
							
						</div>
					</div>
				</div>	
				
		</div>

			
		</div>

	@include('sections.footer')
	
</body>
</html>