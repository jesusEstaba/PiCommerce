@extends('sections.main')

@section('title', 'Build')
@section('content')

<div class="container space bottom-space">
	@if($item)
<div class="row">
	
	<div class="col-md-8 bottom-space">
		<div class="row">
				<div class="head-product">
					<div class="row">
						<div class="col-md-6">
							<img src="{{asset('images/category/'.$image_category)}}" class="img-build">
						</div>
						<div class="col-md-6">
							<div class="row">
								<h2>{{$name}}</h2>
								@if( !empty($description) )
								<p>{{$description}}</p>
								@endif
								
							</div>
							<div class="row">
								<div class="sizes">
									@if($size)
									@foreach($size as $table => $val)
									<a class="btn btn-default size" id-size="{{$val->Sz_Id}}" price="{{$val->Sz_Price}}" top-price="{{$val->Sz_Topprice}}">
										{{$val->Sz_Abrev}}
									</a>
									@endforeach
									@else
									<p>No Hay Tamaños</p>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
				
				@yield('head-data')

		</div>
	</div>
	
	<div class="col-md-4 bottom-space">
		<div class="counter-price" id="droppable">
			<h3 class="pizza_size" id-size="0" price="0"></h3>
			@yield('toppings')
			<div class="row">
				<div class="col-xs-12">
					<div class="input-control">
						<textarea name="cooking_instructions" placeholder="Additional notes" class="notes_instructions form-control"></textarea>
					</div>
				</div>
			</div>
			<h2 class="text-success price-all">$<span class="total-price"></span></h2>
			<a class="btn btn-success go-checkout-cart">Add to Cart</a>
		</div>
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

	<input type="submit" class="send-to-cart" />
	<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
</form>

	<script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}"></script>
	<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.min.css')}}">

<style type="text/css">
	.drag{
		background: #923030;
		color: white;
		box-shadow: 0 0 3px rgba(0,0,0,.15);
		border-radius: 3px;
		padding: .5em;
		transition:.8s background, .8s box-shadow;
		z-index: 6;
	}
	.drag:hover{
		color: white;
		background: #C53B3B;
		box-shadow: 0 0 10px rgba(0,0,0,.4);
	}
	.drag:active{
		border:dashed #eee 1px;
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
		border-radius: 3px;
		box-shadow: 0 0 2px rgba(0,0,0, .26);
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
	.size-pizza{
		width: auto;
    	margin: auto;
	}

	.toppings{
		padding: 1em;
		border-radius: 3px;
		box-shadow: 0 0 2px rgba(0,0,0,0.26);
	}
	.head-product{
		padding-bottom: 1em;
		padding-top: 1em;
	}

	.helper-pizza{
		background: #5cb85c;
		border-radius: 3px;
		box-shadow: 0 0 5px rgba(0,0,0,.3);
		color:white;
		padding: .5em;
		transform:skewY(3.2rad);
	}
	.btn-complete-size{
		border-radius: 50%;
		border:1px #333 solid;
		height: 80px;
		width: 80px;
	}
	.btn-complete-size span{
		left: 8px !important;
	}
	.btn-semi-left-size{
		border-radius: 40px 0 0 40px;
		border:1px #333 solid;
		height: 80px;
		width: 40px;
	}
	.btn-semi-left-size span{
		
	}
	.btn-semi-right-size{
		border-radius: 0 40px 40px 0;
		border:1px #333 solid;
		height: 80px;
		width: 40px;
	}
	.btn-double-size{
		border-radius:50%;
		border:3px #333 solid;
		height: 80px;
		width: 80px;
	}
	.btn-double-size span{
		left: 18px !important;
	}
	.btn-lite-size{
		border-radius:50%;
		border:1px #333 dashed;
		height: 80px;
		width: 80px;
	}
	.btn-lite-size span{
		left: 25px !important;
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

	.items-toppings{
		list-style: none;
		min-height: 50px;
	}
	.items-toppings li .glyphicon-minus{
		/*border:solid white 1px;*/
		background: red;
		border-radius: 50%;
		color: white;
		padding: .3em;
		font-size: .5em;
		margin-left: .8em;
		cursor: pointer;
	}
	.items-toppings li{
		font-size: 1.3em;
		cursor: default;
	}
	.topping-size{
		position: relative;
	}
	.topping-size .name-size-top{
		position: absolute;
		top: 85px;
		left: 10px;
	}
	.tab-content .tab-pane{
		padding: 1em;
	}
	.box-drag{
		display: inline-block;
		margin-left: .7em;
		margin-right: .7em;
		position: relative;
	}
	.box-drag .glyphicon-plus{
		position: absolute;
		background: green;
		border-radius: 50%;
		color:white;
		padding: .3em;
		left: 100%;
		top: 5px;
		z-index: 6;
		cursor:pointer;
	}
	.text-drag-drop-desc{
		text-align: center;
	}
</style>

<script type="text/javascript">
function cooking_instruction(){
	var acum = "";
	$(".checkbox input:checked").each(function(index, el)
	{
		if(acum.length)
			acum += ", "+$(this).parent().children("span").html();
		else
			acum = "\n\n[Cooking Instructions]\n"+$(this).parent().children("span").html();
	});

	return acum;
}

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
	
	
	var cooking_instrr = $("<input>").attr({"type":"hidden","name":"cooking_instructions"}).val( "[Notes]\n"+$(".notes_instructions").val()+menos_toppings+cooking_instruction());

	

	$('.add-to-cart')
		.append(input)
		.append(toping_size)
		.append(id_size)
		.append( cooking_instrr);
}

function add_toping_to_list(object, parent)
{
	//cambiar selector para que sean todos los elementos del ul, esto en caso de que el topping ya lo traiga
	//la pizza
	$(".add-topping").each(function(index, ele){
		//acá es por donde se puede eliminar el caso de que existan dos toppings iguales,
		//pero con diferente proporcion
		var add_top = $(this);

		var size_topping_name = ["", "[left]", "[rigth]", "[extra]", "[lite]"];
		
		size_topping_name.forEach(function(name){
			if(add_top.text()==object.text()+" "+name)
			{
				add_top.remove();
				calcular_cuenta();
			}
		});
		
	});

	$( "<li class='add-topping'></li>" )
		.text(object.text()+" "+size_topping )
		.attr('id-top',object.attr('id-top'))
		.attr('size-top', num_size_top)
		.appendTo( parent );

    
	hover_click_topping();
	calcular_cuenta();


}


function hover_click_topping()
{
	$('.items-toppings li').off();

    $('.items-toppings li').hover(function()
	{
		$(this).append('<span class="glyphicon glyphicon-minus"></span>');
	},
	function()
	{
		$(this).children('.glyphicon-minus').remove();
	});


	$('.items-toppings li ').on('click', '.glyphicon-minus', function(){	
		var parent = $(this).parent();

		if(parent.hasClass('def-top'))
		{
			if( parent.css('color')=='rgb(51, 51, 51)' )
			{
				if(menos_toppings.length)
					menos_toppings +=  ', ' + $(this).parent().text();
				else
					menos_toppings = "\n\n[deleted]\n" + $(this).parent().text();
			}
			

			parent.css({
				'color': 'red',
				'text-decoration':'line-through'
			});
			
		}
		else
			parent.remove();
		
		calcular_cuenta();
	});

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
var menos_toppings = "";

$(function()
{
	$('ul.nav.nav-tabs li:first-child a').click();
	hover_click_topping();

	$('.box-drag')
		.hover(function(){
			$(this).append('<span class="glyphicon glyphicon-plus"></span>');
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
			size_topping = "[extra]";
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
		$('.items-toppings').attr('topprice', $(this).attr("top-price"));
		
		$(".pizza_size")
			.attr('price', $(this).attr('price'))
			.attr('id-size', $(this).attr('id-size'))
			.html( $(this).html() );

		$('.size.active').removeClass('active');
		$(this).addClass('active');

		calcular_cuenta();
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
		        {
		        	ui.helper.fadeOut(1000, function () {
			            $(this).remove(function(){
			            	calcular_cuenta();
			            });
			        });
		        }
	    	}
	    });

	    $(".sizes a:first-child").click();
	    $('.btn-complete-size').click();
  });
</script>

@stop