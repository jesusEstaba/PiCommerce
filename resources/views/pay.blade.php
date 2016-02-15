@extends('sections.main')

@section('title', 'Pay')
@section('content')

<div class="container space">
<h2>Pay Nigga</h2>
@foreach($cart_item as $tab => $val)
{{$val}}
@endforeach
</div>

@stop