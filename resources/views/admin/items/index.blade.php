@extends('admin.layout')

@section('title', 'Items')

@section('content')
<h2>Items <span class="glyphicon glyphicon-plus btn btn-success add-new"></span></h2>
<div>
	<form action="{{url('admin/items')}}" method="get">
		<div class="input-group">
	      <input type="text" class="form-control" placeholder="Search for Items" name="search" autocomplete="off">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
	      </span>
	    </div>
	    <select name="category">
	    	<option value="">Groups</option>
	    	@foreach($groups as $array => $group)
	    		<option value="{{$group->Gr_ID}}">{{$group->Gr_Descrip}}</option>
	    	@endforeach
	    </select>
	</form>
</div>
@if( count($items) )
	<table class="table">
		<tr class="white">
			<td>
				<b>Name</b>	
			</td>
			<td>
				<b>Description</b>	
			</td>
			<td>
				<b>Group</b>
			</td>
			<td>
				<b>Status</b>
			</td>
			<td>
				<b>More</b>
			</td>
		</tr>
		@foreach($items as $item)
			<tr>
				<td>
					{{$item->It_Descrip}}
				</td>
				<td>
					{{$item->description}}
				</td>
				<td>
					{{$item->Gr_Descrip}}
				</td>
				<td>
					@if(!$item->It_Status)
						<span class="glyphicon glyphicon-eye-open text-success"></span>
					@else
						<span class="glyphicon glyphicon-eye-close text-danger"></span>
					@endif
				</td>
				<td>
					<a href="{{url('admin/items/'.$item->It_Id)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
				</td>
			</tr>
		@endforeach
	</table>
	@if(isset($search))
		{!!$items->appends(['search' => $search, 'category'=>$category])->render()!!}
	@else
		{!!$items->render()!!}
	@endif
@else
<h2>No Results</h2>
@endif


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">New Item</h4>
      </div>
      <div class="modal-body">

      	<div class="input-group">
	    	<input type="text" class="form-control" name="name" placeholder="Name" autocomplete="off">
	    </div>
		
		<div class="input-group">
			<select class="form-control" name="category-item">
				<option value="">Groups</option>
				@foreach($groups as $array => $group)
					<option value="{{$group->Gr_ID}}">{{$group->Gr_Descrip}}</option>
				@endforeach
			</select>
		</div>

		<div class="input-group">
	    	<textarea class="form-control" name="descrip-item" placeholder="Description" ></textarea>
	    </div>
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{!!Form::token()!!}

@stop


@section('script')
<script type="text/javascript">
	$('.add-new').click(function(){
		$('#myModal').modal();
	});


	$('.save').click(function(){
		if( $("[name=name]").val() && $('[name=category-item]').val() && $('[name=descrip-item]').val() )
		{
			$.ajax({
				type: 'POST',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data:
				{
					add:true,
					name: $("[name=name]").val(),
					category: $('[name=category-item]').val(),
					descrip: $('[name=descrip-item]').val(),
				},
			})
			.done(function(data)
			{
				if("New Item"==data)
				{
					//Agregar a la vista
					/*
					//
					*/
					$("[name=name]").val("");
					$('[name=category-item]').val("");
					$('[name=descrip-item]').val("");
				}
			})
			.fail(function()
			{
				console.log("error");
			});
		}
		else
		{
			alert("Field Empty");
		}
	});
</script>
@stop