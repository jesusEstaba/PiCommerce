<!DOCTYPE html>
<html lang="en">
<head>
	<title>Checkout</title>

	@include('sections.headersCommon')

	{!!Html::style('css/selection.css')!!}

</head>
<body>
	<nav>
		<div class="container">
			@if($logo = HelperWebInfo::logo())
				<a href="{{url('menu')}}">
					<img src="{{asset('images/logos/'.$logo)}}" alt="logo" class="logo">
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

							@if( Auth::check() )
								<a href="{{url('checkout/pickup')}}">
							@else
								<a href="{{url('checkout/quick')}}">
							@endif
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