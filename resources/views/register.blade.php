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

	<div class="row bg-white">
		<div class="col-xs-12">
			<h2>Register</h2>
			{!!Form::open(['url'=>'register'])!!}
				<div class="row">
					
					<div class="col-md-6">
						<div class="input-form">
							<label>Name:</label>
							<input type="text" class="form-control" name="name" placeholder="Name" />
						</div>
						<div class="input-form">
							<label>Email:</label>	
							<input type="text" class="form-control" name="email" placeholder="Email" />
						</div>
						<div class="input-form">
							<label>Password:</label>	
							<input type="password" class="form-control" name="password" placeholder="Password" />
						</div>
						<div class="input-form">
							<label>Repeat Password:</label>	
							<input type="password" class="form-control" name="confirm" placeholder="Confirm Password" />
						</div>
					</div>
					
					<div class="col-md-6">

						<div class="input-form">
							<label>Phone:</label>
							<input type="text" name="phone" placeholder="Phone" class="form-control" />	
						</div>
						<div class="input-form">
							<label>Address Name:</label>
							<input type="text" name="address" placeholder="Address" class="form-control" id="tags" />
						</div>
					</div>
					
					<div class="col-xs-offset-4 col-xs-4">
						<div class="input-form">
							<input type="submit" class="form-control btn btn-primary" value="Register" />
						</div>
					</div>
				</div>
				

				{!!Form::token()!!}
			{!!Form::close()!!}
		</div>
	</div>
</div>


<style type="text/css">
	.input-form{
		margin-bottom: .5em;
	}
	.input-group input{
		max-width: 100% !important;
		border-radius: 3px !important;
	}
	.bg-white{
		background: white;
	}
</style>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		var availableTags = [
		@foreach($codes as $tab => $table)
			"{{strtolower($table->St_Name)}}",
		@endforeach
	    ];

	    $( "#tags" ).autocomplete({
	      source: availableTags
	    });	
	});
</script>

@stop