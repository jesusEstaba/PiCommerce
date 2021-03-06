@extends('admin.layout')

@section('title', 'Config')

@section('content')
	<h2>Config</h2>


	@if( $config )


<div class="row">
	<div class="col-md-6">
	<div class="box">
		<div class="box-body">
			<h3>Maintenance Mode 
	
		@if($config->closed)
			<span class="btn btn-default glyphicon glyphicon-off on"></span>
		@else
			<span class="btn btn-default glyphicon glyphicon-off off"></span>
		@endif

		<span class="glyphicon closed_edit glyphicon-pencil btn btn-default"></span>
	</h3>
<div class="divisor">
	
	<p>
		{{$config->message_close}}
	</p>
		</div>

<hr>
				<div class="box-header">
					<h3>Footer
						<span class="glyphicon footer_edit glyphicon-pencil btn btn-default"></span>
					</h3>
				</div>
				<div class="box-body">
					{!! $config->footer !!}
				</div>
<hr>
				<div class="box-header">
					<h3>Change Logo
						<span class="glyphicon logo_edit glyphicon-pencil btn btn-default"></span>
					</h3>
				</div>
				<div class="box-body">
					<img class="img-responsive" src="{{asset('images/logos/'.$config->logo) }}">
				</div>





	</div>
		

</div>
	</div>

	<div class="col-md-6">
		<div class="box">
			<div class="box-body">
				<h3>Social Networks <span class="glyphicon social edit glyphicon-pencil btn btn-default"></span></h3>
		<div class="divisor">
			<p><b>Facebook :</b><a target="_blank" href="{{$config->facebook}}">{{$config->facebook}}</a></p>
			<p><b>Twitter :</b><a target="_blank" href="{{$config->twitter}}">{{$config->twitter}}</a></p>
			<p><b>Instagram :</b><a target="_blank" href="{{$config->instagram}}">{{$config->instagram}}</a></p>
			<p><b>Google+ :</b><a target="_blank" href="{{$config->gplus}}">{{$config->gplus}}</a></p>
		</div>
			</div>


	<hr>
				<div class="box-header">
					<h3>Change Background
						<span class="glyphicon background_edit glyphicon-pencil btn btn-default"></span>
					</h3>
				</div>
				<div class="box-body">
					<img class="img-responsive" src="{{asset('images/backgrounds/'.$config->background) }}">
				</div>
		</div>


	
	



	</div>


</div>

<div class="box">
	<div class="box-header">
		<h3>Hours <span class="glyphicon hour edit glyphicon-pencil btn btn-default"></span></h3>
	</div>
	

	<div class="box-body">

	<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
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

			</div>
	</div>

	</div>
</div>





				
		
	@endif


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Hour</h4>
      </div>
      <div class="modal-body">
	
	<div class="form-group">
		<label>Day:</label>
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
      	<div class="form-group">
      		<label>Open: </label>
	      	<div>
				<div id="open" class="calendar-time">
					<select class="hourselect"><!-- <option value="6" selected="selected">6 -->
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option selected="selected" value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
					</select> :
					
					<select class="minuteselect">
						<option value="0">00
						</option>
						<option value="30" selected="selected">30
						</option>
					</select>

				</div>
        	</div>
	    </div>
	    <div class="form-group">
	    	<label>Close:</label>
	      	<div>
				<div id="close" class="calendar-time">
					<select class="hourselect"><!-- <option value="6" selected="selected">6 -->
						<option value="1">1
						</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						<option value="13">13</option>
						<option value="14">14</option>
						<option value="15">15</option>
						<option value="16">16</option>
						<option value="17">17</option>
						<option value="18">18</option>
						<option value="19">19</option>
						<option value="20">20</option>
						<option selected="selected" value="21">21</option>
						<option value="22">22</option>
						<option value="23">23</option>
						<option value="24">24</option>
					</select> :
					
					<select class="minuteselect">
						<option value="0" selected="selected">00
						</option>
						<option value="30">30
						</option>
					</select>

				</div>
        	</div>
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
	
	<div class="form-group">
		<label>Social Networks:</label>
		<select class="form-control" name="social-net">
			<option value="">Social Network</option>
			<option value="1">Facebook</option>
			<option value="2">Twitter</option>
			<option value="3">Instagram</option>
			<option value="4">Google+</option>
		</select>
	</div>
      	<div class="form-group">
      		<label>Url:</label>
	      <input type="text" class="form-control" name="url" placeholder="Social Network URL" autocomplete="off">
	    </div>  
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save social" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div id="myModalClosed" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Closed</h4>
      </div>
      <div class="modal-body">
	
      	<div class="form-group">
      		<label>Message:</label>
	      <textarea class="form-control" name="closed_message" placeholder="message when the site is closed"></textarea>
	    </div>  
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-closed" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="myModalFooter" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Footer</h4>
      </div>
      <div class="modal-body">
	
      	<div class="form-group">
      		<label>Message Footer:</label>

		<textarea id="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                    	
        </textarea>

	    </div>  
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-footer" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div id="myModalLogo" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Logo</h4>
      </div>
      <div class="modal-body">
	
	<div class="form-group">
		<label>Logo Image:</label>
		<input type="file" name="logo_img" id="logo_img" class="form-control"></input>
	</div> 
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-logo" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<div id="myModalBackground" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Logo</h4>
      </div>
      <div class="modal-body">
	
	<div class="form-group">
		<label>Background Image:</label>
		<input type="file" name="background_img" id="background_img" class="form-control"></input>
	</div> 
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-background" data-dismiss="modal">Save</button>
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

<link rel="stylesheet" href="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

<script src="{{asset('assets/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

<script type="text/javascript">

function hora_24(element)
{
	var hora = $('#'+element).children('.hourselect').val()+':'+$('#'+element).children('.minuteselect').val();
	
	$('#'+element).children('.hourselect').val("");
	$('#'+element).children('.minuteselect').val("");

	return hora;
}
	$(function()
	{	
		$("#textarea").wysihtml5();


		$('#config').addClass('active');

		$('.footer_edit').click(function(){
			$('#myModalFooter').modal();
		});

		$('.background_edit').click(function(){
			$('#myModalBackground').modal();
		});


		$('.logo_edit').click(function(){
			$('#myModalLogo').modal();
		});


		$('.closed_edit').click(function(){
			$('#myModalClosed').modal();
		});


$('.save-closed').click(function(){
	if( $("[name=closed_message]").val() )
	{
		$.ajax({
				url: 'config/5',
				type: 'PUT',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data: {
					message:$("[name=closed_message]").val()
				},
			})
			.done(function(data)
			{
				document.location.reload(true);
			});
	}
	else
		alert("Field Empty");

});


$('.save-footer').click(function(){
	if( $("#textarea").val() )
	{
		$.ajax({
				url: 'config/4',
				type: 'PUT',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data: {
					footer:$("#textarea").val()
				},
			})
			.done(function(data)
			{
					document.location.reload(true);
			});
	}
	else
		alert("Field Empty");

});

$('.save-logo').click(function(){

	if( $("[name=logo_img]").val() )
	{

		var img_ele = document.getElementById('logo_img');
		var file_img = img_ele.files[0];

		var data = new FormData();

		data.append('logo', file_img);

		$.ajax({
				type: 'POST',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data:data,
				contentType:false,
				processData:false,
				cache:false
			})
			.done(function(data) {
				document.location.reload(true);
			});

	}	
	else
		alert("Field Empty");
});


$('.save-background').click(function(){

	if( $("[name=background_img]").val() )
	{

		var img_ele = document.getElementById('background_img');
		var file_img = img_ele.files[0];

		var data = new FormData();

		data.append('background', file_img);

		$.ajax({
				type: 'POST',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data:data,
				contentType:false,
				processData:false,
				cache:false
			})
			.done(function(data) {
				document.location.reload(true);
			});

	}	
	else
		alert("Field Empty");
});






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
					document.location.reload(true);
				}
			});

		else
			alert("Choose Social Network");
	});

	$('.save.hour').click(function(){
		
		if( $("[name=day]").val() )
			$.ajax({
				url: 'config/2',
				type: 'PUT',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data: {
					change_hour:true, 
					day:$("[name=day]").val(),
					open:hora_24('open'),
					close:hora_24('close'),
				},
			})
			.done(function(data) {
				$("[name=day]").val("");
	
				document.location.reload(true);
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
	});
</script>
@stop