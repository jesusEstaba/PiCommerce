@extends('sections.main')

@section('title', 'Category')
@section('content')

@if($banner)
<style type="text/css">
	.image-category{
		background:url("{{asset('images/banners/'.$banner)}}") center center fixed no-repeat;
		background-size:cover; 
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
			<ul>
				@if($categorys)
					@foreach($categorys as $category => $val)
						<a href="{{url('category/'.$val->name_cat)}}"><li>{{$val->name}}</li></a>
					@endforeach
				@else
					<li><a href="{{url('choose')}}">No Categories</a></li>
				@endif
			</ul>
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
									<div class="col-md-5 col-xs-6">
										<img src="{{asset('images/items/nopicture.jpg')}}" class="item" alt="item-type">
									</div>
									<div class="col-md-7 col-xs-6">
										<h3>
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
										<span href="{{url('product/'.$name_cat_url.'/'.$valor->Sz_item)}}" class="btn btn-success">
										{{$valor->Sz_Price}}$
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
	</style>
@stop