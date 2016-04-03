@extends('sections.main')

@section('title', 'Choose')
@section('content')




<section class="image-category"></section>
	
	<section class="name-category">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="hidden-xs">
						@if($categorys)
							@foreach($categorys as $category => $val)
								<a href="{{url('category/'.$val->name_cat)}}"><li>{{$val->name}}</li></a>
							@endforeach
						@endif
					</ul>
				</div>
			</div>
		</div>
	</section>






<div class="container">
	<div class="row">

<div class="col-md-10 col-md-offset-1">


@if($items)
<h3 class="tab">Features Products</h3>
<div class="well">
<div class="elements">
<div class="row">
@foreach($items as $item => $valor)
					<div class="col-md-3 col-sm-6 col-xs-12">
					@if( isset($valor->Sz_Id) )
						<a href="{{url('product/feature/'.$valor->Sz_Id.'/sub')}}">
					@else
						<a href="{{url('product/feature/'.$valor->Sz_item)}}">
					@endif
							<div class="type">
								<div class="row">
									<div class="col-xs-12">
										
										@if( isset($valor->It_ImagePre) )
											@if($valor->It_ImagePre)
												<img width="200" height="200" src="{{asset('images/items/'.$valor->It_ImagePre)}}" class="item" alt="item-type">
											@else
												<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
											@endif
											
										@else
											<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
										@endif
									</div>
									<div class="col-xs-12">
										<h3 class="title-type">
											@if( isset($sub) )
												{{$valor->Sz_Descrip}}
											@else
												{{$valor->It_Descrip}}
											@endif
										</h3>
										
									</div>
									<div class="col-xs-12">
										<span href="{{url('product/feature/'.$valor->Sz_item)}}" class="btn btn-success price-abs">
										${{$valor->Sz_Price}}
										</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
	</div>
@endif

</div>






@if($categories)
		<div class="col-md-10 col-md-offset-1">
		<h3 class="tab">Categories</h3>
			<div class="row">
				
				@foreach($categories as $arra => $cat)
					<div class="col-xs-12 col-sm-6 col-md-3 ">
						<div class="category-choose">
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
					</div>
				@endforeach
				
			</div>
		</div>
	@endif
	</div>
</div>

<style type="text/css">
	.tab{
		background: #008723;
		border-radius: 3px;
		box-shadow:0 2px 5px rgba(0,0,0,.3);
		color:white;
		padding-top: .3em;
		padding-bottom: .3em;
		text-align: center;
		text-shadow: 1px 2px 5px rgba(0,0,0,.2);
	}

	.contenedor-image{
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

/************************************/

		.type{
		text-decoration: none !important;
		color: #333;
	}
	
	.type{
		position: relative;
	}
	.type *{
		position:initial !important;
	}
	.price-abs{
		bottom: 10px;
    	right: 10px;
	    display: inline-block;
	    position: absolute !important;
	}
	.name-category{
		min-height: 2em;
	}
	
	.item{
		margin-left: auto;
	    margin-right: auto;
	    display: block;
	    max-width: 100%;
	}
	.title-type{
		text-align: center;
		margin-top: .3em;
		margin-bottom: .5em;
		height: 1.2em;

		white-space: nowrap;
	    overflow: hidden;
	    text-overflow: ellipsis;
	}
</style>
@stop