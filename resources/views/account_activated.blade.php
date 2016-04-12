@extends('sections.main')

@section('title', 'Activated')
@section('content')
<div class="container space">
	<div class="row">
		<div class="col-xs-12">
			<img style="margin: auto;display: block;" width="160" class="img-responsive" src="{{asset('images/logos/checkmark-flat.png')}}">
			<h3 class="text-center" style="margin-top: 1.5em;">
				Your account has been verified!
			</h3>
			<br>
			<br>
			<p class="text-center">
				<a href="{{url('login')}}" class="btn btn-success">Go to Login</a>
			</p>
			<br>
		</div>
	</div>
</div>
@stop