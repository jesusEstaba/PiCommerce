@extends('admin.layout')

@section('title', 'User')


@section('content')
<a title="Back to Users" href="{{url('admin/users')}}"><spam class="backtoback btn btn-default btn-sm glyphicon glyphicon-chevron-left"></spam></a>

<div class="box">
	<div class="box-body">
		@if($user)
		<h3><b>Name: </b>{!!$user->Cs_Name or '<em>No Name</em>'!!}</h3>
		
		<p><b>Email: </b>{{$user->email}}</p>
		<p><b>Phone: </b>{{$user->phone}}</p>
		<p><b>Created: </b>{{$user->created_at}}</p>
		<p><b>Ip Address: </b>{!!$user->dir_ip or '<em>No Ip</em>'!!}</p>
		
		<p><b>Street Number: </b>{!!$user->Cs_Number or '<em>No Street Number</em>'!!}</p>
		<p><b>Street Name: </b>{!!$user->Cs_Street or '<em>No Street Name</em>'!!}</p>
		<p><b>Zip Code: </b>{!!$user->Cs_ZipCode or '<em>No Zip Code</em>'!!}</p>
		
		@else
			<h2 class="text-center text-muted">User Not Found</h2>
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