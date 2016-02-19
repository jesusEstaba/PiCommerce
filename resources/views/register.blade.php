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
						<h3 class="title-register">Your Personal or Business Contact Information</h3>

						<div class="input-form">
							<label>Fisrt Name:</label>
							<input type="text" class="form-control" name="first_name" placeholder="First Name" />
						</div>

						<div class="input-form">
							<label>Last Name:</label>
							<input type="text" class="form-control" name="last_name" placeholder="Last Name" />
						</div>

						<div class="input-form">
							<label>Email:</label>	
							<input type="text" class="form-control" name="email" placeholder="Email" />
						</div>
						<div class="input-form">
							<label>Phone:</label>
							<input type="text" name="phone" placeholder="Phone" class="form-control" />	
						</div>

						<h3 class="title-register">Your Password</h3>
						<div class="input-form">
							<label>Password:</label>	
							<input type="password" class="form-control" name="password" placeholder="Password" />
						</div>
						<div class="input-form">
							<label>Repeat Password:</label>	
							<input type="password" class="form-control" name="confirm" placeholder="Confirm Password" />
						</div>

						<h3 class="title-register">
							Company Information (Office Delivery Only)
						</h3>
						<div class="input-form">
							<label>Company:</label>
							<input type="text" name="company" placeholder="Company" class="form-control" />	
						</div>
					</div>
					
					<div class="col-md-6">
						

						<h3 class="title-register">Your Address</h3>
						<div class="input-form">
							<label>Street Number:</label>
							<input type="text" name="street_number" placeholder="eg. 2400" class="form-control"/>
						</div>
						<div class="input-form">
							<label>Street Name:</label>
							<input type="text" name="street_name" placeholder="eg. Forsyth Rd" class="form-control" id="tags" />
						</div>
						<div class="input-form">
							<label>Aparment/Suite #:</label>
							<input type="text" name="aparment" placeholder="Aparment or Suite Number" class="form-control"/>
						</div>
						<div class="input-form">
							<label>Aparment Complex:</label>
							<input type="text" name="aparment_complex" placeholder="Aparment Complex" class="form-control"/>
						</div>
						<div class="input-form">
							<label>Complex Name:</label>
							<input type="text" name="complex_name" placeholder="Complex Name" class="form-control"/>
						</div>
						<div class="input-form">
							<label>Zip Code:</label>
							<input type="text" name="zip_code" placeholder="Zipe Code" class="form-control"/>
						</div>
						<div class="input-form">
							<label>City:</label>
							<input type="text" name="city" placeholder="City" class="form-control"/>
						</div>
						<div class="input-form">
							<label>State:</label>
							<input type="text" name="state" placeholder="State" class="form-control"/>
						</div>
						<div class="input-form">
							<label>Country:</label>
							<input type="text" name="country" placeholder="Country" class="form-control"/>
						</div>

						<div class="input-form">
							<label>Special Directions:</label>
							<input type="text" name="special_directions" placeholder="eg. Enter gate code 555" class="form-control"/>
						</div>
						
					</div>
					<div class="reg-data-check">
						<div class="row">
							<div class="col-xs-12">
								<p>
									Receive special offers & coupons by email:
									<input name="newsletter" type="checkbox">
								</p>
							</div>

							<div class="col-xs-12">
								<p>
									<b>
										I have read the terms and conditions notice and I agree to it:
									</b>
									<input name="terms" type="checkbox">
								</p>
								<a href="#">Terms and Conditions.</a>
								
							</div>
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
	h3.title-register{
		background: #10713B;
		color: white;
		padding: .2em;
		border-radius: 3px;
		box-shadow: 0 0 3px rgba(0,0,0,.26);
	}
	.reg-data-check{
		padding: 1em;
	}
</style>


<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<script type="text/javascript">

var streets = [
		@foreach($streets as $tab => $table)
			"{{strtolower($table->St_ZipCode)}}",
		@endforeach
	    ];
	$(document).ready(function() {
		var availableTags = [
		@foreach($codes as $tab => $table)
			"{{strtolower($table->St_Name)}}",
		@endforeach
	    ];

	    $('[name=street_number]').autocomplete({
	      source: streets
	    });	

	    $( "#tags" ).autocomplete({
	      source: availableTags
	    });	
	});
</script>

@stop