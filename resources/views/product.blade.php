@extends('sections.main')

@section('title', 'Build')
@section('content')

<div class="container space bottom-space">
	<div class="row">

	@if($item)
		<div class="col-md-8">
			<div class="head-product">
				<div class="row">
					<div class="col-md-6">
						<img src="{{asset('images/category/healthy-honey-vegetable-pizza-561561.jpg')}}" class="img-build">
					</div>
					<div class="col-md-6">
						<div class="row">
							<h2>{{$name}}</h2>
							<p>Pepperoni, Sausage, Onions, Green Peppers, Mushrooms, Black Olives</p>
						</div>
						<div class="row">
							<div class="sizes">
								@if($size)
									@foreach($size as $table => $val)
										<a class="btn btn-default size" id-size="{{$val->Sz_Id}}" price="{{$val->Sz_Price}}" top-price="{{$val->Sz_Topprice}}">{{$val->Sz_Abrev}}</a>
									@endforeach
								@else
									<p>No Hay Tamaños</p>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">	
				
				<div class="toppings">
					<div class="row">
						<div class="col-md-4">
							<h2>Add Toping</h2>
						</div>
						<div class="col-md-8">
							<div class="btn-sizes">
								<div class="btn-complete-size topping-size" size-top="1" title="Complete"></div>
								<div class="btn-semi-left-size topping-size" size-top="2" title="Left Half"></div>
								<div class="btn-semi-right-size topping-size" size-top="3" title="Right Half"></div>
								<div class="btn-double-size topping-size" size-top="4" title="Double"></div>
								<div class="btn-lite-size topping-size" size-top="5" title="Lite"></div>
							</div>
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-md-12 col-sm-6">
							@if($toppings)
								@foreach($toppings as $data => $table)
									<div class="box-drag">
										<a id-top="{{$table->Tp_Id}}" class="btn drag">{{strtolower($table->TP_Descrip)}}</a>
									</div>
									
								@endforeach
							@else
								<h2>No Toppings for now</h2>
							@endif
						</div>
						<div class="col-xs-12">
							<div class="input-control">
								<textarea name="cooking_instructions" placeholder="cooking instructions" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>


		<div class="col-md-4 bottom-space">
			<div class="counter-price" id="droppable">
				<h3 class="pizza_size" id-size="0"  price="0">Pizza Size</h3>
				<ul topprice='0' class="items-toppings">
					<li class="def-top">Pepperoni</li>
					<li class="def-top">Double Cheese</li>
					<li class="def-top">Onios</li>
					<li class="def-top">Corn</li>
				</ul>

				<h2 class="text-success price-all"><span class="total-price">14.99</span>$</h2>
{{-- 				href="{{url('cart')}}"  --}}
				<a class="btn btn-success go-checkout-cart">Add to Car</a>
			</div>	
		</div>
@else
	<div class="row">
		<h3>This item no exist</h3>
	</div>
@endif
	</div>
	
</div>

<form action="{{url('/add_to_cart')}}" method="post" class="add-to-cart hide">
	{{-- <input type="hidden" name="" value="" /> --}}
	<input type="submit" class="send-to-cart" />
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
</form>

	<script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.min.css')}}">

<style type="text/css">
	.drag{
		border-radius: 3px;
		z-index: 6;
		background: #eee;
		padding: .5em;
		transition:.8s background;
	}
	.drag:hover{
		background: #ccc;
	}
	.drag:active{
		border:dashed #333 1px;
		padding: .5em;
	}

	.btn.drag{
		margin-bottom: .5em;
	}

	.bottom-space{
		margin-bottom: 2em;
	}
	.form-control{
		max-width: 100%;
	}

	.counter-price{
		padding: 1em;
	}
	.go-checkout-cart{
		display: block;
	}
	.img-build{
		box-shadow: 0 0 2px rgba(0,0,0, .26);
		border-radius: 3px;
		margin-left: auto;
		margin-right: auto;
		display: block;
	}
	.size-pizza{
		width: auto;
    	margin: auto;
	}

	.toppings{
		padding: 1em;
	}
	.head-product{
		padding-top: 1em;
		padding-bottom: 1em;
	}

	.helper-pizza{
		background: #5cb85c;
		padding: .5em;
		border-radius: 3px;
		color:white;
		transform:skewY(3.2rad);
		box-shadow: 0 0 5px rgba(0,0,0,.3);
	}
	.btn-complete-size{
		width: 80px;
		height: 80px;
		border-radius: 50%;
		border:1px #333 solid;
	}
	.btn-semi-left-size{
		width: 40px;
		height: 80px;
		border-radius: 40px 0 0 40px;
		border:1px #333 solid;
	}
	.btn-semi-right-size{
		width: 40px;
		height: 80px;
		border-radius: 0 40px 40px 0;
		border:1px #333 solid;
	}
	.btn-double-size{
		width: 80px;
		height: 80px;
		border:3px #333 solid;
		border-radius:50%;
	}
	.btn-lite-size{
		width: 80px;
		height: 80px;
		border:1px #333 dashed;
		border-radius:50%;
	}
	.btn-sizes div{
		display: inline-block;
		transition: .6s background, .6s border-color;
	}
	.btn-sizes div:hover{
		background: #eee;
		border-color: gray;
	}
	.btn-sizes div.active{
		background: #FDF4A7;
		border-color: #F58F19;
	}
	.box-drag{
		/*background: orange;*/
		display: inline-block;
	}
	.box-drag .glyphicon-plus{
		padding: .3em;
		border-radius: 50%;
		/*border:solid white 1px;*/
		color:white;
		background: green;
	}
</style>

<script type="text/javascript">
function addToCart()
{
	var selected=[];
	var topings_selected = [];
	$(".add-topping").each(function(index){
		selected.push( parseInt( $(this).not(".def-top").attr('id-top') ) );
		topings_selected.push( $(this).not(".def-top").attr('size-top') );
	});
	
	var input = $("<input>").attr({"type":"hidden","name":"selected"}).val(selected);

	var toping_size = $("<input>").attr({"type":"hidden","name":"sizes"}).val(topings_selected);

	var id_size = $("<input>").attr({"type":"hidden","name":"id_size"}).val( $(".pizza_size").attr('id-size') );
	
	$('.add-to-cart')
		.append(input)
		.append(toping_size)
		.append(id_size)
		.append($("[name=cooking_instructions]").clone());
}

function add_toping_to_list(object, parent)
{
	$(".add-topping").each(function(index){
		//acá es por donde se puede eliminar el caso de que existan dos toppings iguales,
		//pero con diferente proporcion
		
		if($(this).text()==object.text()+" "+size_topping)
		{
			$(this).fadeOut(500, function(){
				$(this).remove();
			});
		}
	});

	$( "<li class='add-topping'></li>" )
		.text(object.text()+" "+size_topping )
		.attr('id-top',object.attr('id-top'))
		.attr('size-top', num_size_top)
		.appendTo( parent );
    
    calcular_cuenta();
}

function calcular_cuenta()
{
	var cuenta = 0;
	var topping_price = parseFloat( $('.items-toppings').attr('topprice') );
	var pizza_price = parseFloat( $(".pizza_size").attr('price') );

	$(".add-topping").not(".def-top").each(function(index, val)
	{
		if($(this).attr('size-top')=="1")
			cuenta += topping_price;
		else if($(this).attr('size-top')=="2")
			cuenta += topping_price * 1/2;
		else if($(this).attr('size-top')=="3")
			cuenta += topping_price * 1/2;
		else if($(this).attr('size-top')=="4")
			cuenta += topping_price * 2;
		else if($(this).attr('size-top')=="5")
			cuenta += topping_price;
	});
	cuenta_total = pizza_price + cuenta;
	$('.total-price').html(cuenta_total.toFixed(2));
}

var cuenta_total = 0;
var size_topping = '';
var num_size_top = 1;

$(function()
{
	/*
	$('.add-topping').hover(function() {
		$(this).append('<span class="glyphicon glyphicon-minus"></span>');
	}, function() {
	});
	*/


	$('.box-drag')
		.hover(function(){
			$(this).prepend('<span class="glyphicon glyphicon-plus"></span>');
		},
		function(){
			$(this).children('.glyphicon-plus').remove();
		})
		.on('click', '.glyphicon-plus', function(){
			add_toping_to_list($(this).siblings(), $( "#droppable ul" ));
			$(this).remove();
		});
	
	$('.drag').dblclick(function() {
		add_toping_to_list($(this), $( "#droppable ul" ));
	});

	$('.go-checkout-cart').click(function(){
		addToCart();
		$('.send-to-cart').click();
	});

	$('.topping-size').click(function() {
		$('.topping-size').removeClass('active');
		$(this).addClass('active');

		//size_topping
		if($(this).attr('size-top')=="1")
			size_topping = "";
		else if($(this).attr('size-top')=="2")
			size_topping = "[left]";
		else if($(this).attr('size-top')=="3")
			size_topping = "[rigth]";
		else if($(this).attr('size-top')=="4")
			size_topping = "[double]";
		else if($(this).attr('size-top')=="5")
			size_topping = "[lite]";

		num_size_top = parseInt( $(this).attr('size-top') );
	});

	$(".pizza_size")
		.html( $(".sizes a:first-child").html() )
		.attr('price', $(".sizes a:first-child").attr('price'))
		.attr('id-size', $(".sizes a:first-child").attr('id-size'));
	
	$('.total-price').html( $(".sizes a:first-child").attr('price') );

	$('.items-toppings').attr('topprice', $(".sizes a:first-child").attr('top-price'));
	

	$('.size').click(function()
	{
		$('.pizza_size').html( $(this).html() );
		var topping_price = $(this).attr("top-price");
		$('.items-toppings').attr('topprice',topping_price);
		var total_topping_price = $(".items-toppings").children().not(".def-top").length * topping_price;
		$('.total-price').html( ( parseFloat( $(this).attr('price') )+ total_topping_price ).toFixed(2) );
		$(".pizza_size")
			.attr('price', $(this).attr('price'))
			.attr('id-size', $(this).attr('id-size'));
	});

    $( ".drag" ).draggable
    ({
    	appendTo: "body",
    	helper: "clone",
    	drag:function(event, ui)
    	{
    		ui.helper.addClass('helper-pizza');
		}
    });
    
    $( "#droppable ul" )
	    .droppable
	    ({
	    	activeClass: "ui-state-default",
	    	hoverClass: "ui-state-hover",
	    	accept: ":not(.ui-sortable-helper)",
	    	drop: function( event, ui )
	    	{
	        	$( this ).find( ".placeholder" ).remove();
	        	
	        	add_toping_to_list(ui.draggable, this);
	    	}
	    })
	    .sortable
	    ({
	    	items: "li:not(.placeholder)",
	    	sort: function()
	    	{
	        	$( this ).removeClass( "ui-state-default" );
	    	},
			out: function (event, ui)
			{
		        if(ui.helper)
			        ui.helper.fadeOut(1000, function () {
			            $(this).remove();
			            calcular_cuenta();
			        });
	    	}
	    });
  });
</script>

@stop