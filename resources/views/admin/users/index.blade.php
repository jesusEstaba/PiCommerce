@extends('admin.layout')

@section('title', 'Users')


@section('content')


<div class="box">
	<div class="box-header">
		<h2>Users</h2>
	</div>
	<div class="box-body">
		@if(count($users))
		
		<div class="row">
			<div class="col-xs-4 pull-right">
				<form action="{{url('kitchen/users')}}" method="get" class="pull-right">
					
					<div class="input-group ">
						<input type="text" class="form-control" placeholder="Search by name" name="search" autocomplete="off">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						</span>
					</div>
				
				</form>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Email
							</th>
							<th>
								Name
							</th>
							<th>
								Phone
							</th>
							<th>
								Zip Code
							</th>
							<th>
								More
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>
								{{$user->email}}
							</td>
							<td>
								{{$user->Cs_Name}}
							</td>
							<td>
								{{$user->phone}}
							</td>
							<td>{{$user->Cs_ZipCode}}
							</td>
							<td>
								<a href="{{url('kitchen/users/'.$user->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
								
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
					Showing {{$users->currentPage()}} to {{$users->lastPage()}} of {{$users->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					@if(isset($search))
					{!!$users->appends(['search' => $search])->render()!!}
					@else
					{!!$users->render()!!}
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
		$('#users').addClass('active');
	});
</script>
@stop