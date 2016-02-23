@extends('sections.main')

@section('title', 'Cart')
@section('content')
<div class="container space">
	<div class="row list-cart">

		@if($cart)
			<div class="col-xs-12">
				<div class="box-title-products">
					<div class="row">
						<div class="col-xs-offset-1 col-xs-5">
							<b class="center-text">Product</b>
						</div>
						<div class="col-md-offset-3 col-md-1 col-xs-3">
							<b>Toppings</b>
						</div>
						<div class="col-md-2 col-xs-3">
							<b>Price</b>
						</div>
					</div>
				</div>
			</div>
			<div class="items-list-box">
			@foreach($cart as $table => $campo)
				<div class="col-xs-12">
					<div id-cart="{{$campo->id}}" class="item-pay">
						<div class="row">
							<ul class="hide topping-list">
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
							<div class="col-xs-1">
								<spam class="glyphicon glyphicon-remove delete-element"></spam>
							</div>
							<div class="col-xs-5">
								<h4 class="title-product">@if($campo->Sz_FArea=="P"){{"Pizza"}}@endif {{$campo->Sz_Abrev}}</h4>
							</div>
							<div class="col-md-offset-3 col-md-1 col-xs-3">
								<a class="btn btn-default view-details-toppings-modal">view</a>
							</div>
							<div class="col-md-2 col-xs-3 price_box">
								<h4 class="text-success">$<span class="price">{{$campo->Sz_Price+$total_price_top}}</span></h4>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			</div>
			<div class="col-xs-12">
				<div class="sub-total-box">
					<div class="row">
						<div class="col-md-6 col-md-offset-6">
							total price
						</div>
					</div>
				</div>
			</div>
		@else
			<h2 class="cart-empty-text">Cart Empty</h2>
			<img src="{{asset('images/items/cart-empty.png')}}" class="cart-empty-img">
		@endif
	</div>
	<div class="row actions-cart">
		<div class="col-md-4">
			<a href="{{url('/category/drinks')}}">
				<img src="images/category/soft-drinks.jpg" alt="choose" class="choose">
			</a>
		</div>
		<div class="col-md-4">
			<a href="{{url('/category/salads')}}">
				<img src="images/category/xsLmTnr55b8xLnF72P2eYqV57bk.png" alt="choose" class="choose">
			</a>
			
		</div>
		<div class="col-md-offset-1 col-md-3">
			<a href="#" class="btn btn-success btn-lg pay-btn">Pay</a>
		</div>
	</div>
	<form action="{{url('pay')}}" class="hide" id="pay">
		<input type="submit" class="send">
	</form>
</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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
		padding: .5em;
		background: white;
		border: #b2b2b2 solid 1px;
		border-top: none;
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
	.delete-element{
		margin-right: .5em;
		margin-top: .5em;
	}
	.glyphicon-remove{
		color: #B70909;
	}
	.center-text{
		text-align: center;
		display: block;
	}
	.box-title-products{
		border:#b2b2b2 solid 1px;
		background: #ccc;
		border-radius: 3px 3px 0 0;
		padding-top: .5em;
		padding-bottom: .5em;
	}
	.hover-parent{
		color: black !important;
	}
	.sub-total-box{
		background:#ddd;
		border:#b2b2b2 solid 1px;
		border-top: none;
		border-radius: 0 0 3px 3px;
		padding: .5em;
	}
	.empty-cart-text{
		background: white;
		text-align: center;
		padding: 1em;
		margin: 0;
		border-left: #b2b2b2 solid 1px;
		border-right: #b2b2b2 solid 1px;
	}
</style>

<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

<script type="text/javascript">

	$(document).ready(function() {
		
		$('.delete-element').click(function(event) {
			
			var id = $(this).parents('.item-pay').attr('id-cart');
			
			var price = $(this).parent().siblings('.price_box').children().children().html();

			$(this).parents('.item-pay').parent().remove();

			$.get("delete/item/"+id);

			var total = parseFloat($(".total-in_cart").html())-parseFloat(price);
			$(".total-in_cart").html(total.toFixed(2));

			if(!$('.item-pay').length)
			{
				$('.items-list-box').append('<div class="col-xs-12"><h2 class="empty-cart-text">Cart Empty</h2></div>');
			}
		});

		$('.pay-btn').click(function(){
			$(".item-pay.element-cart").each(function() {
				$('#pay').append('<input type="hidden" name="select_cart[]" value="'+$(this).attr('id-cart')+'">');
			});
			$('.send').click();
		});


		$('.view-details-toppings-modal').click(function() {
			var toppings = $(this).parent().siblings('ul').html();
			var title = $(this).parent().siblings().children("h4.title-product").html();
			
			$("#myModal .modal-title").html('<h4>'+title+'</h4>');
			$("#myModal .modal-body").html('<ul>'+toppings+'</ul>');
			$('#myModal').modal('show');
		});

	});

</script>
@stop