var varCounter = 0;
var varName = function(){
    if(varCounter < 20) {
        varCounter++;
        
        $.ajax({
            url: '/checkout/mercuryVerify',
            type: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('[name=_token]').val()
            },
            data: {
                PaymentID: $('[name=payId]').val(),
            },
        })
        .done(function(data) {
        	if (data.code === 0) {
        		//
        		$('.very').html('Verified!').css('color', 'green');
        		$('.very').after('<p>' + data.message + '</p>');
        		varCounter = 20;
        	} else {
        		if (varCounter === 20) {
        			$('.very').html(data.message);
        		}
        	}
        });
        
        
    } else {
    	//alert("termino!");
        clearInterval(varName);
    }
};

$(function(){
	
	setInterval(varName, 15000);

	
});