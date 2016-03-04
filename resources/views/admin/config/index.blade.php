@extends('admin.layout')

@section('title', 'Config')

@section('content')
	<h2>Config</h2>


	@if( $config )


<div class="row">
	<div class="col-md-6">
		<h3>Maintenance Mode 
	
		@if($config->closed)
			<span class="btn btn-default glyphicon glyphicon-off on"></span>
		@else
			<span class="btn btn-default glyphicon glyphicon-off off"></span>
		@endif
	</h3>
<div class="divisor">
	
	<p>
		{{$config->message_close}}
	</p>
</div>
	</div>

	<div class="col-md-6">
		<h3>Social Networks <span class="glyphicon social edit glyphicon-pencil btn btn-default"></span></h3>
		<div class="divisor">
			<p><b>Facebook :</b><a target="_blank" href="{{$config->facebook}}">{{$config->facebook}}</a></p>
			<p><b>Twitter :</b><a target="_blank" href="{{$config->twitter}}">{{$config->twitter}}</a></p>
			<p><b>Instagram :</b><a target="_blank" href="{{$config->instagram}}">{{$config->instagram}}</a></p>
			<p><b>Google+ :</b><a target="_blank" href="{{$config->gplus}}">{{$config->gplus}}</a></p>
		</div>
	</div>
</div>
	
<h3>Hours <span class="glyphicon hour edit glyphicon-pencil btn btn-default"></span></h3>
		<table class="table">
			<thead>
				<tr>
					<td>
						<b>Day</b>
					</td>
					<td>
						<b>Open</b>
					</td>
					<td>
						<b>Close</b>
					</td>
				</tr>
			</thead>
		
		<tbody>
			<tr>	
				<td>
				Monday
				</td>
				<td>
					<span class="hora-open">{{$config->mon_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->mon_close}}</span>
				</td>
			</tr>
			<tr>	
				<td>
				Tuesday
				</td>
				<td>
					<span class="hora-open">{{$config->tue_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->tue_close}}</span>
				</td>
			</tr>
			<tr>	
				<td>
				Wednesday
				</td>
				<td>
					<span class="hora-open">{{$config->wed_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->wed_close}}</span>
				</td>
			</tr>
			<tr>	
				<td>
				Thursday
				</td>
				<td>
					<span class="hora-open">{{$config->thu_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->thu_close}}</span>
				</td>
			</tr>
			<tr>	
				<td>
				Friday
				</td>
				<td>
					<span class="hora-open">{{$config->fri_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->fri_close}}</span>
				</td>
			</tr>
			<tr>	
				<td>
				Saturday
				</td>
				<td>
					<span class="hora-open">{{$config->sat_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->sat_close}}</span>
				</td>
			</tr>
			<tr>	
				<td>
				Sunday
				</td>
				<td>
					<span class="hora-open">{{$config->sun_open}}</span>
				</td>
				<td> 
					<span class="hora-close">{{$config->sun_close}}</span>
				</td>
			</tr>
			</tbody>
		</table>	
		
	@endif


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Hour</h4>
      </div>
      <div class="modal-body">
	
	<div class="input-group">
		<select class="form-control" name="day">
			<option value="">Day</option>
			<option value="1">Monday</option>
			<option value="2">Tuesday</option>
			<option value="3">Wednesday</option>
			<option value="4">Thursday</option>
			<option value="5">Friday</option>
			<option value="6">Saturday</option>
			<option value="7">Sunday</option>
		</select>
	</div>
      	<div class="input-group">
      		<label>Open: </label>
	      <input type="time" class="form-control" name="open" placeholder="Open" autocomplete="off">
	    </div>
	    <div class="input-group">
	    	<label>Close:</label>
	      <input type="time" class="form-control" name="close" placeholder="Close" autocomplete="off">
	    </div>    
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save hour" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="myModalSocial" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Social Networks</h4>
      </div>
      <div class="modal-body">
	
	<div class="input-group">
		<select class="form-control" name="social-net">
			<option value="">Social Network</option>
			<option value="1">Facebook</option>
			<option value="2">Twitter</option>
			<option value="3">Instagram</option>
			<option value="4">Google+</option>
		</select>
	</div>
      	<div class="input-group">
	      <input type="text" class="form-control" name="url" placeholder="Url" autocomplete="off">
	    </div>  
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save social" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



{!!Form::token()!!}
<style type="text/css">
	.divisor{
		padding: .5em;
		border-radius: 3px;
		margin-bottom: .5em;
		border: solid 1px #eee;
	}
	.on{
color:green;
	}
	.off{
		color:red;
	}
</style>

@stop

@section('script')

<script type="text/javascript">
	$('.save.social').click(function(){
		
		if( $("[name=social-net]").val() )
			$.ajax({
				url: 'config/3',
				type: 'PUT',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data: {
					change_social:true, 
					social:$("[name=social-net]").val(),
					url:$("[name=url]").val()
					
				},
			})
			.done(function(data) {
				if(data=="social changed")
				{
					$("[name=social-net]").val("");
					$("[name=url]").val("");
				}
			});

		else
			alert("Choose Social Network");
	});

	$('.save.hour').click(function(){
		
		if( $("[name=day]").val() && ( $('[name=open]').val() || $('[name=close]').val() ) )
			$.ajax({
				url: 'config/2',
				type: 'PUT',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data: {
					change_hour:true, 
					day:$("[name=day]").val(),
					open:$('[name=open]').val(),
					close:$('[name=close]').val(),
				},
			})
			.done(function(data) {
				if(data=="time changed")
				{
					$("[name=day]").val("");
					$('[name=open]').val("");
					$('[name=close]').val("");
				}
			});

		else
			alert("Field Empty");
	});



	$('.edit.hour').click(function(){
		$('#myModal').modal();
	});

	$('.edit.social').click(function(){
		$('#myModalSocial').modal();
	});

	$('.glyphicon.glyphicon-off').click(function(){
		if( $(this).hasClass('on') )
		{
			$(this)
				.removeClass('on')
				.addClass('off')
				
		}
		else
		{
			$(this)
				.addClass('on')
				.removeClass('off')
		}
	});

	$('.glyphicon-off').click(function(){
		var status = 0;

		if( $(this).hasClass('on') )
			status = 1

		$.ajax({
			url: 'config/1',
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {change_state:true, status:status},
		})
		.done(function(data) {
		})
		.fail(function() {
			console.log("error");
		});
		
	});
</script>
@stop