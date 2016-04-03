@extends('admin.layout')

@section('title', 'Item')

@section('content')
<a title="Back to Items" href="{{url('kitchen/items')}}"><spam class="backtoback btn btn-default btn-sm glyphicon glyphicon-chevron-left"></spam></a>

@if($item)

<div class="box">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-12">
				<h2 id="id_item" id-item="{{$item->It_Id}}">
				<span class="title-item">{{$item->It_Descrip}}</span>
				<span class="glyphicon edit-item glyphicon-pencil btn btn-primary"></span>
				
				@if(!$item->It_Status)
				<span class="glyphicon visible-sta item-status glyphicon-eye-open btn btn-info"></span>
				@else
				<span class="glyphicon visible-sta item-status glyphicon-eye-close btn btn-danger"></span>
				@endif


				@if($item->It_Feature)
					<span class="btn btn-warning glyphicon item-feature glyphicon glyphicon-star"></span>
				@else
					<span class="btn btn-default glyphicon item-feature glyphicon glyphicon-star"></span>
				@endif
				</h2>
			</div>
		</div>
	</div>
	<div class="box-body">
		<p>
			<b>Group: </b><span class="cat_item">{{$item->Gr_Descrip}}</span>
		</p>
		@if($item->It_ImagePre)
		<p>
			<b>Image: </b><a target="_blank" href="{{url('images/items/'.$item->It_ImagePre)}}">{{$item->It_ImagePre}}</a>
		</p>	
		@endif
		@if($item->description)
		<p class="code">{{$item->description}}</p>
		@else
		<p class="code text-center"><b>No Description.</b></p>
		@endif
	</div>
</div>

<div class="box">
	<div class="box-header">
		<h3>Sizes <span class="glyphicon glyphicon-plus btn btn-success add-size"></h3>
	</div>
	<div class="box-body">
		@if( $sizes )
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Edit
							</th>
							<th>
								Description
							</th>
							<th>
								Abreviation
							</th>
							<th>
								Price
							</th>
							<th>
								Topping Price
							</th>
							<th>
								Topping Price 2
							</th>
							<th>
								Area
							</th>
							<th>
								Status
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($sizes as $key => $size)
						<tr size="{{$size->Sz_Id}}">
							<td><span id-size="{{$size->Sz_Id}}" class="glyphicon edit-size glyphicon-pencil btn btn-default"></span></td>
							<td class="descrip">
								{{$size->Sz_Descrip}}
							</td>
							<td class="abrev">
								{{$size->Sz_Abrev}}
							</td>
							<td class="price">
								$<span>{{$size->Sz_Price}}</span>
							</td>
							<td class="topprice">
								$<span>{{$size->Sz_Topprice}}</span>
							</td>
							<td class="topprice2">
								$<span>{{$size->Sz_Topprice2}}</span>
							</td>
							<td class="area_chan">
								{{$size->Sz_FArea}}
							</td>
							<td>
								@if(!$size->Sz_Status)
								<span id-size="{{$size->Sz_Id}}" class="glyphicon visible-sta status glyphicon-eye-open btn btn-info"></span>
								@else
								<span id-size="{{$size->Sz_Id}}" class="glyphicon visible-sta status glyphicon-eye-close btn btn-danger"></span>
								@endif
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

	@else
		<h2>No Results</h2>
	@endif


{!!Form::token()!!}



<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Size</h4>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label>Description:</label>
	    	<input type="text" class="form-control" name="name" placeholder="Description Size" autocomplete="off">
	    </div>

		<div class="form-group">
	    	<label>Abreviation:</label>
	     	<input type="text" class="form-control" name="size_abrev" placeholder="Abreviation Size" autocomplete="off">
	    </div>

	    <div class="form-group">
	    	<label>Price:</label>
	    	<input type="text" class="form-control" name="price" placeholder="Price Size" autocomplete="off">
	    </div>
	    <div class="form-group">
	    	<label>Topping Price:</label>
	    	<input type="text" class="form-control" name="top_price" placeholder="Topping Price Size" autocomplete="off">
	    </div> 
	    <div class="form-group">
	    	<label>Topping Price 2:</label>
	    	<input type="text" class="form-control" name="top_price2" placeholder="Topping Price Size 2" autocomplete="off">
	    </div>       
        
        <div class="form-group">
		    <label>Area:</label>
			<select class="form-control" name="size_area_change">
				<option value="">Area Size</option>
				@foreach($food as $array => $area)
						<option value="{{$area->F_Abrev}}">{{$area->F_Descripc}}</option>
				@endforeach

			</select>
	    </div>


      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Item</h4>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label>Name:</label>
	      <input type="text" class="form-control" name="item_name" placeholder="Name Category" autocomplete="off">
	    </div>
		
	    <div class="form-group">
	    	<label>Group:</label>
			<select class="form-control" name="category">
				    	<option value="">Groups</option>
				    	@foreach($groups as $array => $group)
				    		<option value="{{$group->Gr_ID}}">{{$group->Gr_Descrip}}</option>
				    	@endforeach
			</select>
	    </div>
	    
	    <div class="form-group">
	    	<label>Description:</label>
			<textarea class="form-control" name="item_descrip" placeholder="Description for Category"></textarea>
	    </div>

	    <div class="form-group">
	    	<label>Image:</label>
	    	<input type="file" class="form-control" id="image">
	    </div>

        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-item" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<div id="addSize" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Size</h4>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label>Description:</label>
	     	<input type="text" class="form-control" name="size-descrip" placeholder="Description Size" autocomplete="off">
	    </div>
	    <div class="form-group">
	    	<label>Abreviation:</label>
	     	<input type="text" class="form-control" name="size-abrev" placeholder="Abreviation Size" autocomplete="off">
	    </div>
	    <div class="form-group">
	    	<label>Price:</label>
	     	<input type="text" class="form-control" name="size-price" placeholder="Price Size" autocomplete="off">
	    </div>
	    <div class="form-group">
	    	<label>Topping Price:</label>
	     	<input type="text" class="form-control" name="size-top_price" placeholder="Topping Price Size" autocomplete="off">
	    </div> 
	    <div class="form-group">
	    	<label>Topping Price 2:</label>
	     	<input type="text" class="form-control" name="size-top_price2" placeholder="Topping Price 2 Size" autocomplete="off">
	    </div>       
	    
	    <div class="form-group">
		    <label>Area:</label>
			<select class="form-control" name="size-area">
				<option value="">Area Size</option>
				@foreach($food as $array => $area)
						<option value="{{$area->F_Abrev}}">{{$area->F_Descripc}}</option>
				@endforeach

			</select>
	    </div>
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary add-new-size" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<style type="text/css">
	.code{
		padding: 1em;
		border:dashed 1px #bebebe;
		background:#eef; 
	}
	.text-center{
		text-align: center;
	}
</style>

@stop




@section('script')
<script type="text/javascript">

	$(function()
	{
		$('#items').addClass('active');
	

	$('.edit-size').click(function(){
		$('.save').attr('id-size', $(this).attr('id-size'));
		$('#myModal').modal();
	});


	$('.edit-item').click(function(){
		$('#ModalEdit').modal();
	});

	$('.save').click(function(){
		
		
		var id = $(this).attr('id-size');

		var elemt = $("[size="+id+"]");

		var abrev = elemt.children('.abrev');
		var price =elemt.children('td.price').children();
		
		var topprice = elemt.children('td.topprice').children();
		
		var descrip = elemt.children('.descrip');
		var price2 = elemt.children('td.topprice2').children();
		var area_change = elemt.children('.area_chan');
		

		$.ajax({
			url: $('#id_item').attr('id-item'),
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data:
			{
				id: id,
				descrip:$('[name=name]').val(), 
				price: $('[name=price]').val(), 
				top_price: $('[name=top_price]').val(),
				size_abrev: $('[name=size_abrev]').val(),
				top_price2: $('[name=top_price2]').val(),
				size_area_change:$('[name=size_area_change]').val()
			},
		})
		.done(function(data) {
			console.log(data.state);

			if( $('[name=name]').val() )
				descrip.html($('[name=name]').val());
			if( $('[name=price]').val() )
				price.html( $('[name=price]').val() );
			if( $('[name=top_price]').val() )
				topprice.html( $('[name=top_price]').val() );

			if( $('[name=size_abrev]').val() )
				abrev.html($('[name=size_abrev]').val());

			if( $('[name=top_price2]').val() )
				price2.html($('[name=top_price2]').val());

			if( $('[name=size_area_change]').val() )
				area_change.html($('[name=size_area_change]').val());

			$('[name=size_abrev]').val("");
			$('[name=top_price2]').val("");
			$('[name=size_area_change]').val("");

			$('[name=name]').val("")
			$('[name=price]').val("")
			$('[name=top_price]').val("")
				
		})
		.fail(function() {
			console.log("error");
		});
	});


	$('.visible-sta').click(function(){
		if( $(this).hasClass('glyphicon-eye-open') )
		{
			$(this)
				.removeClass('glyphicon-eye-open')
				.removeClass('btn-info')
				.addClass('glyphicon-eye-close')
				.addClass('btn-danger')
				
		}
		else
		{
			$(this)
				.addClass('glyphicon-eye-open')
				.addClass('btn-info')
				.removeClass('glyphicon-eye-close')
				.removeClass('btn-danger')
		}
	});


	$('.item-feature').click(function(){
		$(this)
			.toggleClass('btn-default')
			.toggleClass('btn-warning')
	});



	

	$('.status').click(function(){
		var status = 0;

		if( $(this).hasClass('glyphicon-eye-close') )
			status = 1

		$.ajax({
			url: $('#id_item').attr('id-item'),
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {change_visible: $(this).attr('id-size'), status:status},
		})
		.done(function(data) {
		})
		.fail(function() {
			console.log("error");
		});
		
	});


	$('.item-status').click(function(){
		var status = 0;

		if( $(this).hasClass('glyphicon-eye-close') )
			status = 1

		$.ajax({
			url: $('#id_item').attr('id-item'),
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {item_visible: "visible", status:status},
		});
		
	});


	$('.item-feature').click(function(){
		var status = 0;

		if( $(this).hasClass('btn-warning') )
			status = 1

		$.ajax({
			url: $('#id_item').attr('id-item'),
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {item_feature: "visible", status:status},
		});
		
	});


	$('.save-item').click(function(){
		

		var img_ele = document.getElementById('image');
		var file_img = img_ele.files[0];

		var data = new FormData();

		data.append('imagen', file_img);
		data.append('edit_item',  true);
		data.append('name', $("[name=item_name]").val());
		data.append('descrip', $("[name=item_descrip]").val());
		data.append('category', $("[name=category]").val());
		data.append('id', $('#id_item').attr('id-item'));

		//	url: $('#id_item').attr('id-item'),
		
		$.ajax({
			
			url: '/kitchen/items',
			type: 'POST',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data:data,
			contentType:false,
			processData:false,
			cache:false,
		})
		.done(function(data) {

			if( $("[name=item_descrip]").val() )
			{
				if( $('.code').hasClass('text-center') )
				{
					$('.code').removeClass('text-center')
				}
				
				$('.code').html($("[name=item_descrip]").val());
			}

			if( $("[name=item_name]").val() )
				$('.title-item').html($("[name=item_name]").val())

			if( $("[name=category]").val() )
				$('.cat_item').html($("[name=category] option:selected").text());

			$("[name=item_name]").val("");
			$("[name=item_descrip]").val("");
			$("[name=category]").val("");

			//document.location.reload(true);
		})
		.fail(function() {
			console.log("error");
		});
		
	});

	$('.add-size').click(function(){
		$("#addSize").modal();
	});

	$('.add-new-size').click(function()
	{
		if(
			$('[name=size-descrip]').val() &&
			$('[name=size-abrev]').val() &&
			$('[name=size-price]').val() &&
			$('[name=size-top_price]').val() &&
			$('[name=size-top_price2]').val() &&
			$('[name=size-area]').val()
		)
		{
			$.ajax({
				url:'/kitchen/items',
				type: 'POST',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data:
				{
					id_item:$("#id_item").attr('id-item'),
					new_size:true,
					descrip:$('[name=size-descrip]').val(),
					abrev:$('[name=size-abrev]').val(),
					price:$('[name=size-price]').val(),
					top_price:$('[name=size-top_price]').val(),
					top_price2:$('[name=size-top_price2]').val(),
					area:$('[name=size-area]').val(),
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
					$('[name=size-descrip]').val("");
					$('[name=size-abrev]').val("");
					$('[name=size-price]').val("");
					$('[name=size-top_price]').val("");
					$('[name=size-top_price2]').val("");
					$('[name=size-area]').val("");
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

	});
	
</script>
@stop