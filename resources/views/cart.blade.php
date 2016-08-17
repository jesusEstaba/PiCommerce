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
						<b>Unit Price</b>
					</td>
					<td>
						<b>Toppings</b>
					</td>
				</tr>
				@foreach($cart as $table => $campo)
					<?php $total_price_top = 0;?>
					@if(isset($campo->toppings_list))
						@foreach($campo->toppings_list as $tab => $val)
							<?php $total_price_top += $val->price;?>
						@endforeach
					@else
						@foreach($campo->subItems as $tab => $val)
							<?php $total_price_top += $val->Sz_Price;?>
						@endforeach
					@endif


				<tr id-cart="{{$campo->id}}" class="item-pay">
					<td>
						<spam total-price-product="{{($campo->Sz_Price+$total_price_top)*$campo->quantity}}" class="glyphicon glyphicon-remove delete-element"></spam>
					</td>
					<td>
						<h4 class="title-product">
							<b>{{$campo->It_Descrip}}</b>
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
						<ul class="topping-list">
							@if(isset($campo->toppings_list))
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
									<span><b>:</b> ${{$val->price}}</span>
									@endif
								</li>
								@endforeach
							@endif
						</ul>
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
				<img src="images/category/soft-drinks.jpg" alt="choose1" class="choose img-responsive choose">
			</a>
		</div>
		<div class="col-md-4">
			<a href="{{url('/category/salads')}}">
				<img src="images/category/xsLmTnr55b8xLnF72P2eYqV57bk.png" alt="choose2" class="choose img-responsive choose">
			</a>
			
		</div>
		<div class="col-md-offset-1 col-md-3">
			<a href="{{url('checkout')}}" class="btn btn-success btn-lg pay-btn">Checkout</a>
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
    </div>
  </div>
</div>

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
    </div>
  </div>
</div>

<link rel="stylesheet" type="text/css" href="{{asset('css/cart.css')}}">

<script type="text/javascript" src="{{asset('js/cart.js')}}"></script>

@stop