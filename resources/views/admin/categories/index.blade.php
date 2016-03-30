@extends('admin.layout')

@section('title', 'Categories')


@section('content')


<div class="box">
	<div class="box-header">
		<h2>Categories <span class="glyphicon glyphicon-plus btn btn-success add"></span></h2>
	</div>
	
	<div class="box-body">
		@if(count($categories))
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								<b>Name</b>
							</th>
							<th>
								<b>Url</b>
							</th>
							<th>
								<b>Gruop</b>
							</th>
							<th>
								<b>Status</b>
							</th>
							<th>
								<b>More</b>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($categories as $category)
						<tr>
							<td>
								{{$category->name}}
							</td>
							<td>
								<a target="_blank" href="{{url('category/'.$category->name_cat)}}">{{$category->name_cat}}</a>
							</td>
							<td>
								{{$category->Gr_Descrip}}
							</td>
							<td>
								@if(!$category->Status)
								<span id-cat="{{$category->id}}" class="visible-sta status glyphicon glyphicon-eye-open btn btn-success"></span>
								@else
								<span id-cat="{{$category->id}}" class="visible-sta status glyphicon glyphicon-eye-close btn btn-danger"></span>
								@endif
							</td>
							<td>
								<a href="{{url('admin/categories/'.$category->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5">
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					@if(isset($search))
					{!!$categories->appends(['search' => $search])->render()!!}
					@else
					{!!$categories->render()!!}
					@endif
				</div>
			</div>
		</div>
		@else
		<h3 class="text-muted text-center">No Results</h3>
		<br>
		
		@endif
	</div>
</div>


{!!Form::token()!!}



<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Category</h4>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label>Name:</label>
	      <input type="text" class="form-control" name="name" placeholder="Name Category" autocomplete="off">
	    </div>

	    <div class="form-group">
	    	<label>Url:</label>
	      <input type="text" class="form-control" name="url" placeholder="Url Category" autocomplete="off">
	    </div>

		<div class="form-group">
			<label>Groups:</label>
			<select class="form-control" name="category">
				<option value="">Groups</option>
				@foreach($groups as $array => $group)
					<option value="{{$group->Gr_ID}}">{{$group->Gr_Descrip}}</option>
				@endforeach
			</select>
		</div>

	    <div class="form-group">
	    	<label>Sub menu:</label>
	    	<label class="form-control">
	    		<input type="checkbox"name="submenu">
	    		Active Sub menu?
	    		<br>
	    	<span class="text-muted" style="font-size: .8em;">
	    		you can see the sizes as items.
	    	</span>
	    	</label>
	    	
	    </div>
		<br>
	    <div class="form-group">
	    	<label>Builder Image:</label>
	    	<input class="form-control" id="image" name="image_upload" type="file" />
	    </div>

	    <div class="form-group">
	    	<label>Banner:</label>
	    	<input class="form-control" id="banner" name="image_upload" type="file" />
	    </div>
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop




@section('script')
<script type="text/javascript">

	$(function()
	{
		$('.sidebar-menu li:eq(3)')
			.addClass('active');

		$('.sidebar-menu li:eq(4)')
			.addClass('active');





	$('.visible-sta').click(function(){
		if( $(this).hasClass('glyphicon-eye-open') )
		{
			$(this)
				.removeClass('glyphicon-eye-open')
				.removeClass('btn-success')
				.addClass('glyphicon-eye-close')
				.addClass('btn-danger')
				
		}
		else
		{
			$(this)
				.addClass('glyphicon-eye-open')
				.addClass('btn-success')
				.removeClass('glyphicon-eye-close')
				.removeClass('btn-danger')
		}
	});
///////////////////////////
	$('.status').click(function(){
		var status = 0;

		if( $(this).hasClass('glyphicon-eye-close') )
			status = 1

		var id = $(this).attr('id-cat');


		$.ajax({
			url: 'categories/'+id,
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {change_visible: true, status:status},
		})
		.done(function(data) {
		})
		.fail(function() {
			console.log("error");
		});
		
	});

	$('.add').click(function(){
		$('#myModal').modal();
	});

	$('.save').click(function(){
		if(
			$("[name=name").val() &&
			$("[name=url").val() &&
			$("[name=category").val()
		)
		{


		var inputFileImage = document.getElementById('image');

		var file = inputFileImage.files[0];

		var data = new FormData();

		data.append('name', $("[name=name").val());
		data.append('url', $("[name=url").val());
		data.append('group', $("[name=category").val());
		data.append('sub', $("[name=submenu]:checked").length);

		data.append('imagen',file);




		$.ajax(
		{
			type: 'POST',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			
			contentType:false,

			data:data,

			processData:false,

			cache:false

		})
		.done(function(data) {
			if(data=="created")
			{
				$("[name=name").val();
				$("[name=url").val();
				$("[name=category").val();
				$("[name=submenu]").prop('checked', false);
				
				document.location.reload(true);
			}

		})

		}
		else
			alert("Field Empty");
	});

	});
</script>
@stop