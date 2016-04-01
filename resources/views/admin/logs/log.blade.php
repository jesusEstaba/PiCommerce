@extends('admin.layout')

@section('title', 'Log')

@section('content')

<a title="Back to Logs" href="{{url('kitchen/logs')}}"><spam class="backtoback btn btn-default btn-sm glyphicon glyphicon-chevron-left"></spam></a>

<div class="box">
	<div class="box-header">
		<h3>Log</h3>
	</div>
	<div class="box-body">
		<p>
			<b>User: </b> <a href="{{url('kitchen/users/'.$id)}}">{{$user->email}}</a>
		</p>

@if( count($logs) )

<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Ip
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
						@foreach($logs as $arr => $data)
							<tr>
								<td>
									{{$data->ip}}
								</td>
								<td>
									{{$data->action}}
								</td>
								<td>
									{{$data->created_at}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
<div class="row">
			<div class="col-sm-5">
				<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
					Showing {{$logs->currentPage()}} to {{$logs->lastPage()}} of {{$logs->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

					{!!$logs->render()!!}

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