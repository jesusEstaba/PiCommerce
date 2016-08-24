@extends('sections.main')

@section('title', 'Menu')
@section('content')





@include('sections.categories_and_banner')



<div class="container">
<div class="row">

	<div class="col-md-12">


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






@if($combos)
<div class="col-md-6">
	<div class="combos">
		<h3 class="tab">Combos</h3>
		<div class="row">
			@foreach($combos as $arra => $combo)
			<div class="col-xs-12 col-md-6">
				<a href="{{url('product/combo/' . $combo->Cb_Id)}}">
					<div class="combo-item">
						<h4>
							{{$combo->Cb_Name}}	
						</h4>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</div>
@endif

@if($lunchs)
<div class="col-md-6">
	<div class="combos">
		<h3 class="tab">Lunch Special</h3>
		<div class="row">
			@foreach($lunchs as $arra => $lunch)
			<div class="col-xs-12 col-md-6">
				<a href="{{url('product/combo/' . $lunch->Cb_Id)}}">
					<div class="combo-item">
						<h4>
							{{$lunch->Cb_Name}}	
						</h4>
					</div>
				</a>
			</div>
			@endforeach
		</div>
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
	.combo-item{
		background: #fff;
		padding: .25em;
		margin-bottom: .25em;
		border-radius: 3px;
		transition: box-shadow .8s;
	}
	.combo-item:hover{
		box-shadow: 0 0 15px rgba(0,0,0,0.3);
	}
	.combos{
		margin-bottom: 1.5em;
	}
	.combos a{
		text-decoration: none;
	}
</style>
@stop