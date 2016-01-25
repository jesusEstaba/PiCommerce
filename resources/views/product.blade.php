@extends('sections.main')

@section('title', 'Build')
@section('content')

<div class="container space">
	<div class="row head-build">
		<div class="col-xs-12 col-md-4">
			<img src="images/category/healthy-honey-vegetable-pizza-561561.jpg">
		</div>
		<div class="col-xs-12 col-md-8">
			<div class="row">
				<h2>Delux</h2>
				<p>Pepperoni, Sausage, Onions, Green Peppers, Mushrooms, Black Olives</p>
			</div>
			<div class="row">
				<ul class="nav nav-pills">
				  <li class="active"><a href="#">12"</a></li>
				  <li><a href="#">15"</a></li>
				  <li><a href="#">18"</a></li>
				  <li><a href="#">20"</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-md-8">
			<div class="row  toppings">
				<h2>Add Toping</h2>

				<div class="col-md-3">
					<p>EXTRA_CHEESE</p>
					<p>FETA_CHEESE</p>
					<p>RICOTTA_CHEESE</p>
				</div>
				<div class="col-md-3">
					<p>PEPRONI</p>
					<p>SAUSAGE</p>
					<p>HAM</p>
					<p>BACON</p>
					<p>GROUND_BEEF</p>
					<p>MEATBALLS</p>
					<p>SALAMI</p>
				</div>
				<div class="col-md-3">
					<p>CHICKEN</p>
					<p>ANCHOVIES</p>
				</div>
				<div class="col-md-3">
					<p>ONIONS</p>
					<p>GREEN_PEPPERS</p>
					<p>MUSHR</p>
					<p>SPINACH</p>
					<p>GARLIC</p>
					<p>BROCOLLI</p>	
					<p>FRESH_BASIL</p>
					<p>EGGPLANT</p>
				</div>
				<div class="col-md-3">
					<p>BLACK_OLIVES</p>
					<p>GREEN_OLIVES</p>
					<p>PINEAPPLE</p>
					<p>TOMATO</p>
				</div>
				<div class="col-md-3">
					<p>JALAPENO</p>
					<p>BANNANA_PEPPERS</p>
				</div>
				
			</div>
		</div>
		<div class="col-xs-12 col-md-4 counter-price">
			<h3>Delux 12"</h3>
			<ul>
				<li>Pepperoni</li>
				<li>Double Cheese</li>
				<li>Onios</li>
				<li>Corn</li>
			</ul>

			<h2 class="text-success">14,99$</h2>
			<a href="/cart" class="btn btn-success">Add to Car</a>
		</div>
	</div>
</div>
@stop