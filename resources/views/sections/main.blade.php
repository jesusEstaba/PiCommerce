<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/main.css')!!}
	{!!Html::script('assets/jquery/jquery.min.js')!!}
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>


</head>
<body>
	<nav>
		<div class="container">
			<div class="dropdown">

				<a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-infosite visible-xs-inline-block">
					<span class="glyphicon glyphicon-menu-hamburger"></span>
				</a>

				<ul class="dropdown-menu" aria-labelledby="dLabel">
				
					<li role="presentation">
						<a role="menuitem" tabindex="-1" href="{{url('/choose')}}">Home</a>
					</li>
				

					@if( Auth::check() )	
						<li role="presentation">
							<a role="menuitem" tabindex="-1" href="{{url('logout')}}">
								Logout
							</a>
						</li>
					@else
						<li role="presentation">
							<a role="menuitem" tabindex="-1" href="{{url('login')}}">Login</a>
						</li>
					@endif
				</ul>




				
			</ul>
			<a href="{{url('/choose')}}" class="btn btn-infosite btn-info hidden-xs"><span class="glyphicon glyphicon-home"></span> Home</a>
			
			<?php
				$config = DB::table('config')->select('logo')->first();
			?>

			<a href="{{url('choose')}}">
				@if($config->logo)
					<img src="{{asset('images/logos/'.$config->logo)}}" alt="logo" class="logo">
				@endif
			</a>
			
			@if( Auth::check() )	
				<a class="btn btn-warning btn-cart" href="{{url('cart')}}">
					<span class="glyphicon glyphicon-shopping-cart"></span>
					<span>$<span class="total-in_cart">0.00</span></span>
				</a>
				<a class="btn btn-cart hidden-xs" href="{{url('logout')}}">
					Logout
				</a>
			@else
				<a href="{{url('login')}}" class="btn btn-default btn-cart">Login</a>
			@endif
		</div>
	</nav>


	@yield('content')
	
	@include('sections.footer')
	<script type="text/javascript">

	$(document).ready(function(){

		if( $(".btn-cart").text()!="Login" )
		{
			$.get('{{url("total_price_cart")}}', function(data) {
				$('.total-in_cart').html(data.total);
			});
		}

		
	});
	</script>
</body>
</html>