@extends('sections.main')

@section('title', 'Build')
@section('content')


@include('sections.categories_and_banner')

<style type="text/css">

.combo-item a{
	display: block;
	/*
	background: #fff;
	border-radius: 2px;
	padding: .5em;
	*/
	/*
	padding-left: .5em;
	padding-right: .5em;
	*/
}
.btn-space{
	margin-bottom: .3em;
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
						<h2 id="combo" data-id="{{$combo->Cb_Id}}">Combo {{$combo->Cb_Name}}:</h2>
					</div>

					@eval($num_tab = 1)
					@foreach($items as $array => $item)
						<div class="col-md-3">
							<div class="combo-item">
								<a
									class="btn btn-default tab-items"
									href="#tabsize-{{$num_tab}}" 
									aria-controls="tabsize-{{$num_tab}}" 
									role="tab" 
									data-toggle="tab"
									data-tab="{{$num_tab}}"
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
		<h3>{{$item->It_Descrip}}</h3>
			<div class="row">
				<div class="col-md-12">
					@eval($indiceInt = 1)
					@eval($classActiveInt = ' active')
					@foreach($item->sizes as $array => $size)
							<a 	href="#tabsizetop-{{$indice}}-{{$indiceInt}}" 
								aria-controls="tabsizetop-{{$indice}}-{{$indiceInt}}" 
								role="tab" 
								data-toggle="tab"
								data-tab="{{$indice}}"
								data-id-size="{{$size->Sz_Id}}"
								data-price="{{$size->Sz_Price}}"
								data-top-price="{{$size->Sz_Topprice}}"
								data-top-price-two="{{$size->Sz_Topprice2}}"
								class="size btn btn-space btn-default" 
							>
								{{$size->Sz_Abrev}}
							</a>
						@eval($indiceInt++)
						@eval($classActiveInt = '')
					@endforeach
				</div>

				<div class="col-md-12">
					<hr>
					<div class="row">
						<div class="col-md-4">
							<h2 class="text-center">Add Topping</h2>
						</div>
						@if(HelperWebInfo::pizzaBuilderSize($item->It_Groups))
						<div class="col-md-8">
							<div class="btn-sizes">
								<div class="btn-complete-size topping-size" data-size-top="1" title="Complete">
									<span class="name-size-top hidden-xs">Complete</span>
								</div>
								<div class="btn-semi-left-size topping-size" data-size-top="2" title="Left Half">
									<span class="name-size-top hidden-xs">Left/Right</span>
								</div>
								<div class="btn-semi-right-size topping-size" data-size-top="3" title="Right Half">
								</div>
								<div class="btn-double-size topping-size" data-size-top="4" title="Extra">
									<span class="name-size-top hidden-xs">Extra</span>
								</div>
								<div class="btn-lite-size topping-size" data-size-top="5" title="Lite">
									<span class="name-size-top hidden-xs">Lite</span>
								</div>
							</div>
							<br>
						</div>
						@endif
					</div>
				</div>
			</div>

		<hr>
		<p class="text-center">This is a drag & drop items.</p>

		<div class="row">
			<div class="col-md-8">
				<div class="tab-content">
					@eval($indiceInt = 1)
					@eval($classActiveInt = ' active')
					@foreach($item->sizeToppings as $array => $toppings)
						<div role="tabpanel" class="tab-pane{{$classActiveInt}}" id="tabsizetop-{{$indice}}-{{$indiceInt}}">
								@if(count($toppings))
										<div class="toppings-btns">
											@foreach($toppings as $data => $top)
											<div class="box-drag">
												<a style="color:#000;background:#{{$top->Tp_Color or "fff"}};" data-id-top="{{$top->Tp_Id}}" class="btn drag" data-double="{{$top->Tp_Double}}" data-price="{{$top->Tp_Topprice}}">
													{{ucwords( strtolower($top->TP_Descrip) )}}
												</a>
											</div>
											@endforeach
										</div>
								@else
									<b>No toppings for this size</b>
								@endif
						</div>
						@eval($indiceInt++)
						@eval($classActiveInt = '')
					@endforeach
				</div>
			</div>

			<div class="col-xs-4">
				<h4>Cooking Instructions</h4>
				<div class="cooks" data-max-cook="2">
					@foreach($cooking_instructions as $array => $instruction)
					<div class="checkbox" data-tab="{{$indice}}">
						<label>
							<input data-top-id="{{$instruction->Tp_Id}}" class="instruction" type="checkbox">
							<span>{{ucwords( strtolower($instruction->Tp_Descrip) )}}</span>
						</label>
					</div>
				@endforeach
				</div>
				
			</div>
		</div>
		
		

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
						<b id="name-item">name</b>
						<span id="name-size"></span>
					</div>
					<div class="col-xs-3">
						<span class="pull-right">$<span class="price-now-size-product"></span></span>
					</div>
				</div>
				
				</h4>
				
				
				@eval($num_tab = 1)
				@foreach($items as $array => $item)
						<ul class="items-toppings"
							id="toppings-{{$num_tab}}"
							data-id-size="0"
							data-price="0"
							data-topprice="0"
							data-topprice-two="0"
							data-qty="1"
							data-size-top="1"
						>
						</ul>
						@eval($num_tab++)
				@endforeach


				

				
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
					<h4>Tax: <span class="pull-right">$<span data-tax={{HelperWebInfo::tax()}} class="tax">0.00</span></span></h4>
					<h3>Total: <span class="pull-right">$<span class="total-cart">0.00</span></span></h3>
				</div>
				<a class="btn btn-success go-checkout-cart has-spinner">
					<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
					<span class="text-cart">Add Combo to Cart</span>
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
	
	<script src="{{asset('js/product-combo.js')}}"></script>

@stop