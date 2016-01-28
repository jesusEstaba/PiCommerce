@extends('sections.main')

@section('title', 'Category')
@section('content')

@if($banner)
<style type="text/css">
	.image-category{
		background:url("{{asset('images/banners/'.$banner)}}") center center fixed no-repeat;
		background-size:cover; 
	}
</style>
@endif


	<section class="image-category">
		<h2 class="title">{{$name_category}}</h2>
	</section>
	
	<section class="name-category">
		<div class="container">
			<ul>
				<li><a href="{{url('category/PIZZAS')}}">Pizzas</a></li>
				<li><a href="{{url('category/APPETIZ')}}">Appetiz</a></li>
				<li><a href="{{url('category/PASTAS')}}">Pastas</a></li>
				<li><a href="{{url('category/PARM_SUBS')}}">Parm Subs</a></li>
				<li><a href="{{url('category/WINGS')}}">Wings</a></li>
				<li><a href="{{url('category/DRINKS')}}">Drinks</a></li>
				<li><a href="{{url('category/CALZON')}}">Calzon</a></li>
				<li><a href="{{url('category/HOT_SUBS')}}">Hot Subs</a></li>
				<li><a href="{{url('category/DESSERTS')}}">Desserts</a></li>
				<li><a href="{{url('category/ROLLS')}}">Rolls</a></li>
				<li><a href="{{url('category/SALADS')}}">Salads</a></li>
				<li><a href="{{url('category/COLD_SUBS')}}">Cold Subs</a></li>
				<li><a href="{{url('category/STROMB')}}">Stromb</a></li>
				<li><a href="{{url('category/GYRO_BURGER_WRAPS')}}">Gyro Burger Wraps</a></li>
				<li><a href="{{url('category/SIDE_ORDER')}}">Side Order</a></li>
			</ul>
		</div>
	</section>

	<div class="container">
		<div class="row elements">
			<a href="/product">
				<div class="type col-md-6">
					<div class="row">
						<div class="col-xs-4">
							<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
						</div>
						<div class="col-xs-8">
							<h3>CHIKEN PESTO</h3>
							<p>Grilled Chicken, Plum Tomatoes, Pesto Sauce, Onions, Cheese</p>
						</div>
					</div>
				</div>
			</a>
			


			<div class="type col-md-6">
				<div class="row">
					<div class="col-xs-4">
						<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
					</div>
					<div class="col-xs-8">
						<h3>BIANCA</h3>
						<p>Mozz Cheese, Parm Cheese, Riccota, Fresh Garlic</p>
					</div>
				</div>
			</div>


			<div class="type col-md-6">
				<div class="row">
					<div class="col-xs-4">
						<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
					</div>
					<div class="col-xs-8">
						<h3>DELUX</h3>
						<p>Pepperoni, Sausage, Onions, Green Peppers, Mushrooms, Black Olives</p>
					</div>
				</div>
			</div>

			<div class="type col-md-6">
				<div class="row">
					<div class="col-xs-4">
						<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
					</div>
					<div class="col-xs-8">
						<h3>GREEK</h3>
						<p>Mozzarella, Feta, Spinach, Tomatoes, F.Garlic</p>
					</div>
				</div>
			</div>

			<div class="type col-md-6">
				<div class="row">
					<div class="col-xs-4">
						<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
					</div>
					<div class="col-xs-8">
						<h3>GRILL CKN</h3>
						<p>Grilled Chicken, Tomatoes, Onions</p>
					</div>
				</div>
			</div>

		</div>
	</div>
@stop