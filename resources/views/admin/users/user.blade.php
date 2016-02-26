@extends('admin.layout')

@section('title', 'Users')


@section('content')
	@if($user)
		<p><b>First Name: </b>{{$user->first_name}}</p>
		<p><b>Last Name: </b>{{$user->last_name}}</p>
		<p><b>Email: </b>{{$user->email}}</p>
		<p><b>Phone: </b>{{$user->phone}}</p>
		<p><b>Created: </b>{{$user->created_at}}</p>
		<p><b>Street #: </b>{{$user->street_number}}</p>
	@else
		<h2>User Not Found</h2>
	@endif
@stop