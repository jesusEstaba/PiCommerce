@extends('sections.main')

@section('title', "Product")
@section('content')

<div class="container space">
	<div class="row">
		<div class="col-xs-12">
			<h2>Sorry, this product does not exist or is not available</h2>
			<a href="{{url('menu')}}">Back to Categories</a>
		</div>
	</div>
</div>

@stop