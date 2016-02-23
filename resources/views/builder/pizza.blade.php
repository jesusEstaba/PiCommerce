@extends('builder.product')

@section('toppings')
	<ul topprice='0' class="items-toppings">
		<li class="def-top">Pepperoni</li>
		<li class="def-top">Double Cheese</li>
		<li class="def-top">Onios</li>
		<li class="def-top">Corn</li>
	</ul>
@stop

@section('head-data')
<div class="toppings">
	<div class="row">
		<div class="col-md-4">
			<h2>Add Toping</h2>
		</div>
		<div class="col-md-8">
			<div class="btn-sizes">
				<div class="btn-complete-size topping-size" size-top="1" title="Complete">
					<span class="name-size-top">Complete</span>
				</div>
				<div class="btn-semi-left-size topping-size" size-top="2" title="Left Half">
					<span class="name-size-top">Left/Right</span>
				</div>
				<div class="btn-semi-right-size topping-size" size-top="3" title="Right Half">
					
				</div>
				<div class="btn-double-size topping-size" size-top="4" title="Extra">
					<span class="name-size-top">Extra</span>
				</div>
				<div class="btn-lite-size topping-size" size-top="5" title="Lite">
					<span class="name-size-top">Lite</span>
				</div>
			</div>
			<br>
		</div>
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
					<?php
						$contador = 1;
						$con_catg = 1;
						$categoria= ['cheese', 'meats', 'vegetables', 'fruitx'];
					?>
					<ul class="nav nav-tabs" role="tablist">
						@foreach($categoria as $name_category)
						<li role="presentation">
							<a href="#top-{{$con_catg}}" aria-controls="top-{{$name_category}}" role="tab" data-toggle="tab">
								{{ucwords($name_category)}}
							</a>
						</li>
						<?php
							$con_catg++;
						?>
						@endforeach
					</ul>
					
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="top-1">
							
							@foreach($toppings as $data => $table)
							@if($table->Tp_Cat > $contador)
							<?php
								$contador = $table->Tp_Cat;
							?>
							
						</div>
						<div role="tabpanel" class="tab-pane" id="top-{{$contador}}">
							
							@endif
							
							<div class="box-drag">
								<a id-top="{{$table->Tp_Id}}" class="btn drag">
									{{ucwords( strtolower($table->TP_Descrip) )}}
								</a>
							</div>
							
							
							@endforeach
							
						</div>
						
					</div>
					
				</div>
			</div>
			@else
			<h2>No Toppings for now</h2>
			@endif
		</div>
		<div class="col-xs-4">
			<h4>Cooking Instructions</h4>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Pasta</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Sauce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Cheese</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Crispy</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Extra Crispy</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Pasta</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Sauce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Cheese</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Lite Cook</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Well Done</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Extra Sauce</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>No Parm</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Pasta on Side</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Sauce on Side</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Double Cut</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Square Cut</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Cold</span>
				</label>
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox">
					<span>Hot</span>
				</label>
			</div>
		</div>
	</div>
</div>

@stop