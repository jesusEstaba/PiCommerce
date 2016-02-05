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
				<div class="row">
					<div class="col-md-6">
						<div class="input-group">
							<input type="text" class="form-control" name="name" placeholder="name" />
						</div>
						<div class="input-group">	
							<input type="text" class="form-control" name="email" placeholder="email" />
						</div>
						<div class="input-group">	
							<input type="password" class="form-control" name="password" placeholder="password" />
						</div>
						<div class="input-group">	
							<input type="password" class="form-control" name="confirm" placeholder="confirm password" />
						</div>
						
						<div class="input-group">	
							<input type="submit" class="form-control" />
						</div>
					</div>
					<div class="col-md-6">
						<div class="input-group">	
							<input type="text" placeholder="direccion" class="form-control" id="tags" />
						</div>
					</div>
				</div>
				

				{!!Form::token()!!}
			{!!Form::close()!!}
		</div>
	</div>
</div>


<style type="text/css">
	.input-group{
		margin-bottom: .5em;
	}
</style>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		var availableTags = [
		@foreach($codes as $tab => $table)
			"{{$table->St_Name}}",
		@endforeach
	    ];

	    $( "#tags" ).autocomplete({
	      source: availableTags
	    });	
	});
</script>

@stop