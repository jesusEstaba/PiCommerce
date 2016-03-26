@extends('sections.main')

@section('title', 'Cart')
@section('content')
<div class="container space">
	<div class="row list-cart">

		@if($cart)

		<div class="col-xs-12">

			<table class="table">
				<tr class="thead">
					<td>
						<b>Remove</b>
					</td>
					<td>
						<b>Product</b>
					</td>
					<td>
						<b>Quantity</b>
					</td>
					<td>
						<b>Price</b>
					</td>
					<td>
						<b>Toppings</b>
					</td>
				</tr>
				@foreach($cart as $table => $campo)
				<tr id-cart="{{$campo->id}}" class="item-pay">
					<td class="hide">
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

										<li>
											<b>{{strtolower($val->Tp_Descrip).$size_topping}}</b>
											@if($val->price > 0)
												<span>: ${{$val->price}}</span>
											@endif
										</li>
										
										<?php $total_price_top += $val->price;?>
									@endforeach
						</ul>
					</td>
					<td>
						<spam total-price-product="{{($campo->Sz_Price+$total_price_top)*$campo->quantity}}" class="glyphicon glyphicon-remove delete-element"></spam>
					</td>
					<td>
						<h4 class="title-product">
						@if($campo->Sz_FArea=="P")
							{{"Pizza"}}
						@endif 
							{{$campo->Sz_Abrev}}
						</h4>
					</td>
					<td>
						<span class="quantity">{{$campo->quantity}}</span>
					</td>
					<td>
						<h4 class="text-success">$<span class="price">{{$campo->Sz_Price+$total_price_top}}</span></h4>
					</td>
					<td>
						@if($campo->toppings_list)
							<a class="btn btn-default view-details-toppings-modal">view</a>
						@endif
					</td>
				</tr>
				@endforeach
			</table>	
		</div>

			<div class="col-xs-12">
				<div class="sub-total-box">
					<div class="row">
						<div class="col-md-6 col-md-offset-6">
							<h3>Total Price: $<span class="total_cart_price">0</span></h3>
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
			<a href="{{url('select')}}" class="btn btn-success btn-lg pay-btn">Checkout</a>
		</div>
	</div>
</div>


<div id="ModalDeleteItem" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Item</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this item?</p>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-danger" id="delete-item-now" data-dismiss="modal">Delete</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


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


<div id="perfil" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">User Info</h4>
      </div>
      <div class="modal-body">
	      
	      <div class="input-group">
	      	
	      </div>
	      
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-data" data-dismiss="modal">Save</button>
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
	}
	.table{
		margin: 0;
	}
</style>


<script type="text/javascript">


var element_box_delete;

	$(document).ready(function() {

		$('.profile').click(function(){
			$('#perfil').modal();
		});


		$('#delete-item-now').click(function(){


			var id = $(this).attr('id-item');
			var price = $(this).attr('price');
			
			debugger;
			
			element_box_delete.remove()

			var total = parseFloat($(".total-in_cart").html())-parseFloat(price);
			$(".total-in_cart").html(total.toFixed(2));

			$('.total_cart_price').html(total.toFixed(2));
			
			if(!$('.item-pay').length)
			{
				$('.table').append('<tr class="item-pay deleted-all-cart"><td></td><td><h3 class="empty-cart-text">Cart Empty</h3></td><td></td><td></td><td></td></tr>');
			}
			debugger;
			$.get("delete/item/"+id);

		});

		

		$('.delete-element').click(function(event) {
			
			debugger;
			
			var id = $(this).parents('.item-pay').attr('id-cart');
			var price = $(this).attr('total-price-product');
			
			debugger;
			
			element_box_delete = $(this).parents('.item-pay');
			
			$('#delete-item-now')
				.attr('id-item', id)
				.attr('price', price);

			debugger;
			$('#ModalDeleteItem').modal();
		});

		$('.delete-element').each(function(index, el) {
			var price = parseFloat($(this).attr('total-price-product'));
			
			var total = parseFloat($(".total_cart_price").html()) + price;
			
			$('.total_cart_price').html( total.toFixed(2) );
		});


		$('.view-details-toppings-modal').click(function() {
			var toppings = $(this).parent().parent().children().html();
			

			var title = $(this).parent().siblings().children("h4.title-product").html();
			
			$("#myModal .modal-title").html('<h4>'+title+'</h4>');
			$("#myModal .modal-body").html('<ul>'+toppings+'</ul>');
			$('#myModal').modal('show');
		});

	});

</script>
@stop