@extends('sections.main')

@section('title', 'Cart')
@section('content')
<div class="container space">
	<div class="row list-cart">

		@if($cart)
			@foreach($cart as $table => $campo)
				<div class="item-pay col-md-6 col-xs-12">
				<h3>{{$campo->Sz_Abrev}}</h3>
				{{-- <ul>
					<li>Pepperoni</li>
					<li>Double Cheese</li>
					<li>Onios</li>
					<li>Corn</li>
				</ul> --}}
				<p class="text-success">{{$campo->Sz_Price}}</p>
			</div>
			@endforeach
		@else
			<h2>Cart Empty</h2>
		@endif
	</div>
	<div class="row actions-cart">
		<div class="col-md-4">
			<img src="images/category/soft-drinks.jpg" alt="choose" class="choose">
		</div>
		<div class="col-md-4">
			<img src="images/category/xsLmTnr55b8xLnF72P2eYqV57bk.png" alt="choose" class="choose">
		</div>
		<div class="col-md-offset-1 col-md-3">
			<a href="pay" class="btn btn-success btn-lg">Pay</a>
		</div>
	</div>
</div>
@stop