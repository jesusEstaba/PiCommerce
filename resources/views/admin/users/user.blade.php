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

		<p><b>company: </b>{{$user->company}}</p>
		<p><b>street_name: </b>{{$user->street_name}}</p>
		<p><b>aparment: </b>{{$user->aparment}}</p>
		<p><b>aparment_complex: </b>{{$user->aparment_complex}}</p>
		<p><b>complex_name: </b>{{$user->complex_name}}</p>
		<p><b>zip_code: </b>{{$user->zip_code}}</p>
		<p><b>city: </b>{{$user->city}}</p>
		<p><b>state: </b>{{$user->state}}</p>
		<p><b>country: </b>{{$user->country}}</p>
		<p><b>special_directions: </b>{{$user->special_directions}}</p>

	@else
		<h2>User Not Found</h2>
	@endif
@stop