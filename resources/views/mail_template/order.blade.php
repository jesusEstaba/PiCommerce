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
		@endforeach
	</div>
</div>
		
@endforeach