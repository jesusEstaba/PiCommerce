@extends('sections.main')

@section('title', 'Choose')
@section('content')
<div class="container space">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="row">
				
				@foreach($categories as $arra => $cat)
					<div class="col-xs-12 col-sm-6 col-md-4 category-choose">
						<a href="{{url('category/'.$cat->name_cat)}}">
							<div class="contenedor-image">
								<!-- class="text-choose" -->
								<h3>{{$cat->name}}</h3>
								<?php
									if(!$cat->image)
										$cat->image = "recipe-no-photo.jpg";
								?>
								<img src="{{asset('images/category/'.$cat->image)}}" alt="choose" class="img-responsive choose">
							</div>
						</a>
					</div>
				@endforeach
				
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	.contenedor-image{
		height: 200px;
		max-width: 300px;
		margin-left: auto;
		margin-right: auto;
		position: relative;
	}

	.contenedor-image h3{
		top:.5em;
		left: .5em;
		margin: 0;
		position: absolute;
		color: white;
		text-shadow: 1px 1px 2px rgba(0,0,0,.5);
	}
</style>
@stop