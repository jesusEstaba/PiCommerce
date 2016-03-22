@extends('sections.main')

@section('title', 'Build')
@section('content')

<div class="container space bottom-space">
	@if($item)
<div class="row">
	
	<div class="col-md-8 bottom-space">

		<div class="head-product">
			
			<div class="row">
				<div class="col-md-6">
					<img src="{{asset('images/category/'.$image_category)}}" class="img-build">
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-xs-12">
							<h2>{{$name}}</h2>
							@if( !empty($description) )
							<p>{{$description}}</p>
							@endif
						</div>
						
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="sizes">
								@if($item===true)
									<a class="btn btn-default size" data-id-size="{{$size->Sz_Id}}" data-price="{{$size->Sz_Price}}" data-top-price="{{$size->Sz_Topprice}}" data-top-price-two="{{$size->Sz_Topprice2}}">
										{{$size->Sz_Abrev}}
									</a>
								@elseif($size)
									@foreach($size as $table => $val)
									<a class="btn btn-default size" data-id-size="{{$val->Sz_Id}}" data-price="{{$val->Sz_Price}}" data-top-price="{{$val->Sz_Topprice}}" data-top-price-two="{{$val->Sz_Topprice2}}">
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
		</div>
			

		@yield('head-data')
	</div>
	
	<div class="col-md-4 bottom-space">
		<div class="counter-price" id="droppable">
			<h3 class="pizza_size" data-id-size="0" data-price="0"></h3>
			@yield('toppings')
			<div class="row">
				<div class="col-xs-12">
					<h2 class="price-all">$<span class="total-price"></span></h2>
					<div class="input-control">
						<textarea name="cooking_instructions" placeholder="Additional notes" class="notes_instructions form-control"></textarea>
					</div>
				</div>
			</div>
			<div class="cantidad">
				<div class="box-cant">
					<p>Quantity</p>
					<span class="glyphicon glyphicon-minus btn btn-default"></span>
					<span class="quantity btn btn-default">1</span>
					<span class="glyphicon glyphicon-plus btn btn-default"></span>
				</div>
			</div>
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

	<script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.min.css')}}">

<style type="text/css">
	/*rojo #E26F6F*/
	/*verde #A1E26F*/
	.cantidad{
		margin-top: .5em;
		text-align: center;

	}
	.cantidad .btn{
		margin: 0 !important;
		
	}
	.cantidad .quantity{
		border-radius: 0;
		
		border:solid #b2b2b2 1px;
	}
	.cantidad .quantity:hover{
		background: white;
	}
	
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
	.delete-def-top{
		color: red;
		text-decoration:line-through;
	}
	.box-cant{
		margin-top: 1em;
		margin-bottom: 1em;
	}

	.topping_category{
		margin-bottom: 1.5em;
	}

	.topping_category h4{
		text-align: center;
		padding-top: .4em;
		padding-bottom: .4em;
		border-radius: 2px;
		color: white;
		text-shadow: 1px 1px 4px rgba(0,0,0,.4);
	}

	.topping_category .cheese{
		background: #FEB800;
	}
	.topping_category .cheese+.toppings-btns .btn.drag{
		background: #FFEC0D;
	}

	.topping_category .meats+.toppings-btns .btn.drag{
		background: #5D3C2E;
	}
	.topping_category .meats{
		background: #501313;
	}


	.topping_category .vegetables{
		background: #108C10;
	}
	.topping_category .vegetables+.toppings-btns .btn.drag{
		background: #0A995B;
	}
	.topping_category .dressingandsauces{
		background: #A79264;
	}
	.topping_category .dressingandsauces+.toppings-btns .btn.drag{
		background: #D8B76D;
	}
	.price-all{
		color: #3C763D;
		margin: 0;
		padding: 0;
		margin-bottom: .5em;
	}
	.descript_top{
		font-weight: bolder;
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
		selected.push( parseInt( $(this).not(".def-top").attr('data-id-top') ) );
		topings_selected.push( $(this).not(".def-top").attr('data-size-top') );
	});
	
	var input = $("<input>").attr({"type":"hidden","name":"selected"}).val(selected);

	var toping_size = $("<input>").attr({"type":"hidden","name":"sizes"}).val(topings_selected);

	var id_size = $("<input>").attr({"type":"hidden","name":"id_size"}).val( $(".pizza_size").attr('data-id-size') );
	
	var quantity = $("<input>").attr({"type":"hidden","name":"quantity"}).val( parseInt( $('.cantidad .quantity').html() ) );
	
	var instrucciones = $(".notes_instructions").val();

	if(instrucciones.length)
	{
		instrucciones = "[Notes]\n"+instrucciones;
	}
	
	var menos_toppings = "";

$('ul .def-top.delete-def-top').each(function(index, el)
{
	if(menos_toppings.length)
		menos_toppings +=  ', ' + $(this).text();
	else
		menos_toppings = "\n\n[deleted]\n" + $(this).text();
});
	var cooking_instrr = $("<input>").attr({"type":"hidden","name":"cooking_instructions"}).val(instrucciones+menos_toppings+cooking_instruction());
	

	$('.add-to-cart')
		.append(quantity)
		.append(input)
		.append(toping_size)
		.append(id_size)
		.append( cooking_instrr);
}

function add_toping_to_list(object, parent)
{
	var texto_comp = object.text().trim();

	$(".descript_top").each(function(index, ele)
	{
		var add_top = $(this);

		var size_topping_name = ["", "[left]", "[rigth]", "[extra]", "[lite]"];

		size_topping_name.forEach(function(name)
		{
			if(add_top.text()==texto_comp+" "+name)
			{
				add_top.parent().remove();
				calcular_cuenta();
			}
		});
		
	});

	var price_top_new = calc_top_price_ind(
		object.attr('data-price'), 
		object.attr('data-double'),
		num_size_top,
		parseFloat($('.items-toppings').attr('data-topprice')),
		parseFloat($('.items-toppings').attr('data-topprice-two'))

	);

	$( "<li class='add-topping'></li>" )
		.append('<span class="descript_top">'+texto_comp+" "+size_topping+'</span>')
		.attr('data-id-top',object.attr('data-id-top'))
		.attr('data-size-top', num_size_top)
		.attr('data-t-double', object.attr('data-double'))
		.attr('data-t-price', object.attr('data-price'))
		.append('<span class="topp_ind">$'+price_top_new.toFixed(2)+'</span>')
		.appendTo( parent );

	hover_click_topping();
	calcular_cuenta();
}

function calc_top_price_ind(o_price, o_double, now_size, price, price2)
{
	var price_top_new = 0;

	if( o_price!=0 )
		price_top_new = parseFloat(o_price);
	else
		if(o_double=='N')
			price_top_new = parseFloat(price);
		else
			price_top_new = parseFloat(price2);

	if(now_size==1 ||  now_size==5)
		return price_top_new *= 1;
	
	else if(now_size==2 ||  now_size==3)
		return price_top_new *= 1/2;

	else if(now_size==4)
		return price_top_new *= 2;
	
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
			if( !parent.hasClass('delete-def-top') )
				parent.addClass('delete-def-top');
			else
				parent.removeClass('delete-def-top');

		}
		else
			parent.remove();
		
		calcular_cuenta();
	});

}


function calcular_cuenta()
{
	var cuenta = 0;
	var topping_price = parseFloat( $('.items-toppings').attr('data-topprice') );
	var topping_price2 = parseFloat( $('.items-toppings').attr('data-topprice-two') );

	var pizza_price = parseFloat( $(".pizza_size").attr('data-price') );

	$(".add-topping").not(".def-top").each(function(index, val)
	{
		var top_calc = calc_top_price_ind(
			$(this).attr('data-t-price'), 
			$(this).attr('data-t-double'), 
			$(this).attr('data-size-top'), 
			topping_price, 
			topping_price2
		);
		
		cuenta += top_calc;
	});

	cuenta_total = (pizza_price+cuenta) * parseInt( $('.cantidad .quantity').html() );
	$('.total-price').html(cuenta_total.toFixed(2));
}

var cuenta_total = 0;
var size_topping = '';
var num_size_top = 1;

$(function()
{
	$('.cantidad .glyphicon-minus').click(function(){
		var cantidad = parseInt( $('.cantidad .quantity').html() );
		if(cantidad>1)
			$('.cantidad .quantity').html( cantidad-1 );
		calcular_cuenta();
	});

	$('.cantidad .glyphicon-plus').click(function(){
		var cantidad = parseInt( $('.cantidad .quantity').html() );
		$('.cantidad .quantity').html( cantidad+1 );
		calcular_cuenta();
	});


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
		if($(this).attr('data-size-top')=="1")
			size_topping = "";
		else if($(this).attr('data-size-top')=="2")
			size_topping = "[left]";
		else if($(this).attr('data-size-top')=="3")
			size_topping = "[rigth]";
		else if($(this).attr('data-size-top')=="4")
			size_topping = "[extra]";
		else if($(this).attr('data-size-top')=="5")
			size_topping = "[lite]";

		num_size_top = parseInt( $(this).attr('data-size-top') );
	});

	$(".pizza_size")
		.html( $(".sizes a:first-child").html() )
		.attr('data-price', $(".sizes a:first-child").attr('data-price'))
		.attr('data-id-size', $(".sizes a:first-child").attr('data-id-size'));
	
	$('.total-price').html( $(".sizes a:first-child").attr('data-price') );

	$('.items-toppings')
		.attr('data-topprice', $(".sizes a:first-child").attr('data-top-price'))
		.attr('data-topprice-two', $(".sizes a:first-child").attr('data-top-price-two'));
	
	$('.size').click(function()
	{
		$('.items-toppings')
			.attr('data-topprice', $(this).attr("data-top-price"))
			.attr('data-topprice-two', $(this).attr("data-top-price-two"));
		
		$(".pizza_size")
			.attr('data-price', $(this).attr('data-price'))
			.attr('data-id-size', $(this).attr('data-id-size'))
			.html( $(this).html() );

		$('.size.active').removeClass('active');
		$(this).addClass('active');

		calcular_cuenta();


		$('.add-topping').each(function(index, el)
		{
			var chan_val_top = calc_top_price_ind(
				$(this).attr('data-t-price'), 
				$(this).attr('data-t-double'),
				$(this).attr('data-size-top'),
				parseFloat($('.items-toppings').attr('data-topprice')),
				parseFloat($('.items-toppings').attr('data-topprice-two'))
			);
			
			$(this).children('.topp_ind').text('$'+chan_val_top.toFixed(2));
			
		});


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