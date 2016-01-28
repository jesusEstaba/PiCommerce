@extends('sections.main')

@section('title', 'Choose')
@section('content')
<div class="container space">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				<a href="{{url('category/pizzas')}}">
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<h3 class="text-choose">Pizzas</h3>
						<img src="{{asset('images/category/healthy-honey-vegetable-pizza-561561.jpg')}}" alt="choose" class="choose">
					</div>
				</a>
				
				<a href="{{url('category/pastas')}}">
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<h3 class="text-choose">Pastas</h3>
						<img src="{{asset('images/category/lasagna300.jpg')}}" alt="choose" class="choose">
					</div>
				</a>
				
				<a href="{{url('category/drinks')}}">
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<h3 class="text-choose">Drinks</h3>
						<img src="{{asset('images/category/soft-drinks.jpg')}}" alt="choose" class="choose">
					</div>
				</a>
				
				<a href="{{url('category/calzon')}}">
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<h3 class="text-choose">Calzon</h3>
						<img src="{{asset('images/category/calzone_jamon_300x200.png')}}" alt="choose" class="choose">
					</div>
				</a>
				<a href="{{url('category/rolls')}}">
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<h3 class="text-choose">Rolls</h3>
						<img src="{{asset('images/category/hot-roll-300x200.jpg')}}" alt="choose" class="choose">
					</div>
				</a>
				
				<a href="{{url('category/salads')}}">
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<h3 class="text-choose">Salads</h3>
						<img src="{{asset('images/category/xsLmTnr55b8xLnF72P2eYqV57bk.png')}}" alt="choose" class="choose">
					</div>
				</a>
				
			</div>
		</div>
	</div>
</div>
@stop