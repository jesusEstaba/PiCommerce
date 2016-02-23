@extends('admin.layout')

@section('title', 'Item')
@section('section', 'Item')

@section('content')


	@if($item)
		<h2>{{$item->It_Descrip}} <h4></h4></h2>
		@if($item->description)
			<p class="code">{{$item->description}}</p>
		@else
			<p class="code text-center"><b>No Description.</b></p>
		@endif
		<h3>Sizes</h3>
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
				<tr>
					<td><span class="glyphicon glyphicon-pencil btn btn-default"></span></td>
					<td>
						{{$size->Sz_Descrip}}
					</td>
					<td>
						${{$size->Sz_Price}}
					</td>
					<td>
						${{$size->Sz_Topprice}}
					</td>
					<td>
						@if(!$item->It_Status)
							<span class="glyphicon status glyphicon-eye-open btn btn-success"></span>
						@else
							<span class="glyphicon status glyphicon-eye-close btn btn-danger"></span>
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	@else
		<h2>No Results</h2>
	@endif


<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<input class="text" placeholder="Description Name" class="form-control" />
        </div>
        
        <input class="text" placeholder="Price" class="form-control" />
        <input class="text" placeholder="Topping Price" class="form-control" />
      </div>
      <div class="modal-footer">
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
	$('.glyphicon-pencil').click(function(){
		$('#myModal').modal();
	});
	$('.status').click(function(){
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
</script>
@stop