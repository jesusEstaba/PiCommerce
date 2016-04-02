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
								<h4>Delivery</h4>
							</div>
							
							@else
								<div class="divisor">
									<h3 class="text-danger">
										Your are not in the zipcode range, This order will be ready for pickup.
									</h3>
								</div>
							@endif
							

							<div class="row">
								<div class="col-md-6">
									<div class="divisor">
								<h4>Customers Details</h4>
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


								</div>
								<div class="col-md-6">
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
								</div>
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
								<h4>Coupon Code</h4>
								<div class="form-group">
									<input style="width:79%;display: inline-block;" name="code" placeholder="Code Here" class="form-control"></input>
									<span id="code" class="btn btn-success" style="width: 20%">Use</span>
									<label style="font-size: .9em; font-weight: 100;" class="text-muted">if you have a code I put it here to receive a discount.</label>
								</div>

							</div>

							<div class="divisor">
								<div class="totales">
								<?php

									$total_cart = (float)$total_in_cart;
									$tax = (float)$tax;
									$fee = (float)$fee->Pf_Charge;
									
									if($delivery){
										$delivery_val = (float)$delivery_val->G_Value;
									}

									$taxs = $total_cart * $tax / 100;

									$total_to_pay = $total_cart + $taxs;
								?>
									<h4>
										<b>Sub-Total: </b>
										<span class="old-sub">
											$
											<span class="sub_total-price">{{round($total_cart, 2)}}</span>
											
										</span>
										<b class="discount"></b>
										
									</h4>
									<div class="mid-messages">
										<h4>
											<b>Coupon: </b>
											$<span class="cupon-vprice">0.00</span>
										</h4>
									</div>
									<h4>
										<b>Tax: </b>$
										<span data-tax="{{$tax}}" class="tax-price">{{round($taxs, 2)}}</span>
									</h4>
									@if($delivery)
										<h4>
											<b>Delivery: </b>$
											<span class="delivery-price">{{round($delivery_val, 2)}}</span>
										</h4>
									@endif
									<h4 class="hide ccfee">
										<b>Credit Card Processing Fee: </b>$
										<span class="fee-price text-muted">{{round($fee, 2)}}</span>
									</h4>
									<h3 >
										<b>Total: </b>$
										<span class="total-price">{{round($total_to_pay, 2)}}</span>
									</h3>
								</div>
							</div>

<br>
<div class="divisor">
	<p>
		<b>Arrival Date: </b>{{$arrival_date->format('d-m-Y')}}
	</p>
</div>

<div class="divisor note">
<p>
	<b>NOTE! The below IP and ISP has been recorded for security purposes.</b>
</p>
<p>
	<b>IP Address:</b> {{$_SERVER['REMOTE_ADDR']}}
</p>

</div>

							<br>
							<div>
								<a href="{{url('cart')}}" class="btn btn-default">Back to cart</a>
								<a class="btn order_now btn-success">Order Now</a>
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
{!!Form::token()!!}
<style type="text/css">
	.prices p{
		margin: 5px !important;
	}
	.divisor>h4, .title-orange{
		color:#E1543B;
	}
	.text-danger{
		text-align: center;
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
	.note{
		background: rgba(226, 145, 75, 0.62);
	}

	.super-discount{
		text-decoration: line-through;
	}

	.discount{
		padding-left: .3em;
		color: red;
	}
	.old-sub{
		transition: text-decoration .8s;
	}

</style>
<script type="text/javascript">

var disc = 0;
var credit_card = false;


function calcular(){
	
	var sub = Number( $('.sub_total-price').html() );
	var delivery = 0
	var fee = 0;
	var total = 0;
	var discount = 0;

	if( $('.delivery-price').length )
	{
		delivery = Number( $('.delivery-price').html() );
	}


	if( !$('.fee-price').hasClass('text-muted') )
	{
		fee = Number( $('.fee-price').html() );
	}

	/*
	$('.old-sub')
	$('.mid-messages')
	*/

	console.log(delivery);

	if(disc)
	{
		//$('.old-sub').addClass('super-discount');
		discount = sub * disc / 100;
		
		$('.cupon-vprice').html(discount.toFixed(2) );
		//append("<h3><b>Now: </b>"+);
	}

	var new_tax = ( sub - discount ) * Number( $('.tax-price').attr('data-tax') ) / 100;

	total = ( sub - discount ) + new_tax + delivery + fee;
	
	$('.sub_total-price').html(sub);
	$('.tax-price').html( new_tax.toFixed(2) );
	$('.total-price').html( total.toFixed(2) );
}



$(function(){

	$('.order_now').click(function(){

		var card = credit_card;
		var delivery = false;
		var tips = false;


		$.ajax(
		{
			url:'/order_now',
			type: 'POST',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},

			data:{
				card: card,
				delivery: delivery,
				tips: tips,
			},

		})
		.done(function(data) {
			if(data.status=="correct")
			{
				location.href="/cart";
			}
		});
	});



	$('#code').click(function(){
		
		var code = $('[name=code]').val();

		if(code)
		{
			$.get('/coupon/'+code, function(data) {
				console.log(data);

				if(data.discount)
				{
					disc = data.discount;
					calcular();
					$('[name=code]').val("");
				}
				else
				{
					alert('Code Invalid');
				}
			});
			
		}
	});


});



	$('.glyphicon-usd').click(function(){
		$('.glyphicon-usd')
				.addClass('select-pay')
				.parent()
				.addClass('select-pay');
			
			$('.glyphicon-credit-card')
				.removeClass('select-pay')
				.parent()
				.removeClass('select-pay');

		$('.fee-price').addClass('text-muted');
		$('.ccfee').addClass('hide');
		calcular();
		credit_card = false;

			
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

		$('.fee-price').removeClass('text-muted');
		$('.ccfee').removeClass('hide');
		calcular();
		credit_card = true;
	});
</script>

@stop