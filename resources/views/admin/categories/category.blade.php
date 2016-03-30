@extends('admin.layout')

@section('title', 'Category')


@section('content')


<a title="Back" href="{{url('admin/categories')}}"><spam class="backtoback btn btn-default btn-sm glyphicon glyphicon-chevron-left"></spam></a>


@if($category)
<div class="box">

<div class="box-body">
		<h2>
			<span data-id-cat="{{$category->id}}" data-submenu="{{$submenu_cat}}" class="title-cat">{{$category->name}}</span>
			<span class="glyphicon edit-item glyphicon-pencil btn btn-default"></span>
		</h2>
		<p><b>Url: </b> <a target="_blank" href="{{url('category/'.$category->name_cat)}}">{{$category->name_cat}}</a></p>
		<p><b>Group: </b><span class="cat_group">{{$category->Gr_Descrip}}</span></p>
		<p>
			<b>Sub Menu: </b>
			@if($category->submenu_cat)
				Yes
			@else
				No
			@endif
		</p>
		<p><b>Builder: </b>{{$category->builder_id}}</p>

		<p><b>Image: </b><a target="_blank" href="{{url('images/category/'.$category->image)}}">{{$category->image}}</a></p>
		<p><b>Banner: </b><a target="_blank" href="{{url('images/banners/'.$category->image_cat)}}">{{$category->image_cat}}</a></p>
		<p><b>Tp Kind: </b>{{$category->tp_kind}}</p>
	
</div>
</div>
<br>
	
	<div class="box">

<style type="text/css">

#sortable{
	padding: 1em !important;
}
	
#sortable>li{
	list-style: none;
	font-size: 1.5em;
	margin-top: .3em;
	margin-bottom: .3em;
	border:1px #b2b2b2 solid;
	border-radius: 3px;
	background: white;
	padding: .5em;
	cursor: pointer;
}
</style>
		<div class="box-header">
			<h3>Special Order</h3>
		</div>
		<div class="box-body">
			<ul id="sortable">

				@foreach($products as $array => $producto)
				  <li data-id="{{$producto->It_Id or $producto->Sz_Id}}">
				  		<span class="fa fa-arrows-v"></span>
				  		{{$producto->It_Descrip or $producto->Sz_Descrip}}
				  </li>
				@endforeach

			</ul>
			<br>
			<a class="btn btn-primary save-all-special">Save</a>
		</div>
	</div>

	@else
	<div class="box">

<div class="box-body">
		<h2 class="text-center text-muted">Category Not Found</h2>
		</div></div>
	@endif



{!!Form::token()!!}



<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Category</h4>
      </div>
      <div class="modal-body">

<div class="form-group">
	<label>Name:</label>
	<input type="text" name="name_category" placeholder="Name Category" class="form-control" />
</div>


<div class="form-group">
	<label>Url:</label>
	<input type="text" name="url" placeholder="Url Category" class="form-control" />
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


<br>
	    <div class="form-group">
	    	<label>Builder Image:</label>
	    	<input class="form-control" id="image" name="image_upload" type="file" />
	    </div>

	    <div class="form-group">
	    	<label>Banner Image:</label>
	    	<input class="form-control" id="banner" name="image_upload" type="file" />
	    </div>

        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@stop


@section('script')
<script type="text/javascript">
$(function() {

$('.sidebar-menu li:eq(3)')
			.addClass('active');

		$('.sidebar-menu li:eq(4)')
			.addClass('active');


    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    $('.save-all-special').click(function(){
    	var order_items = [];

    	$( "#sortable li" ).each(function(index, el) {
    		
    		order_items.push( Number( $(this).attr('data-id') ) );
    		
    	});

    	var id = $(".title-cat").attr('data-id-cat');
    	var sub = Number( $(".title-cat").attr('data-submenu') );

    	$.ajax({
			url: id,
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {
				order_change:true,
				order_items:order_items,
				sub:sub
			},
		})
    	.done(function() {

    		document.location.reload(true);
    	});
    	
    });



  });
	

	$('.edit-item').click(function(){
		$('#myModal').modal();
	});
	
	$('.save').click(function(){

		var id = $(".title-cat").attr('data-id-cat');

		var inputFileImage = document.getElementById('image');
		var file_img = inputFileImage.files[0];
		
		var banner_ele = document.getElementById('banner');
		var file_banner = banner_ele.files[0];

		var data = new FormData();

		data.append('id', id);
		data.append('cambios', true);
		data.append('category', $("[name=category]").val());
		data.append('name_category', $("[name=name_category]").val());
		data.append('url', $("[name=url]").val());
		
		data.append('imagen', file_img);
		data.append('imagen_cat', file_banner);

		$.ajax({
			url: '/admin/categories',
			type: 'POST',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			/*	
			data:{
				img:file_img,
				url: $("[name=url]").val(),
				name_category: $("[name=name_category]").val(),
				category: $("[name=category]").val(),
				cambios: true,
			},*/
			data:data,

			contentType:false,
			processData:false,
			cache:false,
		})	
		.done(function(data) {

			if( $("[name=category]").val() )
				$('.cat_group').html($("[name=category] option:selected").text());

			
			$("[name=name_category]").val("");
			$("[name=url]").val("");



			$("[name=category]").val("");

			document.location.reload(true);
		})
		.fail(function() {
			console.log("error");
		});

	});

</script>
@stop