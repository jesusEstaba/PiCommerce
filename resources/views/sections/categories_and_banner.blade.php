
@if(isset($banner))
<style type="text/css">
	.image-category{
		background:url("{{asset('images/banners/'.$banner)}}") center center fixed no-repeat;
		background-size:cover;
	}
</style>
@endif

<section class="image-category">
		<div class="container">
			{{-- <h2 class="title">{{$name_category or ""}}</h2> --}}
		</div>
	</section>
<section class="name-category nav">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<ul class="hidden-xs">
						@if($categoryList = HelperMenu::categoryList())
							@foreach($categoryList as $array => $category)
								<a href="{{url('category/'.$category->url)}}"><li>{{$category->name}}</li></a>
							@endforeach
						@else
							<li><a href="{{url('menu')}}">No Categories</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
</section>