@extends('admin.layout')

@section('title', 'Category')


@section('content')

@if($category)
		<p><b>name: </b>{{$category->name}}</p>
		<p><b>name_cat: </b>{{$category->name_cat}}</p>
		<p><b>image_cat: </b>{{$category->image_cat}}</p>
		<p><b>group_id: </b>{{$category->group_id}}</p>
		<p><b>submenu_cat: </b>{{$category->submenu_cat}}</p>
		<p><b>Status: </b>{{$category->Status}}</p>
		<p><b>builder_id: </b>{{$category->builder_id}}</p>
		<p><b>banner: </b>{{$category->banner}}</p>
		<p><b>image: </b>{{$category->image}}</p>
		<p><b>tp_kind: </b>{{$category->tp_kind}}</p>
	@else
		<h2>Category Not Found</h2>
	@endif

@stop