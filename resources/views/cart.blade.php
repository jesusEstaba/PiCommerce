@extends('sections.main')

@section('title', 'Cart')
@section('content')
<div class="container space">
	<div class="row list-cart">

		@if($cart)
			@foreach($cart as $table => $campo)
				<div class="item-pay col-md-6 col-xs-12">
				<h3>{{$campo->Sz_Abrev}}</h3>
				<ul>
					<?php $total_price_top = 0;?>
					@foreach($campo->toppings_list as $tab => $val)
						
						<?php
						if($val->size==1)
							$size_topping = "";
						elseif($val->size==2)
							$size_topping = " [left]";
						elseif($val->size==3)
							$size_topping = " [rigth]";
						elseif($val->size==4)
							$size_topping = " [double]";
						elseif($val->size==5)
							$size_topping = " [lite]";
						else
							$size_topping = "";
						?>

						<li>{{strtolower($val->Tp_Descrip).$size_topping}}: {{$val->price}}$</li>
						<?php $total_price_top += $val->price;?>
					@endforeach
				</ul>
				<h4 class="text-success">{{$campo->Sz_Price+$total_price_top}}$</h4>
			</div>
			@endforeach
		@else
			<h2 class="cart-empty-text">Cart Empty</h2>
			<img src="{{asset('images/items/cart-empty.png')}}" class="cart-empty-img">
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
<style type="text/css">
	.cart-empty-img{
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
	.cart-empty-text{
		text-align: center;
		color: #666;
	}
</style>
@stop