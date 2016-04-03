@extends('sections.main')

@section('title', 'Category')
@section('content')

@if($banner)
<style type="text/css">
	.image-category{
		background:url("{{asset('images/banners/'.$banner)}}") center center fixed no-repeat;
		background-size:cover; 
	}
	h2.title{
		padding-top: 1.2em;
	}
</style>
@endif


	<section class="image-category">
		<div class="container">
			<h2 class="title">{{$name_category}}</h2>
		</div>
	</section>
	
	<section class="name-category">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="hidden-xs">
						@if($categorys)
							@foreach($categorys as $category => $val)
								<a href="{{url('category/'.$val->name_cat)}}"><li>{{$val->name}}</li></a>
							@endforeach
						@else
							<li><a href="{{url('choose')}}">No Categories</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
	</section>

	<div class="container">
		<div class="row elements">
			@if($items)
				@foreach($items as $item => $valor)
					<div class="col-md-6">
					@if( isset($valor->Sz_Id) )
						<a href="{{url('product/'.$name_cat_url.'/'.$valor->Sz_Id.'/sub')}}">
					@else
						<a href="{{url('product/'.$name_cat_url.'/'.$valor->Sz_item)}}">
					@endif
							<div class="type">
								<div class="row">
									<div class="col-md-5 col-sm-6 col-xs-12">
										
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
									<div class="col-md-7 col-sm-6 col-xs-12">
										<h3 class="title-type">
											@if($sub)
												{{$valor->Sz_Descrip}}
											@else
												{{$valor->It_Descrip}}
											@endif
										</h3>
										<p>
											@if( !empty($valor->description) )
												{{$valor->description}}
											@endif
											
										</p>
										
									</div>
									<div class="col-xs-12">
										<span href="{{url('product/'.$name_cat_url.'/'.$valor->Sz_item)}}" class="btn btn-success price-abs">
										${{$valor->Sz_Price}}
										</span>
									</div>
								</div>
							</div>
						</a>
					</div>
				@endforeach
			@else
				<h3>no result for {{$name_cat_url}}.</h3>
			@endif
			

		</div>
	</div>
	<style type="text/css">
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
	}

	</style>
@stop