@extends('sections.main')

@section('title', 'Checkout')
@section('content')

<div class="container space">

<div class="row">
	<div class="col-xs-12">
		<img style="display: block;margin: auto;" width="300" src="{{asset('images/logos/empty_bill.png')}}" alt="Bill" class="img-responsive">
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<p>
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis rhoncus erat et sagittis finibus. Phasellus condimentum quam sem, ac finibus dolor aliquam ut. Duis convallis arcu commodo justo egestas accumsan.
			</p>
			<a href="{{url('choose')}}" class="btn btn-primary">Go to Home</a>
		</div>
		<br>
		<br>
	</div>
	
</div>

</div>

@stop