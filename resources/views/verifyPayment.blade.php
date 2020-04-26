@extends('sections.main')

@section('title', 'Verify Payment')
@section('content')
<style type="text/css">
	.box{
		box-shadow: 0 2px 5px rgba(0,0,0,.26);
		padding: .5em;
		border-radius: 3px;
	} 
	.bg-white{
		background: #fff;
	}
</style>

@if($ReturnCode==0)
	<div class="container space">
		<div class="row">
			<div class="col-xs-12">
				<div class="space box bg-white">
					<h2>
						Your Card is {{$verifyResponse['status']}}.
					</h2>
					
					@if($verifyResponse['status'] == 'Approved')
						<h4>
							We sent an email with your order.
						</h4>
					@else
						<p>
							{{$verifyResponse['message']}}
						</p>
					@endif
					
					<a href="{{url('menu')}}" class="btn btn-primary">Back to Menu</a>
				</div>
				
			</div>
		</div>
	</div>

	

@else
	{{-- aca se deberia llamar a un helper para que guarde los errores --}}
	<div class="container space">
		<div class="row">
			<div class="col-xs-12">
				<br>
				<br>
				<h3>{{$ReturnMessage}}</h3>

				<?php ($select = (Auth::check()) ? '' : '/pickup' ) ?>
				
				<a href="{{url('checkout' . $select)}}" class="btn btn-primary">
				Back to Checkout</a>
			</div>
		</div>
	</div>
@endif

@stop