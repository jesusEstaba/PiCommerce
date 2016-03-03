@extends('admin.layout')

@section('title', 'Orders')

@section('content')
<h2>Orders</h2>
<div>
	<form action="{{url('admin/orders')}}" method="get">
		<div class="input-group">
	      <input type="text" class="form-control" placeholder="Order number" name="num" autocomplete="off">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
	      </span>
	    </div>
	</form>
</div>

@if( count($orders) )
	<table class="table">
		<thead>
			<tr>
				<td>
					<b>Order</b>
				</td>
				<td>
					<b>Customer</b>
				</td>
				<td>
					<b>Total</b>
				</td>
				<td>
					<b>Date Purchased</b>
				</td>
				<td>
					<b>More</b>
				</td>
			</tr>
		</thead>
		<tbody>
			@foreach($orders as $key => $order)
				<tr>
					<td>
						{{$order->Hd_Ticket}}
					</td>
					<td>
						{{$order->first_name." ".$order->last_name}}
					</td>
					<td>
						{{$order->Hd_Total}}
					</td>
					<td>
						{{$order->Hd_Date}}
					</td>
					<td>
						<a href="{{url('admin/orders/'.$order->Hd_Ticket)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>


	@if(isset($num))
		{!!$orders->appends(['num' => $num])->render()!!}
	@else
		{!!$orders->render()!!}
	@endif
@else
	<h2>No Results</h2>
@endif

@stop