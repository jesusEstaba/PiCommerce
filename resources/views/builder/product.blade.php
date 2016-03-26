@extends('sections.main')

@section('title', 'Build')
@section('content')

<div class="container space bottom-space">
	@if($item)
<div class="row">
	
	<div class="col-md-8 bottom-space">

		<div class="head-product">
			
			<div class="row">
				<div class="col-md-6">
					<img src="{{asset('images/category/'.$image_category)}}" class="img-build">
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-12">
							<h2>{{$name}}</h2>
							@if( !empty($description) )
							<p>{{$description}}</p>
							@endif
						</div>
						
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="sizes">
								@if($item===true)
									<a class="btn btn-default size" data-id-size="{{$size->Sz_Id}}" data-price="{{$size->Sz_Price}}" data-top-price="{{$size->Sz_Topprice}}" data-top-price-two="{{$size->Sz_Topprice2}}">
										{{$size->Sz_Abrev}}
									</a>
								@elseif($size)
									@foreach($size as $table => $val)
									<a class="btn btn-default size" data-id-size="{{$val->Sz_Id}}" data-price="{{$val->Sz_Price}}" data-top-price="{{$val->Sz_Topprice}}" data-top-price-two="{{$val->Sz_Topprice2}}">
										{{$val->Sz_Abrev}}
									</a>
									@endforeach
								@else
								<p>No Hay Tamaños</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			

		@yield('head-data')
	</div>
	
	<div class="col-md-4 bottom-space">
		<div class="counter-price" id="droppable">
			<div class="cart-actual">
			
				@if($cart)
					@foreach($cart as $array => $campo)
						<h4 class="titulo-product">
							<span><b>{{ $campo->quantity .'x '}}</b> {{$campo->Sz_Abrev }}</span>
							<span class="pull-right">{{$campo->Sz_Price}}</span>
						</h4>
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
					@endforeach
				@endif
			</div>

			<h4 class="titulo-product">
				<span><b class="quantity-now-product">1</b><b>x</b></span>
				<span class="pizza_size" data-id-size="0" data-price="0"></span>
				<span class="price-now-size-product pull-right"></span>
			</h4>
			@yield('toppings')
			<div class="row">
				<div class="col-xs-12">
					<h2 class="price-all">$<span class="total-price"></span></h2>
					<div class="input-control">
						<textarea name="cooking_instructions" placeholder="Additional notes" class="notes_instructions form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="cantidad">
				<div class="box-cant">
					<p>Quantity</p>
					<span class="glyphicon glyphicon-minus btn btn-default"></span>
					<span class="quantity btn btn-default">1</span>
					<span class="glyphicon glyphicon-plus btn btn-default"></span>
				</div>
			</div>
			<a class="btn btn-success go-checkout-cart has-spinner">
				<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
				<span class="text-cart">Add to Cart</span>
			</a>
			
			<a class="btn btn-checkout off-check">Checkout</a>
		</div>
	</div>
</div>

<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
	
	@else
		<div class="row">
			<h3>This item no exist</h3>
		</div>
	@endif
</div>

</div>

	<script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.min.css')}}">
	
	<link rel="stylesheet" type="text/css" href="{{asset('css/product.css')}}">
	
	<script src="{{asset('js/product.js')}}"></script>

@stop