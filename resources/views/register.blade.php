@extends('sections.main')

@section('title', 'Register')
@section('content')

<div class="container space">

	@if( Session::has('message') )
		<div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Success!</strong> {{Session::get('message')}}.
		</div>
	@endif

	@if( Session::has('message-error') )
		<div class="alert alert-warning alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <strong>Error!</strong> {{Session::get('message-error')}}.
		</div>
	@endif

	<div class="row">
		<div class="col-xs-12">
			<h2>Register</h2>
			{!!Form::open(['url'=>'register'])!!}
				<div class="input-group">
					<input type="text" class="form-control" name="name" placeholder="name" />
					<input type="text" class="form-control" name="email" placeholder="email" />
					<input type="password" class="form-control" name="password" placeholder="password" />
					<input type="password" class="form-control" name="confirm" placeholder="confirm password" />
					<input type="submit" class="form-control" />
				</div>
				{!!Form::token()!!}
			{!!Form::close()!!}
		</div>
	</div>
</div>

@stop