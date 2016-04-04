<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$title}}</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
		}
		body{
			background: #91C444;
			font-family: Helvetica;
		}
		.container{
			width: 100%;
			max-width: 500px;
			margin-left: auto;
			margin-right: auto;
		}
		section{
			padding: 2em;
			background: white;
			border-top:4px solid #84b934;
		}
		footer{
			padding: 2em;
			background: #F8F8F8;
			border-bottom-left-radius:8px;
			border-bottom-right-radius:8px; 
			border-top:1px solid #e6e6e6;
		}
		footer a{
			text-decoration: none;
			color:#587D20;
			margin-bottom: 2em;
		}
		header{
			padding-top: 1em;
		}
		header>img{
			display: block;
			margin-left: auto;
			margin-right: auto;
			height: 100px;
			max-width: 100%;
			margin-bottom: 1em;
		}
		.btn{
			display: inline-block;
			background:#91c444;
			color:white;
			padding: 1em 2em 1em 2em;
			border-radius: 10px;
			text-decoration: none !important;
			font-weight: bolder;
		}
		.pull-right{
			float: right;
		}
		h1, h1+p{
			margin-bottom: 1em;
		}
		h1+p{
			color: #ccc;
			font-size: .8em;
		}



	</style>
</head>
<body>
	<div style="background: #91C444;width: 100%;
			max-width: 500px;
			margin-left: auto;
			margin-right: auto;">
		<header>
		<img src="{{asset('images/logos/'.$logo)}}" alt="logo">
	</header>
		
		<section>
			<h1>Reset Your Password</h1>
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque malesuada cursus turpis non rhoncus. Donec non libero tortor. Donec convallis felis sagittis erat eleifend accumsan. Duis lobortis dignissim justo, vel sollicitudin purus ornare at. Nunc metus purus, placerat a semper at, euismod ut nunc
			</p>
			
			<div>
				<a style="display: inline-block;
			background:#91c444;
			color:white;
			padding: 1em 2em 1em 2em;
			border-radius: 10px;
			text-decoration: none !important;
			font-weight: bolder;float: right;" class="btn pull-right" target="_blank" href="{{url('/reset/'.$token_reset)}}">Reset</a>
			</div>
			
			
		</section>
		<footer>
			{!!$footer!!}
		</footer>

	</div>
	</div>
	<div style="width: 100%;height: 50px;">
		
	</div>
</body>
</html>