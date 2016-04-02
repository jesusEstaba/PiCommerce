@extends('admin.layout')

@section('title', 'Coupon')

@section('content')

<a title="Back to Coupons" href="{{url('kitchen/coupons')}}"><spam class="backtoback btn btn-default btn-sm glyphicon glyphicon-chevron-left"></spam></a>


<div class="box">
	<div class="box-header">
		<h2>Coupon</h2>
	</div>


	<div class="box-body">

@if( $data )
	<p>
			<b>Code: </b>{{$data->code}}
		</p>
		<p>
			<b>Discount: </b>{{$data->discount}}%
		</p>
		<p>
			<b>Expiration Date: </b>{{$data->rot}}
		</p>
		<hr>


@if( count($cupon_log) )
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Order
							</th>
							<th>
								Used
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($cupon_log as $arr => $data)
							<tr>
								<td>
									<a href="{{url('kitchen/orders/'.$data->order_id)}}">{{$data->order_id}}</a>
								</td>
								<td>
									{{$data->used}}
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
					Showing {{$cupon_log->currentPage()}} to {{$cupon_log->lastPage()}} of {{$cupon_log->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					{!!$cupon_log->render()!!}
				</div>
			</div>
		</div>
		@else
		<h3 class="text-muted text-center">No Results</h3>
		<br>
		
		@endif
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
	$('#coupons').addClass('active');

})

</script>
@stop