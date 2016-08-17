@extends('sections.main')

@section('title', 'Verify Payment')
@section('content')

@if($ReturnCode==0)
	<div class="container space">
		<div class="row">
			<div class="col-xs-12">
				<br>
				<br>
				<h2 class="very">Verify...</h2>
				<form>
				 	<input type="hidden" name="payId" value="{{$PaymentID}}" />
					{{csrf_field()}}
				</form>

				<a href="{{url('menu')}}" class="btn btn-primary">Back to Home</a>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="{{asset('js/verify.js')}}"></script>
@else
	{{-- aca se deberia llamar a un helper para que guarde los errores --}}
	<div class="container space">
		<div class="row">
			<div class="col-xs-12">
				<br>
				<br>
				<h2>{{$ReturnMessage}}</h2>
				<a href="{{url('checkout')}}" class="btn btn-primary">Back to Checkout</a>
			</div>
		</div>
	</div>
@endif

@stop