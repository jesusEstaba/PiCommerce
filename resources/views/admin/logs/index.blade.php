@extends('admin.layout')

@section('title', 'Logs')

@section('content')


<div class="box">
	<div class="box-header">
	<h3>Logs</h3>
	</div>
	<div class="box-body">
		@if( count($ip_log) )
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Mail User
							</th>
							<th>
								Ip
							</th>
							<th>
								ISP
							</th>
							<th>
								Action
							</th>
							<th>
								Date
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ip_log as $arr => $data)
							<tr>
								<td>
									@if($data->email)
										<a href="{{url('kitchen/logs/'.$data->id_user)}}">{{$data->email}}</a>
									@else
										Unknown
									@endif
									
								</td>
								<td>
									{{$data->ip}}
								</td>
								<td>
									{{$data->ISP}}
								</td>
								<td>
									@if($data->action==1)
										<p>Login User</p>
									@elseif($data->action==2)
										<p>Logout User</p>
									@elseif($data->action==3)
										<p>Login Admin</p>
									@elseif($data->action==4)
										<p>Logout Admin</p>
									@elseif($data->action==5)
										<p>Order User</p>
									@elseif($data->action==314)
										<p>Quick Order</p>
									@else
										<p>Unknown</p>
									@endif
								</td>
								<td>
									{{$data->created_at}}
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
					Showing {{$ip_log->currentPage()}} to {{$ip_log->lastPage()}} of {{$ip_log->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

					{!!$ip_log->render()!!}

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
	$('#logs').addClass('active');

})

</script>
@stop