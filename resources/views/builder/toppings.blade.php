@extends('builder.product')

@section('toppings')
	<ul data-topprice='0' class="items-toppings">
	</ul>
@stop

@section('head-data')



<div class="toppings">
	<div class="row">
		<div class="col-md-4">
			<h2>Add Topping</h2>
		</div>

		@if($pizzaBuilderSize)
			<div class="col-md-8">
				<div class="btn-sizes">
					<div class="btn-complete-size topping-size" data-size-top="1" title="Complete">
						<span class="name-size-top">Complete</span>
					</div>
					<div class="btn-semi-left-size topping-size" data-size-top="2" title="Left Half">
						<span class="name-size-top">Left/Right</span>
					</div>
					<div class="btn-semi-right-size topping-size" data-size-top="3" title="Right Half">
					</div>
					<div class="btn-double-size topping-size" data-size-top="4" title="Extra">
						<span class="name-size-top">Extra</span>
					</div>
					<div class="btn-lite-size topping-size" data-size-top="5" title="Lite">
						<span class="name-size-top">Lite</span>
					</div>
				</div>
				<br>
			</div>
		@endif

	</div>
	<br>
	<br>
	<div class="row">
		<div class="col-xs-8">
			@if($allToppings)
			<div class="row">
				<div class="col-xs-12">
					<p class="text-drag-drop-desc">
						This is a drag & drop items.
					</p>






<!-- TOPPINGS CATEGORY -->
<div class="topping_category">

	<div class="row">

		<div class="col-md-12">

			<div class="tab-content">
				@if( count($allToppings) )
					<?php
						$indice = 1;
						$classActive = ' active';
					?>
					@foreach($allToppings as $arra => $toppings)
						<div role="tabpanel" class="tab-pane{{$classActive}}" id="tabsize-{{$indice}}">
							@if( count($toppings) )
								{{--TOPPINGS LOAD--}}
									<div class="toppings-btns">
										@foreach($toppings as $data => $top)
												<div class="box-drag">
													<a style="color:#000;background:#{{$top->Tp_Color or "fff"}};" data-id-top="{{$top->Tp_Id}}" class="btn drag" data-double="{{$top->Tp_Double}}" data-price="{{$top->Tp_Topprice}}">
														{{ucwords( strtolower($top->TP_Descrip) )}}
													</a>
												</div>
										@endforeach
									</div>
								{{--TOPPINGS LOAD--}}
							@else
								<b>NO toppings for this size</b>
							@endif
							<?php
								$indice++;
								$classActive = '';
							?>
						</div>
					@endforeach

				@else
					<b>NO toppings for this item</b>
				@endif
			</div>
		</div>

	</div>
</div>
<!-- TOPPINGS CATEGORY -->








				</div>
			</div>
			@else
			<h2>No Toppings for now</h2>
			@endif
		</div>
		<div class="col-xs-4">
			<h4>Cooking Instructions</h4>
			@foreach($cooking_instructions as $array => $instruction)
				<div class="checkbox">
					<label>
						<input data-top-id="{{$instruction->Tp_Id}}" class="instruction" type="checkbox">
						<span>{{ucwords( strtolower($instruction->Tp_Descrip) )}}</span>
					</label>
				</div>
			@endforeach
		</div>
	</div>
</div>

@stop