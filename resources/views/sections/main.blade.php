<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/main.css')!!}
	{!!Html::script('assets/jquery/jquery.min.js')!!}



</head>
<body>
	<nav>
		<div class="container">
				<a href="{{url('/choose')}}" class="btn btn-infosite hidden-xs">Home</a>
				<a href="{{url('/diginos#about')}}" class="btn btn-infosite hidden-xs">About</a>
				<a href="{{url('/diginos#gallery')}}" class="btn btn-infosite hidden-xs">Gallery</a>
				<a href="{{url('/diginos#contact')}}" class="btn btn-infosite hidden-xs">Contact</a>
				<a class="btn btn-default btn-infosite visible-xs-inline-block">
					<span class="glyphicon glyphicon-menu-hamburger"></span>
				</a>
			<a href="{{url('choose')}}">
				<img src="{{asset('images/logos/one.png')}}" alt="logo" class="logo">
			</a>
			
			@if( Auth::check() )	
				<a class="btn btn-warning btn-cart" href="{{url('cart')}}">
					<span class="glyphicon glyphicon-shopping-cart"></span>
					<span class="total-in_cart">0.00$</span>
				</a>
				<a class="btn btn-cart" href="{{url('logout')}}">
					Logout
				</a>
			@else
				<a href="{{url('login')}}" class="btn btn-info btn-cart">Login</a>
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
				$('.total-in_cart').html(data.total+"$");
			});
		}
	});
	</script>
</body>
</html>