@extends('admin.layout')

@section('title', 'User')


@section('content')
	@if($user)
		<p><b>Name: </b>{{$user->Cs_Name}}</p>
		<p><b>Email: </b>{{$user->email}}</p>
		<p><b>Phone: </b>{{$user->phone}}</p>
		<p><b>Created: </b>{{$user->created_at}}</p>
		<p><b>Street #: </b>{{$user->Cs_Number}}</p>
		<p><b>street_name: </b>{{$user->Cs_Street}}</p>
		<p><b>zip_code: </b>{{$user->Cs_ZipCode}}</p>

	@else
		<h2>User Not Found</h2>
	@endif
@stop