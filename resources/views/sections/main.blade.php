<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/main.css')!!}
	



</head>
<body>
	<nav>
		<div class="container">

				<a class="btn btn-infosite hidden-xs">About</a>
				<a class="btn btn-infosite hidden-xs">Gallery</a>
				<a class="btn btn-infosite hidden-xs">Contact</a>
				<a class="btn btn-default btn-infosite visible-xs-inline-block">
					<span class="glyphicon glyphicon-menu-hamburger"></span>
				</a>
			<a href="{{url('choose')}}">
				<img src="{{asset('images/logos/one.png')}}" alt="logo" class="logo">
			</a>
			
			@if( Auth::check() )	
				<a class="btn btn-warning btn-cart" href="{{url('cart')}}">
					<span class="glyphicon glyphicon-shopping-cart"></span>
					58,15$
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

</body>
</html>