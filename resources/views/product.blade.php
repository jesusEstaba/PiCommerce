@extends('sections.main')

@section('title', 'Build')
@section('content')

<div class="container space bottom-space">
	<div class="row">
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
										<a class="btn btn-default size" price="{{$val->Sz_Price}}" top-price="{{$val->Sz_Topprice}}">{{$val->Sz_Abrev}}</a>
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
					<h2>Add Toping</h2>

					<div class="row">
						<div class="col-md-3 col-sm-6">
							<p class="drag">EXTRA_CHEESE</p>
							<p class="drag">FETA_CHEESE</p>
							<p class="drag">RICOTTA_CHEESE</p>
						</div>
						<div class="col-md-3 col-sm-6">
							<p class="drag">PEPRONI</p>
							<p class="drag">SAUSAGE</p>
							<p class="drag">HAM</p>
							<p class="drag">BACON</p>
							<p class="drag">GROUND_BEEF</p>
							<p class="drag">MEATBALLS</p>
							<p class="drag">SALAMI</p>
						</div>
						<div class="col-md-3 col-sm-6">
							<p class="drag">CHICKEN</p>
							<p class="drag">ANCHOVIES</p>
						</div>
						<div class="col-md-3 col-sm-6">
							<p class="drag">ONIONS</p>
							<p class="drag">GREEN_PEPPERS</p>
							<p class="drag">MUSHR</p>
							<p class="drag">SPINACH</p>
							<p class="drag">GARLIC</p>
							<p class="drag">BROCOLLI</p>	
							<p class="drag">FRESH_BASIL</p>
							<p class="drag">EGGPLANT</p>
						</div>
						<div class="col-md-3 col-sm-6">
							<p class="drag">BLACK_OLIVES</p>
							<p class="drag">GREEN_OLIVES</p>
							<p class="drag">PINEAPPLE</p>
							<p class="drag">TOMATO</p>
						</div>
						<div class="col-md-3 col-sm-6">
							<p class="drag">JALAPENO</p>
							<p class="drag" id="draggable">BANNANA_PEPPERS</p>
						</div>

						<div class="col-xs-12">
							<div class="input-control">
								<textarea placeholder="cooking instructions" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="col-md-4 bottom-space">
			<div class="counter-price" id="droppable">
				<h3 class="pizza_size">Pizza Size</h3>
				<ul class="items-toppings">
					<li class="def-top">Pepperoni</li>
					<li class="def-top">Double Cheese</li>
					<li class="def-top">Onios</li>
					<li class="def-top">Corn</li>
				</ul>

				<h2 class="text-success price-all"><span class="total-price">14.99</span>$</h2>
				<a href="{{url('cart')}}" class="btn btn-success go-checkout-cart">Add to Car</a>
			</div>	
		</div>

	</div>
	
</div>

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

</style>

<script type="text/javascript">
$.fn.hasAncestor = function(a) {
    return this.filter(function() {
        return !!$(this).closest(a).length;
    });
};



$(function() {
	$(".pizza_size").html( $(".sizes a:first-child").html() );
	$('.total-price').html( $(".sizes a:first-child").attr('price') );
	var topprice_origin = parseFloat( $(".sizes a:first-child").attr('top-price') );

	$('.size').click(function(){
		$('.pizza_size').html( $(this).html() );
		

		var topping_price = $(this).attr("top-price");

		var total_topping_price = $(".items-toppings").children().not(".def-top").length * topping_price;

		$('.total-price').html( ( parseFloat( $(this).attr('price') )+ total_topping_price ).toFixed(2) );



		//$(".total-price").html( ( parseFloat( $(".total-price").html() ) + 1 ).toFixed(2) );

	});


   // $( "#catalog" ).accordion();



/*    $( ".add-topping" ).draggable({
    	drag:function(){
    		console.log("move");
    	}
    });
*/


    $( ".drag" ).draggable({
      appendTo: "body",
      helper: "clone",
      drag:function(event, ui) {
    	ui.helper.addClass('helper-pizza');
	}
    });
    
    $( "#droppable ul" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function( event, ui ) {
        $( this ).find( ".placeholder" ).remove();
        $( "<li class='add-topping'></li>" ).text( ui.draggable.text() ).appendTo( this );
		

		/*
		var cuenta = 0;
        $(".items-toppings li").each(function(index, el) {
        	cuenta++;
        });
        alert(cuenta);
		*/

        $(".total-price").html( ( parseFloat( $(".total-price").html() ) + topprice_origin ).toFixed(2) );

      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      },

out: function (event, ui) {
        console.log(ui);

        /*i.helper.remove();*/
        if(ui.helper)
        ui.helper.fadeOut(1000, function () {
            $(this).remove();
        });
    }



    });
  });
</script>

@stop