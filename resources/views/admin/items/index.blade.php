@extends('admin.layout')

@section('title', 'Items')

@section('content')



<div class="box">
	
	<div class="box-header">
		<h2>Items <span class="glyphicon glyphicon-plus btn btn-success add-new"></span></h2>
	</div>

	<div class="box-body">

@if( count($items) )


		<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
			

			<div class="row">
				<div class="col-xs-12">

					<form action="{{url('admin/items')}}" method="get">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search for Name Items" name="search" autocomplete="off">
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


				<div class="col-sm-6">
					<div class="dataTables_length" id="example1_length">
						<label>Show
							<select name="example1_length" aria-controls="example1" class="form-control input-sm">
								<option value="10">10
								</option>
								<option value="25">25
								</option>
								<option value="50">50
								</option>
								<option value="100">100
								</option>
							</select> entries
						</label>
					</div>
				</div>
				<div class="col-sm-6">
					<div id="example1_filter" class="dataTables_filter">
						<label>Search:
							<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1">
						</label>
					</div>
				</div>
			</div>
			


			<div class="row">
				<div class="col-sm-12">
					<table class="table table-bordered table-striped dataTable">
						<thead>
							<tr role="row">
								<th class="sorting">
									Name
								</th>
								<th class="sorting">
									Description
								</th>
								<th class="sorting">
									Group
								</th>
								<th class="sorting">
									Status
								</th>
								<th class="sorting">
									More
								</th>
							</tr>
						</thead>
						<tbody>
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
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-5">
					<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
						Showing {{$items->currentPage()}} to {{$items->lastPage()}} of {{$items->total()}} entries
					</div>
				</div>
				<div class="col-sm-7">
					<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
						@if(isset($search))
						{!!$items->appends(['search' => $search, 'category'=>$category])->render()!!}
						@else
						{!!$items->render()!!}
						@endif
					</div>
				</div>
			</div>
		</div>

	@else
		<h3 class="text-muted text-center">No Results</h3>
		<br>
	@endif


</div>
		
















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

	$(function()
	{
		$('.sidebar-menu li:eq(1)').addClass('active');
		

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
						document.location.reload(true);
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
	})
</script>
@stop