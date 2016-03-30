@extends('admin.layout')
@section('title', 'Groups')
@section('content')
	

<div class="box">
	<div class="box-header">
		<h2>Groups <span class="glyphicon glyphicon-plus btn btn-success new"></span></h2>
	</div>
	<div class="box-body">
		@if( count($groups) )
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								<b>Description</b>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($groups as $arra => $group)
						<tr>
							<td class="hide">
								{{$group->Gr_ID}}
							</td>
							<td>
								{{$group->Gr_Descrip}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@else
		<h3 class="text-muted text-center">No Results</h3>
		<br>
		
		@endif
	</div>
</div>


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Group</h4>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label>Name</label>
	      <input type="text" class="form-control" name="name" placeholder="Name Group" autocomplete="off">
	    </div>
    
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  {!!Form::token()!!}
</div><!-- /.modal -->


@stop


@section('script')
<script type="text/javascript">


$(function(){
	$('.sidebar-menu li:eq(3)')
			.addClass('active');

		$('.sidebar-menu li:eq(5)')
			.addClass('active');



	$('.new').click(function(){
		$('#myModal').modal();
	});

	$('.save').click(function(){

		$.ajax({
			//url: $('#id_item').attr('id-item'),
			type: 'POST',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data:
			{
				name: $("[name=name]").val(),
			},
		})
		.done(function(data)
		{
			if("New Group"==data)
			{
				console.log(data);
				$('tbody').prepend('<tr><td>'+$("[name=name]").val()+'</td><td>0</td></tr>');
				
				$("[name=name]").val("");
			}
		})
		.fail(function()
		{
			console.log("error");
		});
	});


});
</script>
@stop