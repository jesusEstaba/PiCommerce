@extends('sections.main')

@section('title', 'Build')
@section('content')


@include('sections.categories_and_banner')

<style type="text/css">
.combo-item{
	background: #fff;
	border-radius: 2px;
	padding: .5em;
	/*
	padding-left: .5em;
	padding-right: .5em;
	*/
}

</style>

<div class="container bottom-space">
	
@if($items)
<div class="row">
	
	<div class="col-md-12 bottom-space">

		<div class="col-md-12">
			<div class="head-product">
				<div class="row">
					<div class="col-md-12">
						<h2>Combo Items:</h2>
					</div>

					@eval($num_tab = 1)
					@foreach($items as $array => $item)
						<div class="col-md-3">
							<div class="combo-item">
								<a
									href="#tabsize-{{$num_tab}}" aria-controls="tabsize-{{$num_tab}}" role="tab" data-toggle="tab"
								>
									{{$item->It_Descrip}}
								</a>
							</div>
						</div>
						@eval($num_tab++)
					@endforeach

				</div>
			</div>
		</div>
			
		<div class="col-md-8 bottom-space">
			<div class="toppings">
				<div class="row">
					<div class="col-md-12">
						



<div class="tab-content">
@eval($indice = 1)
@eval($classActive = ' active')

@foreach($items as $array => $item)
	<div role="tabpanel" class="tab-pane{{$classActive}}" id="tabsize-{{$indice}}">
		{{$item->It_Descrip}}

		<ul>
			@foreach($item->sizes as $array => $size)
				<li>{{$size->Sz_Descrip}}</li>
			@endforeach
		</ul>
		


		@eval($indice++)
		@eval($classActive = '')
	</div>
@endforeach

</div>



					</div>
				</div>
			</div>
		</div>

		<div class="col-md-4 bottom-space">


			{{--Carrito--}}

			<div class="counter-price" id="droppable">
				<h4>
				<div class="row">
					<div class="col-xs-2">
						<b>Qty.</b>
					</div>
					<div class="col-xs-7">
						<p>
							<b>Description</b>
						</p>
					</div>
					<div class="col-xs-3">
						<span class="pull-right"><b>Price</b></span>
					</div>
				</div>
				
				</h4>
				@if($cart)
				<div class="cart-actual" data-total-cart="{{$total_cart}}">
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
							@foreach($campo->toppings_list as $tab => $val)
							<h5 class="text-muted">
							<span>
								<b>
								{{strtolower($val->Tp_Descrip) . $sizeToppingFunc($val->size)}}
								</b>
							</span>
							<span class="pull-right">
								@if($val->price > 0)
								${{$val->price}}
								@endif
							</span>
							</h5>
							@endforeach
						</div>
					</div>
					
					@endforeach
					
				</div>
				@endif
				
				
				<h4 class="titulo-product">
				<div class="row">
					<div class="col-xs-2">
						<span class="text-descrip-product"><b class="quantity-now-product">1</b></span>
					</div>
					<div class="col-xs-7">
						<b>{{'$name'}}</b>
						<span class="pizza_size" data-id-size="0" data-price="0"></span>
					</div>
					<div class="col-xs-3">
						<span class="pull-right">$<span class="price-now-size-product"></span></span>
					</div>
				</div>
				
				</h4>
				@yield('toppings')
				<div class="row">
					<div class="col-xs-12">
						<hr>
						<h4>Price: <span class="pull-right">$<span class="total-price"></span></span></h4>
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
				<div class="Subtotales">
					<h4>Sub-Total: <span class="pull-right">$<span class="sub-total">0.00</span></span></h4>
					<h4>Tax: <span class="pull-right">$<span class="taxes">0.00</span></span></h4>
					<h3>Total: <span class="pull-right">$<span class="total-cart">0.00</span></span></h3>
				</div>
				<a class="btn btn-success go-checkout-cart has-spinner">
					<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
					<span class="text-cart">Add to Cart</span>
				</a>
				
				<a class="btn btn-checkout off-check">Checkout</a>
			</div>


			{{--END Carrito--}}
		</div>
	</div>
	
	
</div>

<input type="hidden" name="_token" value="{{ csrf_token() }}" />
	
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