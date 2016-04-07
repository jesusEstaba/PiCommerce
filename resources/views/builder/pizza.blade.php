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

		@if($tp_kind==1)
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
			@if($toppings)
			<div class="row">
				<div class="col-xs-12">
					<p class="text-drag-drop-desc">
						This is a drag & drop items.
					</p>






<!-- TOPPINGS CATEGORY -->
<div class="topping_category">
	<?php
		if($tp_kind==1)
			$categoria = ['cheese'=>1,  'meats'=>2,  'vegetables'=>3, 'Specialty'=>4];
		else
			$categoria = ['dressing and sauces'=>-1];
	?>
	<div class="row">
		
		@foreach($categoria as $name_category => $id_cat_top)
		
		@if( isset($categoria['dressing and sauces']) )
			<div class="col-md-12">
		@else
			<div class="col-md-6">
		@endif	
			<h4 class="{{snake_case($name_category)}}">{{ucwords($name_category)}}</h4>
			
			<div class="toppings-btns">
				@foreach($toppings as $data => $top)
				
					@if($id_cat_top==$top->Tp_Cat)
						<div class="box-drag">
							<a data-id-top="{{$top->Tp_Id}}" class="btn drag" data-double="{{$top->Tp_Double}}" data-price="{{$top->Tp_Topprice}}">
								{{ucwords( strtolower($top->TP_Descrip) )}}
							</a>
						</div>
					@endif
				@endforeach
			</div>
		</div>
		@endforeach

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