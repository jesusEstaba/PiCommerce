var disc = 0;
var type_disc = 1;
var credit_card = true;
var pay = false;
var good_card = false;
var is_delivery = false;

if ($('.delivery-price').length) {
    is_delivery = true;
}

function calcular() {
    var sub = Number($('.sub_total-price').html());
    var delivery_price = 0;
    var fee = 0;
    var total = 0;
    var discount = 0;
    var tip = 0;
    
    if ($('.delivery-price').length) {
        delivery_price = Number($('.delivery-price').html());
    }
    
    if (credit_card) {
        fee = Number($('.fee-price').html());
    }

    if ($('[name=tips]').length) {
        if (Number($('[name=tips]').val()) > 0) {
            tip = Number($('[name=tips]').val());
        }
    }
    
    if (disc) {
        if (type_disc===1){
            discount = sub * disc / 100;
        }
        else {
            discount = disc;
        }
        
        $('.cupon-vprice').html(discount.toFixed(2));
    }

    var sub_and_discount = sub - discount;

    if(sub_and_discount<0)
    {
        sub_and_discount = 0;
    }

    var new_tax = sub_and_discount * Number($('.tax-price').attr('data-tax')) / 100;
    total = sub_and_discount + new_tax + delivery_price + fee + tip;

    $('.sub_total-price').html(sub);
    $('.tax-price').html(new_tax.toFixed(2));
    $('.total-price').html(total.toFixed(2));
}

$(function() {
    $('[name=tips]').change(function() {
        calcular();
    });

    $('.add-tip').click(function(){
        calcular();
    });

    $('.verify').click(function() {
        if (
            $("[name=card-holder-name]").val() &&
            $("[name=card-number]").val() &&
            $("[name=expiry-month]").val() &&
            $("[name=expiry-year]").val() &&
            $("[name=cvv]").val()
        ) {
            good_card = true;
            pay = true;
            alert('verified credit card');
        } else {
            alert('Empty Field');
        }
    });
    
    $('[name=mtpay]').click(function() {
        if (Number($(this).val()) == 1) {
            $('.frame-pay').fadeOut('fast');

            credit_card = false;
            //pay = true;
            $('.fee-price').addClass('text-muted');
            $('.ccfee').addClass('hide');
        } else {
            $('.frame-pay').fadeIn('fast');

            credit_card = true;
            /*
            if (good_card){
                pay = true;
            }
            else{
                pay = false;
            }
            */

            $('.fee-price').removeClass('text-muted');
            $('.ccfee').removeClass('hide');
        }
        
        calcular();
    });
    
    $('.pf').click(function(event) {
        $('.pf').removeClass('act');
        $(this).addClass('act');
    });
    
    $('.order_now').click(function() {
        if (Number($('.sub_total-price').html()) >= Number($('#min-value').html())) {
            if (!$('.order_now').hasClass('active')) {
                calcular();
                var card = credit_card;
                var delivery = is_delivery;
                var tips = false;
                var tip = 0;

                if ($('[name=tips]').length) {
                    if (Number($('[name=tips]').val()) > 0) {
                        tip = Number(Number($('[name=tips]').val()).toFixed(2));
                        tips = true;
                    }
                }

                if (true) {
                    $('.order_now').addClass('active');
                    $.ajax({
                            url: '/order_now',
                            type: 'POST',
                            dataType: 'json',
                            headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() },
                            data: {
                                card: card,
                                delivery: delivery,
                                tips: tips,
                                tip: tip,
                            },
                        })
                        .done(function(data) {
                            if (data.status === 0) {
                                //window.location.href = "/choose";
                                console.info(data.message);
                            } else if (data.status === 1) {
                                
                                $('.order_now')
                                    .off()
                                    .addClass('next-mercury')
                                    .addClass('btn-primary')
                                    .removeClass('btn-success')
                                    .removeClass('has-spinner')
                                    .removeClass('order_now')
                                    .removeClass('active')
                                    .html('Next');

                                $('.next-mercury').on('click', function() {
                                    var jForm = $(
                                        '<form action="' + data.url + '" method="post">' +
                                            '<input name="PaymentID" type="hidden" value="' + data.message + '"\>' +
                                        '</form>'
                                    );
                                    
                                    // Submit the form.
                                    jForm.submit();
                                    
                                    
                                });


                                console.info(data.message);
                            } else if (data.status === 2) {
                                $('.order_now')
                                    .off()
                                    .addClass('go-home')
                                    .addClass('btn-primary')
                                    .removeClass('btn-success')
                                    .removeClass('has-spinner')
                                    .removeClass('order_now')
                                    .removeClass('active')
                                    .html('Go Home');

                                $('.go-home').on('click', function() {
                                    window.location.href = "/choose";
                                });

                                alert('go to Diginos!');
                            } else {
                                console.log(data);
                            }
                        })
                        .error(function() {
                            alert('An error has occurred, please restart the page');
                        });
                } else {
                    alert('Empty payment method');
                }
            }
        } else {
            $('#min-ord').modal();
        }
    });

    $('#code').click(function() {
        var code = $('[name=code]').val();
        
        if (code) {
            $.get('/coupon/' + code, function(data) {
                if (data.discount) {
                    disc = data.discount;
                    type_disc = data.type;
                    calcular();
                    $('[name=code]').val("");
                } else {
                    alert('Code Invalid');
                }
            });

        }
    });

	$('.glyphicon-usd').click(function() {
	    $('.glyphicon-usd')
	        .addClass('select-pay')
	        .parent()
	        .addClass('select-pay');

	    $('.glyphicon-credit-card')
	        .removeClass('select-pay')
	        .parent()
	        .removeClass('select-pay');
	    
	    $('.fee-price').addClass('text-muted');
	    
	    $('.ccfee').addClass('hide');
	    
	    calcular();
	    credit_card = false;

	});

	$('.glyphicon-credit-card').click(function() {
	    $('.glyphicon-usd')
	        .removeClass('select-pay')
	        .parent()
	        .removeClass('select-pay');

	    $('.glyphicon-credit-card')
	        .addClass('select-pay')
	        .parent()
	        .addClass('select-pay');
	    
	    $('.fee-price').removeClass('text-muted');
	    
	    $('.ccfee').removeClass('hide');
	    
	    calcular();
	    credit_card = true;
	});
});