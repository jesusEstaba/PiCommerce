@extends('admin.layout')

@section('title', 'Item')

@section('content')


	@if($item)
		<h2>
			<span class="title-item">{{$item->It_Descrip}}</span>
			<span class="glyphicon edit-item glyphicon-pencil btn btn-default"></span>
			
			@if(!$item->It_Status)
				<span class="glyphicon visible-sta item-status glyphicon-eye-open btn btn-info"></span>
			@else
				<span class="glyphicon visible-sta item-status glyphicon-eye-close btn btn-danger"></span>
			@endif
		</h2>
		<p>
			<b class="cat_item">{{$item->Gr_Descrip}}</b>
		</p>
		@if($item->description)
			<p class="code">{{$item->description}}</p>
		@else
			<p class="code text-center"><b>No Description.</b></p>
		@endif
		<h3>Sizes <span class="glyphicon glyphicon-plus btn btn-success"></h3>
		<table class="table">
			<tr>
				<td>
					<b>Edit</b>
				</td>
				<td>
					<b>Description</b>
				</td>
				<td>
					<b>Price</b>
				</td>
				<td>
					<b>Topping Price</b>
				</td>
				<td>
					<b>Status</b>
				</td>
			</tr>
		
			@foreach($sizes as $key => $size)
				<tr size="{{$size->Sz_Id}}">
					<td><span id-size="{{$size->Sz_Id}}" class="glyphicon edit-size glyphicon-pencil btn btn-default"></span></td>
					<td class="abrev">
						{{$size->Sz_Abrev}}
					</td>
					<td class="price">
						$<span>{{$size->Sz_Price}}</span>
					</td>
					<td class="topprice">
						$<span>{{$size->Sz_Topprice}}</span>
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
		</table>
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

      	<div class="input-group">
	      <input type="text" class="form-control" name="name" placeholder="Description Name" autocomplete="off">
	    </div>
	    <div class="input-group">
	      <input type="text" class="form-control" name="price" placeholder="Price" autocomplete="off">
	    </div>
	    <div class="input-group">
	      <input type="text" class="form-control" name="top_price" placeholder="Topping Price" autocomplete="off">
	    </div>       
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Item</h4>
      </div>
      <div class="modal-body">

      	<div class="input-group">
	      <input type="text" class="form-control" name="item_name" placeholder="Name" autocomplete="off">
	    </div>
		<div class="input-group">
			<textarea class="form-control" name="item_descrip" placeholder="Description"></textarea>
	    </div>

	    <div class="input-group">
			<select class="form-control" name="category">
				    	<option value="">Groups</option>
				    	@foreach($groups as $array => $group)
				    		<option value="{{$group->Gr_ID}}">{{$group->Gr_Descrip}}</option>
				    	@endforeach
				    </select>
	    </div>
	    
        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save-item" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
	$('.edit-size').click(function(){
		$('.save').attr('id-size', $(this).attr('id-size'));
		$('#myModal').modal();
	});


	$('.edit-item').click(function(){
		$('#ModalEdit').modal();
	});

	$('.save').click(function(){
		
		
		var id = $(this).attr('id-size');

		var abrev = $("[size="+id+"]").children('.abrev');
		var price = $("[size="+id+"]").children('td.price').children();


		var topprice = $("[size="+id+"]").children('td.topprice').children();

		$.ajax({
			url: '{{$item->It_Id}}',
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data:
			{
				id: id,
				descrip:$('[name=name]').val(), 
				price: $('[name=price]').val(), 
				top_price: $('[name=top_price]').val()
			},
		})
		.done(function(data) {
			console.log(data.state);

			if( $('[name=name]').val() )
				abrev.html($('[name=name]').val());
			if( $('[name=price]').val() )
				price.html( $('[name=price]').val() );
			if( $('[name=top_price]').val() )
				topprice.html( $('[name=top_price]').val() );

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

	$('.status').click(function(){
		var status = 0;

		if( $(this).hasClass('glyphicon-eye-close') )
			status = 1

		$.ajax({
			url: '{{$item->It_Id}}',
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
			url: '{{$item->It_Id}}',
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {item_visible: "visible", status:status},
		})
		.done(function(data) {

		})
		.fail(function() {
			console.log("error");
		});
		
	});


	$('.save-item').click(function(){
	

		$.ajax({
			url: '{{$item->It_Id}}',
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data:
			{
				edit_item: true,
				name:$("[name=item_name]").val(), 
				descrip:$("[name=item_descrip]").val(), 
				category:$("[name=category]").val()
			},
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
		})
		.fail(function() {
			console.log("error");
		});
		
	});

	
</script>
@stop