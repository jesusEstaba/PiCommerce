@extends('sections.main')

@section('title', 'Category')
@section('content')
	<section class="image-category">
		
	</section>
	
	<section class="name-category">
		<div class="container">
			<ul>
				<li><a href="#">PIZZAS</a></li>
				<li><a href="#">APPETIZ</a></li>
				<li><a href="#">PASTAS</a></li>
				<li><a href="#">PARM SUBS</a></li>
				<li><a href="#">WINGS</a></li>
				<li><a href="#">DRINKS</a></li>
				<li><a href="#">CALZON</a></li>
				<li><a href="#">HOT SUBS</a></li>
				<li><a href="#">DESSERTS</a></li>
				<li><a href="#">ROLLS</a></li>
				<li><a href="#">SALADS</a></li>
				<li><a href="#">COLD SUBS</a></li>
				<li><a href="#">STROMB</a></li>
				<li><a href="#">GYRO BURGER WRAPS</a></li>
				<li><a href="#">SIDE ORDER</a></li>
			</ul>
		</div>
	</section>

	<div class="container">
		<div class="row elements">
			<a href="/product">
				<div class="type col-md-6">
					<div class="row">
						<div class="col-xs-4">
							<img src="images/items/nopicture.jpg" class="item" alt="item-type">
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
						<img src="images/items/nopicture.jpg" class="item" alt="item-type">
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
						<img src="images/items/nopicture.jpg" class="item" alt="item-type">
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
						<img src="images/items/nopicture.jpg" class="item" alt="item-type">
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
						<img src="images/items/nopicture.jpg" class="item" alt="item-type">
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