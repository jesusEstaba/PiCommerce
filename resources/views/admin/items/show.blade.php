@extends('admin.layout')

@section('title', 'Item')
@section('section', 'Item')

@section('content')


	@if($item)
		<h2>{{$item->It_Descrip}}</h2>
		<table class="table">
			<tr>
				<td>
					<b>Description</b>
				</td>
				<td>
					<b>Price</b>
				</td>
				<td>
					<b>Topping Price</b>
				</td>
			</tr>
		
			@foreach($sizes as $key => $size)
				<tr>
					<td>
						{{$size->Sz_Descrip}}
					</td>
					<td>
						{{$size->Sz_Price}}
					</td>
					<td>
						{{$size->Sz_Topprice}}
					</td>
				</tr>
			@endforeach
		</table>
	@else
		<h2>No Results</h2>
	@endif

@stop