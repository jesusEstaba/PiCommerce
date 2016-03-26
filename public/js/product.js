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
	
	var id_del_size = $(".pizza_size").attr('data-id-size');
	var qty = $('.cantidad .quantity').html();
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

	var cooking_note_texts = instrucciones+menos_toppings+cooking_instruction();

	$.ajax({
		url: '/add_to_cart_ajax',
		type: 'POST',
		dataType: 'json',
		headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
		data:
		{
			id_size:id_del_size,
			quantity:qty,
			toppings_id:selected,
			toppings_size:topings_selected,
			cooking_notes:cooking_note_texts,
		},
	})
	.done(function(data)
	{
		$('.has-spinner')
			.toggleClass('active')
			.addClass('redirect-cart-now');
		
		if(data.status=='online')
		{
			$('.btn-checkout')
				.addClass('sesion-on')
				.removeClass('off-check')
				.addClass('btn-success');
		}
		else
		{
			$('.btn-checkout')
				.addClass('sesion-off')
				.removeClass('off-check')
				.addClass('btn-success');
		}

		
	});


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
		price_top_new *= 1;
	
	else if(now_size==2 ||  now_size==3)
		price_top_new *= 1/2;

	else if(now_size==4)
		price_top_new *= 2;

	return Math.round(price_top_new * 100) / 100;
	
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


	$('.btn-checkout').click(function(){
		if(!$(this).hasClass('off-check'))
		{
			window.location.href ='/select'
		}
	});
	

	$('.go-checkout-cart').click(function(){

		
		
		if( $(this).hasClass('btn-success') )
		{
			addToCart();//apara agregarlo por ajax// recuerda que simpre se sube por ajax con esta funcion
			$(this)
				.toggleClass('active')
				.removeClass('btn-success')
				.addClass('btn-primary')
				.children('span.text-cart')
				.text('Go to Cart');
		}
		else
		{
			if($(this).hasClass('redirect-cart-now'))
				window.location.href = '/cart';
		}

		//$('.btn-checkout').click(function(){});

		//$('.send-to-cart').click();
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