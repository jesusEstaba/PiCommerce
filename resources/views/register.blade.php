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
							<input type="email" class="form-control" name="email" placeholder="Email" />
						</div>
						<div class="input-form">
							<label>Phone:</label>
							<input type="text" name="phone" placeholder="Phone" class="form-control" />	
						</div>

						

						<div id="from-datepicker">
							<label>Dirthdate:</label>
							<div class="input-group">
								<input placeholder="Birthdate(optional)" aria-describedby="basic-addon1" class="form-control" data-format="dd/MM/yyyy" type="text" name="birthday"></input>
								<span class="input-group-addon add-on" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
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
							<label>Zip Code:</label>
							<input type="text" name="zip_code" placeholder="Zipe Code" class="form-control"/>
						</div>
						
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
							<label>City:</label>
							<input type="text" name="city" placeholder="City" class="form-control"/>
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
							<a class="send form-control btn btn-primary">Register</a>
							
						</div>
					</div>
				</div>
				
				<input type="submit" class="hide sending" value="reg" />
				{!!Form::token()!!}
			{!!Form::close()!!}
		</div>
	</div>
</div>



<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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
	.send{
		margin-bottom: 3em;
	}
</style>


	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

	<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
	
	<script src="{{url('assets/datetimepicker/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="{{url('assets/datetimepicker/bootstrap-datetimepicker.min.css')}}">


<script type="text/javascript">

	var fecha_act = new Date();

	var startDate = new Date( ( fecha_act.getFullYear()-100 )+'-01-01');
	var endDate = new Date(fecha_act.getFullYear() + "-" + (fecha_act.getMonth()+1) + "-" + fecha_act.getDate());
    
    $('#from-datepicker').datetimepicker({
    	pickTime: false,
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 4,
        keyboardNavigation: 1,
        minView: 1,
        forceParse: 0,
        startDate: startDate,
        endDate: endDate,
        setDate: startDate
    });


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

	    $('[name=zip_code]').autocomplete({
	      source: streets
	    });	

	    $( "#tags" ).autocomplete({
	      source: availableTags
	    });

	    $('.send').click(function(){
	    	var message = "";
	    	
	    	if( !$('[name=password]').val() )
				message += "<li>Password Empty</li>";
			if( $('[name=password]').val()!=$('[name=confirm]').val() )
				message += "<li>Passwords do not match</li>";
			
			if( !$('[name=email]').val() )
				message += "<li>Email Empty</li>"; 
			if( !$('[name=phone]').val() )
				message += "<li>Phone Empty</li>"; 
			if( !$('[name=first_name]').val() )
				message += "<li>First name Empty</li>"; 
			if( !$('[name=last_name]').val() )
				message += "<li>Last Name Empty</li>"; 
			if( !$('[name=street_number]').val() )
				message += "<li>Street Number Empty</li>"; 
			if( !$('[name=street_name]').val() )
				message += "<li>Street Name Empty</li>"; 
			if(!$("[name=terms]:checked").length)
				message += "<li>Accept the Terms and Conditions</li>"; 


			if(message)
			{
				$("#myModal .modal-title").html('<h4>Error</h4>');
				$("#myModal .modal-body").html('<ul>'+message+'</ul>');
				$('#myModal').modal('show');
			}
			else
				$('.sending').click();
	    });






	});
</script>

@stop