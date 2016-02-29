@extends('admin.layout')

@section('title', 'Users')


@section('content')
<h2>Users</h2>
<div>
	<form action="{{url('admin/users')}}" method="get">
		<div class="input-group">
	      <input type="text" class="form-control" placeholder="Search by name" name="search" autocomplete="off">
	      <span class="input-group-btn">
	        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
	      </span>
	    </div>
	</form>
</div>
@if( count($users) )
	<table class="table">
		<tr class="white">
			<td>
				<b>First Name</b>	
			</td>
			<td>
				<b>Last Name</b>	
			</td>
			<td>
				<b>Email</b>
			</td>
			<td>
				<b>phone</b>
			</td>
			<td>
				<b>More</b>
			</td>
		</tr>
		@foreach($users as $user)
			<tr>
				<td>
					{{$user->first_name}}
				</td>
				<td>
					{{$user->last_name}}
				</td>
				<td>
					{{$user->email}}
				</td>
				<td>
					{{$user->phone}}
				</td>
				<td>
					<a href="{{url('admin/users/'.$user->id)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
					
				</td>
			</tr>
		@endforeach
	</table>
	@if(isset($search))
		{!!$users->appends(['search' => $search])->render()!!}
	@else
		{!!$users->render()!!}
	@endif
@else
	<h2>No Results</h2>
@endif

@stop