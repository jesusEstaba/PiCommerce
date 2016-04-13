

<section class="image-category">
		<div class="container">
			<h2 class="title">{{$name_category or ""}}</h2>
		</div>
	</section>
<section class="name-category nav">
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