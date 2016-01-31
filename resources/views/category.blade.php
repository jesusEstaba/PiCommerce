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
							<div class="row type">
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
									<p>Grilled Chicken, Plum Tomatoes, Pesto Sauce, Onions, Cheese</p>
									<a href="{{url('product')}}" class="btn btn-success">2,99$</a>
								</div>
							</div>
						</div>
					
				@endforeach
			@else
				<h3>no result for {{$name_category}}.</h3>
			@endif
			

		</div>
	</div>
@stop