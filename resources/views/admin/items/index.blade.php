@extends('admin.layout')

@section('title', 'Items')
@section('section', 'Items')

@section('content')
<div>
	<form action="{{url('admin/items')}}" method="get">
		<div class="input-group">
	      <input type="text" class="form-control" placeholder="Search for Items" name="search" autocomplete="off">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
	      </span>
	    </div>
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
				<b>Edit</b>
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
					<a href="{{url('admin/items/'.$item->It_Id)}}" class="btn btn-default">Edit</a>
				</td>
			</tr>
		@endforeach
	</table>
	@if(isset($search))
		{!!$items->appends(['search' => $search])->render()!!}
	@else
		{!!$items->render()!!}
	@endif
@else
<h2>No Results</h2>
@endif

@stop