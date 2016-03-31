@extends('admin.layout')

@section('title', 'Orders')

@section('content')

<div class="box">
	<div class="box-header">
		<h2>Orders</h2>
	</div>
	<div class="box-body">
		@if(count($orders))
		<div class="row">
			<div class="col-xs-12">
				<form action="{{url('kitchen/orders')}}" method="get">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Order number" name="num" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Order
							</th>
							<th>
								Customer
							</th>
							<th>
								Total
							</th>
							<th>
								Date Purchased
							</th>
							<th>
								Status
							</th>
							<th>
								More
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($orders as $key => $order)
						<tr>
							<td>
								{{$order->Hd_Ticket}}
							</td>
							<td>
								{{$order->Cs_Name}}
							</td>
							<td>
								${{round($order->Hd_Total, 2)}}
							</td>
							<td>
								{{$order->Hd_Date}}
							</td>
							<td>
								@if($order->Hd_Status==1)
									<span class="label label-success">Approved</span>
								@else
									<span class="label label-warning">Pending</span>
								@endif
							</td>
							<td>
								<a href="{{url('kitchen/orders/'.$order->Hd_Ticket)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5">
				<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
					Showing {{$orders->currentPage()}} to {{$orders->lastPage()}} of {{$orders->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					@if(isset($num))
					{!!$orders->appends(['num' => $num])->render()!!}
					@else
					{!!$orders->render()!!}
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
@stop


@section('script')
<script type="text/javascript">

	$(function()
	{
		$('#orders').addClass('active');
	});
</script>
@stop