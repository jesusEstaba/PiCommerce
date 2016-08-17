function addComboToCart(
    comboSize,
    comboTopId,
    comboTopSize
) { 
    var instrucciones = $(".notes_instructions").val(),
        comboQty = Number($('.cantidad .quantity').html()),
        comboId = $("#combo").attr('data-id');
   
    $.ajax({
            url: '/add_to_cart_ajax',
            type: 'POST',
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() },
            data: {
                combo_id : comboId,
                id_size : comboSize,
                toppings_id : comboTopId,
                toppings_size : comboTopSize,
                quantity : comboQty,
                cooking_notes: instrucciones,
            },
        })
        .done(function(data) {
            $('.has-spinner')
                .toggleClass('active')
                .addClass('redirect-cart-now');

            if (data.status == 'online') {
                $('.btn-checkout')
                    .addClass('sesion-on')
                    .removeClass('off-check')
                    .addClass('btn-success');
            } else {
                $('.btn-checkout')
                    .addClass('sesion-off')
                    .removeClass('off-check')
                    .addClass('btn-success');
            }
        });
}

function sendCombo() {
    var comboSize = [],
        comboTopId = [],
        comboTopSize = [];

    $('.items-toppings').each(function(index, el) {
        var sizeId = Number($(this).attr('data-id-size')),
            idTab = $(this).attr('id');

        comboSize.push(sizeId);

        var itemTopId = [],
            itemTopSize = [];

        //console.log('qty=' + qty + ' sizeId=' + sizeId);
        
        $('#' + idTab + ' .add-topping').each(function(index, el) {
            var idTopping = Number($(this).attr('data-id-top')),
                sizeTopping = Number($(this).attr('data-size-top'));

            itemTopId.push(idTopping);
            itemTopSize.push(sizeTopping);

            //console.log($(this).children('.descript_top').text());
        });

        //AÑADIR LOS COOKING INSTRUCTIONS ID'S

        comboTopId.push(itemTopId);
        comboTopSize.push(itemTopSize);
    });

    /*
    console.log(comboSize);
    console.log(comboTopId);
    console.log(comboTopSize);
    */

    addComboToCart(
        comboSize,
        comboTopId,
        comboTopSize
    );
}

function add_toping_to_list(object, parent) {
    var texto_comp = object.text().trim();

    //se debe decir el padre, si no los borra todos
    idParent = $(parent).attr('id');
    //esto es para validar si no existe otro topping con el mismo nombre
    $("#" + idParent + " .descript_top").each(function(index, ele) {
        var add_top = $(this);
        var size_topping_name = ["", "[left]", "[rigth]", "[extra]", "[lite]"];
        
        size_topping_name.forEach(function(name) {
            if (add_top.text() == texto_comp + " " + name) {
                add_top.parent().remove();
                calcular_cuenta();
            }
        });

    });

    var price_top_new = calc_top_price_ind(
        object.attr('data-price'),
        object.attr('data-double'),
        $("#" + idParent).attr('data-size-top'),
        $("#" + idParent).attr('data-topprice'),
        $("#" + idParent).attr('data-topprice-two')
    );

    var price_new_message_top = '';

    if (price_top_new > 0) {
        price_new_message_top = '$' + price_top_new.toFixed(2);
    }

    $("<li class='add-topping text-muted'></li>")
        .append('<span class="descript_top">' + texto_comp + " " + nameTopping($("#" + idParent).attr('data-size-top')) + '</span>')
        .attr('data-id-top', object.attr('data-id-top'))
        .attr('data-size-top', $("#" + idParent).attr('data-size-top'))
        .attr('data-t-double', object.attr('data-double'))
        .attr('data-t-price', object.attr('data-price'))
        .append('<span class="topp_ind pull-right">' + price_new_message_top + '</span>')
        .appendTo(parent);

    hover_click_topping();
    calcular_cuenta();
}

function calc_top_price_ind(o_price, o_double, now_size, price, price2) {
    var price_top_new = 0;
    o_price =  parseFloat(o_price);
    price =  parseFloat(price);
    price2 =  parseFloat(price2);

    if (o_price !== 0) {
        price_top_new = o_price;
    } else {
        if (o_double == 'N') {
            price_top_new = price;
        } else {
            price_top_new = price2;
        }
    }

    if (now_size == 1 || now_size == 5) {
        price_top_new *= 1;
    } else if (now_size == 2 || now_size == 3) {
        price_top_new *= 1 / 2;
    } else if (now_size == 4) {
        price_top_new *= 2;
    }

    return Math.round(price_top_new * 100) / 100;
}

function hover_click_topping() {
    $('.items-toppings li').off();

    $('.items-toppings li').hover(function() {
            $(this).append('<span class="glyphicon glyphicon-minus"></span>');
        },
        function() {
            $(this).children('.glyphicon-minus').remove();
        });


    $('.items-toppings li ').on('click', '.glyphicon-minus', function() {
        var parent = $(this).parent();

        if (parent.hasClass('def-top')) {
            if (!parent.hasClass('delete-def-top')) {
                parent.addClass('delete-def-top');
            } else {
                parent.removeClass('delete-def-top');
            }

        } else {
            parent.remove();
        }

        calcular_cuenta();
    });
}

function nameTopping($sizeNum) {
    if ($sizeNum == 1) {
        return "";
    } else if ($sizeNum == 2) {
        return "[left]";
    } else if ($sizeNum == 3) {
        return "[rigth]";
    } else if ($sizeNum == 4) {
        return "[extra]";
    } else if ($sizeNum == 5) {
        return "[lite]";
    }
}

function calcular_cuenta() {
    var qty = Number($('.cantidad .quantity').html()),
        cuenta = 0;

    $('.items-toppings').each(function(index, el) {
        var cuentaToppingsTab = 0,
            toppingPrice = parseFloat($(this).attr('data-topprice')),
            toppingPrice2 = parseFloat($(this).attr('data-topprice-two')),
            itemPrice = parseFloat($(this).attr('data-price'));

        $("#" + $(this).attr('id') + " .add-topping").not(".ui-sortable-placeholder").each(function(index, val) {
            var topCalc = calc_top_price_ind(
                $(this).attr('data-t-price'),
                $(this).attr('data-t-double'),
                $(this).attr('data-size-top'),
                toppingPrice,
                toppingPrice2
            );

            cuentaToppingsTab += topCalc;
        });
        cuenta += (itemPrice + cuentaToppingsTab);
    });

    cuenta *= qty;

    $('.total-price').html(cuenta.toFixed(2));

    sub_tax_total();
}

function sub_tax_total() {
    var total_cart = 0;

    if ($('.cart-actual').length) {
        total_cart = parseFloat($('.cart-actual').attr('data-total-cart'));
    }

    var price = parseFloat($('.total-price').html());
    var sub_total_price = total_cart + price;
    var sub_total_tax = sub_total_price * Number($('.tax').attr('data-tax')) / 100;

    $('.sub-total').html(sub_total_price.toFixed(2));

    $('.tax').html(sub_total_tax.toFixed(2));

    $('.total-cart').html((sub_total_price + sub_total_tax).toFixed(2));
}


$(function() {
    //Botones de los tabs Items
    $('.tab-items').on('click', function(event) {
        var tab = $(this).attr('data-tab');

        $('.tab-items').removeClass('active');
        $(this).addClass('active');

        $('#name-item').html($(this).html());
        $(".size.active[data-tab=" + tab + "]").click();

        $("#droppable ul").hide();
        $("#droppable #toppings-" + tab).show();

        //$('.cantidad .quantity').html($("#toppings-" + tab).attr('data-qty'));
    });


    //Botones size
    $('.size').on('click', function(event) {
        var tab = $(this).attr('data-tab');

        $(".size[data-tab=" + tab + "]").removeClass('active');
        $(this).addClass('active');
        
        $('#name-size').html($(this).html());
        $('.price-now-size-product').html($(this).attr('data-price'));
        
        $("#droppable ul").hide();
        $("#toppings-" + tab)
            .attr('data-id-size', $(this).attr('data-id-size'))
            .attr('data-price', $(this).attr('data-price'))
            .attr('data-topprice', $(this).attr('data-top-price'))
            .attr('data-topprice-two', $(this).attr('data-top-price-two'))
            .show();

        //ReCalculando el precio visual de los Toppings 
        $("#toppings-" + tab + ' .add-topping').not(".ui-sortable-placeholder").each(function(index, el) {
            var chan_val_top = calc_top_price_ind(
                $(this).attr('data-t-price'),
                $(this).attr('data-t-double'),
                $(this).attr('data-size-top'),
                $("#toppings-" + tab).attr('data-topprice'),
                $("#toppings-" + tab).attr('data-topprice-two')
            );

            if (chan_val_top > 0) {
                $(this).children('.topp_ind').text('$' + chan_val_top.toFixed(2));
            }
        });

        calcular_cuenta();
    });


    //Limite de los Checkbox
	$(".checkbox input").click(function(){
        var tab = $(this).parent().parent().attr('data-tab');
        
        if($(".checkbox[data-tab=" + tab + "] input:checked").length==$(".checkbox[data-tab=" + tab + "]").parent().attr('data-max-cook')) {
			$(".checkbox[data-tab=" + tab + "] input[type=checkbox]").not('input:checked').attr('disabled',true);
		} else {
			$(".checkbox[data-tab=" + tab + "] input[type=checkbox]").not('input:checked').attr('disabled',false);
		}
	});
    

    //Cantidad de items
    $('.cantidad .glyphicon-minus').click(function() {
        var cantidad = parseInt($('.cantidad .quantity').html());
            //tab = $('.tab-items.active').attr('data-tab');

        if (cantidad > 1) {
            $('.cantidad .quantity').html(cantidad - 1);
            $('.quantity-now-product').html(cantidad - 1);
            //$('#toppings-' + tab).attr('data-qty', cantidad - 1);
        }
        calcular_cuenta();
    });
    
    $('.cantidad .glyphicon-plus').click(function() {
        var cantidad = parseInt($('.cantidad .quantity').html());
            //tab = $('.tab-items.active').attr('data-tab');

        $('.cantidad .quantity').html(cantidad + 1);
        $('.quantity-now-product').html(cantidad + 1);
        //$('#toppings-' + tab).attr('data-qty', cantidad + 1);
        calcular_cuenta();
    });


    //Boton de Agregar en botones Drag
    $('.box-drag')
        .hover(function() {
                $(this).append('<span class="glyphicon glyphicon-plus"></span>');
            },
            function() {
                $(this).children('.glyphicon-plus').remove();
        })
        .on('click', '.glyphicon-plus', function() {
            var tab = $('.tab-items.active').attr('data-tab');
            add_toping_to_list($(this).siblings(), $("#toppings-" + tab));
            $(this).remove();
        });
    
    $('.drag').dblclick(function() {
        var tab = $('.tab-items.active').attr('data-tab');
        add_toping_to_list($(this), $("#toppings-" + tab));
    });
    

    //Botones de ir al checkout y cargar al Carrito
    $('.btn-checkout').click(function() {
        if (!$(this).hasClass('off-check')) {
            window.location.href = '/checkout';
        }
    });

    $('.go-checkout-cart').click(function() {
        var minimumOrderPrice = Number($('.total-price').attr('data-min')),
            nowInCombo = Number($('.total-price').html());

        if(minimumOrderPrice<nowInCombo) {
            if ($(this).hasClass('btn-success')) {
                //apara agregarlo por ajax
                // recuerda que simpre se sube por ajax con esta funcion
                sendCombo();
                
                $(this)
                    .toggleClass('active')
                    .removeClass('btn-success')
                    .addClass('btn-primary')
                    .children('span.text-cart')
                    .text('Go to Cart');
            } else {
                if ($(this).hasClass('redirect-cart-now'))
                    window.location.href = '/cart';
            }
        } else {
           alert('minimum order is $' + minimumOrderPrice.toFixed(2)); 
        }

        //$('.btn-checkout').click(function(){});

        //$('.send-to-cart').click();
    });


    //Botones que definen el tamaño del topping
    $('.topping-size').click(function() {
        $('.topping-size').removeClass('active');
        $(this).addClass('active');

        //$(this).attr('data-size-top')

        var num_size_top = parseInt($(this).attr('data-size-top'));
        var tab = $('.tab-items.active').attr('data-tab');
        
        $("#toppings-" + tab).attr('data-size-top', num_size_top);
    });


    //Objetos Jquery IU Drag and Drop
    $(".drag").draggable({
        appendTo: "body",
        helper: "clone",
        drag: function(event, ui) {
            ui.helper.addClass('helper-pizza');
        }
    });

    $("#droppable ul")
        .droppable({
            activeClass: "ui-state-default",
            hoverClass: "ui-state-hover",
            accept: ":not(.ui-sortable-helper)",
            drop: function(event, ui) {
                /*
                $(this).find(".placeholder").remove();
                */

                add_toping_to_list(ui.draggable, this);
                
            }
        })
        .sortable({
            items: "li:not(.placeholder)",
            sort: function() {
                $(this).removeClass("ui-state-default");
            },
            out: function(event, ui) {
                if (ui.helper) {
                    ui.helper.fadeOut(1000, function() {
                        $(this).remove();

                        calcular_cuenta();
                    });
                }
            }
        });


    //seteando valores
    $('.tab-items').each(function(index, el) {
        $(".size[data-tab=" + (index+1) + "]:first-child").click();
    });

    $(".size")[0].click();
    $(".tab-items")[0].click(); 
    
});
