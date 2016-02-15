@extends('sections.main')

@section('title', 'Cart')
@section('content')
<div class="container space">
	<div class="acctions-elements">
		<div class="row">
			<div class="col-xs-12">
				<a class="btn btn-danger delete-element-to-cart">
					<spam class="glyphicon glyphicon-trash"></spam>
					Delete
				</a>
				<a class="btn btn-info select-item">
					<spam class="glyphicon glyphicon-check"></spam>
					Select
				</a>
			</div>
		</div>
	</div>
	<div class="row list-cart">

		@if($cart)
			@foreach($cart as $table => $campo)
				<div id-cart="{{$campo->id}}" class="item-pay">
					<div class="row">
						<div class="col-xs-12">
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
					</div>
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
			<a href="#" class="hide btn btn-success btn-lg pay-btn">Pay</a>
		</div>
	</div>
	<form action="{{url('pay')}}" class="hide" id="pay">
		<input type="submit" class="send">
	</form>
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
	.item-pay{
		background: white;
		border-radius: 5px;
		margin-bottom: .5em;
		padding-left: 1em;
		transition:.8s background, .8s color;
	}
	.element-cart
	{
		background: #BF032F;
		/*border:#BF032F solid 1px;*/
		color: white;
	}
	.element-cart .text-success{
		background: green;
		color: white;
		display: inline-block;
		padding: .2em;
		border-radius: 3px;
	}
	.acctions-elements{
		margin-bottom: 1em;
	}
</style>
<script type="text/javascript">
	var delete_items = true;
	var select_items = true;

	$(document).ready(function() {

		

		$('.select-item').click(function()
		{
			if(select_items)
			{
				select_items = false;
				
				$(".item-pay").click(function()
				{
					if( $(this).hasClass('element-cart') )
					{
						$(this).removeClass('element-cart');
					}
					else
					{
						$(this).addClass('element-cart');
					}

					if( $(".item-pay").hasClass('element-cart') )
					{
						$('.pay-btn').removeClass("hide");
					}
					else
						$('.pay-btn').addClass("hide");
				});
				
				$(this).addClass('active');
				
				
			}
			else
			{
				$(".item-pay")
					.off()
					.removeClass('element-cart');
				
				select_items = true;
				$(this).removeClass('active');
				$('.pay-btn').addClass("hide");
			}
		});

		$('.delete-element-to-cart').click(function()
		{
			$(".item-pay").click(function()
			{
				if(!delete_items)
				{
					if( $(this).hasClass('element-cart') )
					{
						$(this).fadeOut(function() {
							$(this).remove();
						});
					}
				}
			});

			if(delete_items)
			{
				delete_items = false;
				$(this).addClass('active');
			}
			else
			{
				delete_items = true;
				$(this).removeClass('active');
			}
		});

		$('.pay-btn').click(function(event) {
			/* Act on the event */
			$(".item-pay.element-cart").each(function(index, el) {
				$('#pay').append('<input type="hidden" name="select_cart[]" value="'+$(this).attr('id-cart')+'">');
			});
			$('.send').click();
		});

	});

</script>
@stop