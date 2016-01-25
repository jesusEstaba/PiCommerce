<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<nav>
		<div class="container">
			<a class="btn btn-infosite">About</a>
			<a class="btn btn-infosite">Gallery</a>
			<a class="btn btn-infosite">Contact</a>

			<a href="/choose">
				<img src="images/logos/one.png" alt="logo" class="logo">
			</a>

			<a class="btn btn-warning btn-cart" href="/cart">
				<span class="glyphicon glyphicon-shopping-cart"></span>
				58,15$
			</a>
		</div>
	</nav>
	@yield('content')
	<div class="separator-fix-footer"></div>
	<footer>
		<p>
			3895 Lake Emma Rd #151, Lake Mary, FL 32746 Phone: (407) 333-2733 Fax: (407) 333-2733
		</p>
	</footer>
</body>
</html>