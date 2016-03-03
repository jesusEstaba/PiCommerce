@extends('admin.layout')
@section('title', 'Groups')
@section('content')
	<h2>Groups <span class="glyphicon glyphicon-plus btn btn-success new"></span></h2>

	@if($groups)
		<table class="table">
			<thead>
				<tr>
					<td>
						<b>Description</b>
					</td>
					<td>
						<b>Order</b>
					</td>
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
						<td>
							{{$group->Gr_Special}}
						</td>
						
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<h2>No Results</h2>
	@endif


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Group</h4>
      </div>
      <div class="modal-body">

      	<div class="input-group">
	      <input type="text" class="form-control" name="name" placeholder="Description Name" autocomplete="off">
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
</script>
@stop