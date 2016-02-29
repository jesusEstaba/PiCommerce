@extends('admin.layout')

@section('title', 'Categories')


@section('content')

	<h2>Categories <span class="glyphicon glyphicon-plus btn btn-success"></span></h2>
	
	@if( count($categories) )
		<table class="table">
			<tr class="white">
				<td>
					<b>Name</b>	
				</td>
				<td>
					<b>Url</b>	
				</td>
				<td>
					<b>Gruop</b>
				</td>
				<td>
					<b>status</b>
				</td>
				<td>
					<b>More</b>
				</td>
			</tr>
			@foreach($categories as $category)
				<tr>
					<td>
						{{$category->name}}
					</td>
					<td>
						{{$category->name_cat}}
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
		</table>
		@if(isset($search))
			{!!$categories->appends(['search' => $search])->render()!!}
		@else
			{!!$categories->render()!!}
		@endif
	@else
		<h2>No Results</h2>
	@endif

{!!Form::token()!!}

@stop



@section('script')
<script type="text/javascript">

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
			data: {change_visible: $(this).attr('id-size'), status:status},
		})
		.done(function(data) {
		})
		.fail(function() {
			console.log("error");
		});
		
	});

</script>
@stop