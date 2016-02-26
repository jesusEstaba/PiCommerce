@extends('sections.main')

@section('title', 'Pay')
@section('content')

<div class="container space">
	<div class="white">
		<div class="row">
			<div class="col-xs-12">
				<h2>Pay Order</h2>
			</div>
			<div class="col-xs-12">



@if($cart)
	@foreach($cart as $table => $campo)
		<div>
			<h3 class="title-product">
				@if($campo->Sz_FArea=="P")
					{{"Pizza"}}
				@endif
					{{$campo->Sz_Abrev}}
				x <span class="quantity">{{$campo->quantity}}</span>
			</h3>
			
			<ul class="topping-list">
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
						$size_topping = " [extra]";
					elseif($val->size==5)
						$size_topping = " [lite]";
					else
						$size_topping = "";
					?>
					<li>{{strtolower($val->Tp_Descrip).$size_topping}}: ${{$val->price}}</li>
					<?php $total_price_top += $val->price;?>
				@endforeach
			</ul>
			
			<p>
				${{$campo->Sz_Price+$total_price_top}}
				
			</p>
			<p>
				<h3> Total: 
					<span class="text-success">
					${{($campo->Sz_Price+$total_price_top)*$campo->quantity}}
					</span>
				</h3>
			</p>
		</div>
		<hr>

	@endforeach
	
	<div>
		<a href="{{url('order_now')}}" class="btn btn-success btn-lg">Order Now</a>
	</div>
@else
	<h2>Nothing to do</h2>
@endif



			</div>
		</div>
	</div>
</div>


<style type="text/css">
	.white{
		border-radius: 3px;
		border:solid #b2b2b2 1px;
		background: white;
		padding: 1em;
	}
</style>

@stop