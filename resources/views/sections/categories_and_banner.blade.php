
<?php
$categorys = DB::table('groups')
            ->where('Gr_Status', 0)
            ->get();
?>

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
						@if($categorys)
							@foreach($categorys as $category => $val)
								<a href="{{url('category/'.$val->Gr_Url)}}"><li>{{$val->Gr_Descrip}}</li></a>
							@endforeach
						@else
							<li><a href="{{url('choose')}}">No Categories</a></li>
						@endif
					</ul>
				</div>
			</div>
		</div>
</section>