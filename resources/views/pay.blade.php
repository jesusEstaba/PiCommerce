@extends('sections.main')

@section('title', 'Checkout')
@section('content')

<div class="container space">
	<div class="">
		<div class="row">
			<div class="col-xs-12">
				<h2>Pay Order</h2>
			</div>
			<div class="col-xs-12">
				<div class="row">
					<div class="col-md-8">
						<div class="white space-bottom">
							
							@if($delivery)
							<div class="divisor">
								<div class="row">
									
									<div class="col-md-6">
										<div class="">
											<h2>Delivery</h2>
											<img src="{{asset('images/logos/pizza_delivery_man.png')}}" height="100">
										</div>
										
									</div>
									
									<div class="col-md-6">
										<div class="">
											<h2>Pick Up</h2>
											<img src="{{asset('images/logos/horno.png')}}" height="100">
										</div>
									</div>
								</div>
							</div>
							
							@else
								<div class="divisor">
									<p>NO Delivery!</p>
								</div>
							@endif
							
							<div class="divisor">



								<h4>Costumerrs Details</h4>
								<p>
									<b>Name: </b>{!!$user->Cs_Name or '<em>No Name</em>'!!}
								</p>
								<p>
									<b>Phone: </b>{!!$user->Cs_Phone or '<em>No Phone</em>'!!}
								</p>
								<p>
									<b>Email: </b>{!!$user->email or '<em>No Email</em>'!!}
								</p>
							</div>



							<div class="divisor">
								<h4>Delivery Details</h4>
								<p>
									<b>Street #: </b>{!!$user->Cs_Number or '<em>No Number</em>'!!}
								</p>
								<p>
									<b>Street Name: </b>{!!$user->Cs_Street or '<em>No Street</em>'!!}
								</p>
								<p>
									<b>Zip Code: </b>{!!$user->Cs_ZipCode or '<em>No Zip Code</em>'!!}
								</p>
								@if($user->Cs_Notes)
									<p class="divisor">
										<b>Special Directions: </b>{{$user->Cs_Notes}}
									</p>
								@endif
							</div>

							<div class="divisor">
								<h4>Payment Method</h4>
								<div class="btn-pay select-pay">
									<span class="glyphicon glyphicon-usd select-pay"></span>
									<p>Cash</p>
								</div>
								<div class="btn-pay">
									<span class="glyphicon glyphicon-credit-card"></span>
									<p>Credit Card</p>
								</div>
							</div>

							<div class="divisor">
								<div class="totales">
									<?php
									$total_cart = (float)$total_in_cart;
									$total_cart = round($total_cart, 2);
									$tax = (float)$tax;
									$taxes = $total_cart * $tax / 100;
								?>
									<h4><b>Sub-Total: </b>{{$total_cart}}</h4>
									<h4><b>Taxes: </b>{{round($taxes, 2)}}</h4>
									<h3><b>Total: </b>{{round($total_cart+$taxes, 2)}}</h3>
								</div>
							</div>

							<br>
							<div>
								<a href="{{url('cart')}}" class="btn btn-default">Back to cart</a>
								<a href="{{url('order_now')}}" class="btn btn-success">Order Now</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						
						<div class="white space-bottom">



@if($cart)

			<h4 class="title-orange">
				<div class="row">
					<div class="col-xs-2">
						Qty.
					</div>
					<div class="col-xs-7">
						<p>
							Description
						</p>
					</div>
					<div class="col-xs-3">
						<span class="pull-right">Price</span>
					</div>
				</div>
				
			</h4>
				<div class="cart-actual">

					@foreach($cart as $array => $campo)
						<h4 class="titulo-product">

							<div class="row">
								<div class="col-xs-2">
									<b class="text-descrip-product">{{ $campo->quantity }}</b>
								</div>
								<div class="col-xs-7">
									<span> {{$campo->It_Descrip or $campo->Sz_Abrev}}</span>
								</div>
								<div class="col-xs-3">
									<span class="pull-right">${{$campo->Sz_Price}}</span>
								</div>
							</div>							
							
						</h4>
						
						<div class="row">
							<div class="col-xs-10 col-xs-offset-2">
								<?php //$total_price_top = 0;?>
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

									<h5 class="text-muted">
										<span><b>{{strtolower($val->Tp_Descrip).$size_topping}}</b></span>
										<span class="pull-right">
											@if($val->price > 0)
												${{$val->price}}
											@endif
										</span>
									</h5>
									<?php //$total_price_top += $val->price;?>

								@endforeach
							</div>
						</div>
						
					@endforeach
				
				</div>
			@endif







						</div>



					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.prices p{
		margin: 5px !important;
	}
	.divisor>h4, .title-orange{
		color:#E1543B;
	}

	.title-orange{
		font-weight: bolder;
	}

	.white{
		background: white;
		border-radius: 3px;
		border:solid #b2b2b2 1px;
		padding: 1em;
	}
	.topping-list{
		list-style: none;
	}
	.space-bottom{
		margin-bottom: 1em;
	}
	div.divisor{
		margin-bottom: .5em;
	}
	.divisor{
		border-radius: 2px;
		border:solid #eee 1px;
		padding: .5em;
	}
	.btn-pay{
		padding: .5em;
		display: inline-block;
		margin-right: .5em;
		border-radius: 2px;
		transition: .8s background, .5s border;
	}
	.btn-pay.select-pay{
		background: #eee;
		border:#b2b2b2 1px solid;
		
	}
	.btn-pay .glyphicon{
		font-size: 4em;
		padding: .5em;
	}
	.glyphicon-usd.select-pay{
		color: #157038;
	}
	.glyphicon-credit-card.select-pay{
		color: #E6831D;
	}
</style>
<script type="text/javascript">
	$('.glyphicon-usd').click(function(){
		$('.glyphicon-usd')
				.addClass('select-pay')
				.parent()
				.addClass('select-pay');
			
			$('.glyphicon-credit-card')
				.removeClass('select-pay')
				.parent()
				.removeClass('select-pay');

			
	});

	$('.glyphicon-credit-card').click(function(){
		$('.glyphicon-usd')
				.removeClass('select-pay')
				.parent()
				.removeClass('select-pay');
			
			$('.glyphicon-credit-card')
				.addClass('select-pay')
				.parent()
				.addClass('select-pay');
	});
</script>

@stop