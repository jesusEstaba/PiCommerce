@extends('admin.layout')

@section('title', 'Category')


@section('content')



@if($category)
		<h2>
			<span data-id-cat="{{$category->id}}" data-submenu="{{$submenu_cat}}" class="title-cat">{{$category->name}}</span>
			<span class="glyphicon edit-item glyphicon-pencil btn btn-default"></span>
		</h2>
		<p><b>url: </b>{{$category->name_cat}}</p>
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
<!-- 		<p><b>banner: </b>{{$category->banner}}</p> -->
		<p><b>Image: </b>{{$category->image}}</p>
		<p><b>Banner: </b>{{$category->image_cat}}</p>
		<p><b>Tp Kind: </b>{{$category->tp_kind}}</p>
	
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
	
	<div class="box">
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
		<h2>Category Not Found</h2>
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
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


@stop


@section('script')
<script type="text/javascript">
$(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();

    $('.save-all-special').click(function(){
    	var order_items = [];

    	$( "#sortable li" ).each(function(index, el) {
    		
    		order_items.push( Number( $(this).attr('data-id') ) );
    		
    		//console.log( $(this).attr('data-id') + "=>" + $(this).text() )
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
    		console.log("success");
    	});
    	
    });



  });
	

	$('.edit-item').click(function(){
		$('#myModal').modal();
	});
	
	$('.save').click(function(){

		var id = $(".title-cat").attr('data-id-cat');

		$.ajax({
			url: id,
			type: 'PUT',
			dataType: 'json',
			headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
			data: {
				cambios:true,
				category:$("[name=category]").val()
			},
		})
		.done(function(data) {

			if( $("[name=category]").val() )
				$('.cat_group').html($("[name=category] option:selected").text());

			$("[name=category]").val("");
		})
		.fail(function() {
			console.log("error");
		});
		
	});

</script>
@stop