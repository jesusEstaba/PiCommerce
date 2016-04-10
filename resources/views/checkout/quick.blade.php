<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Quick</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/login.css')!!}
{{--
	<style type="text/css">
	body{
		background: url("{{asset('images/backgrounds/'.$config->background)}}") center center no-repeat fixed !important;
  		background-size: cover !important;
	}
	</style>--}}
	
</head>
<body>

<div class="messages">
	
</div>

<div class="center-center">
	<div class="container">
		<div class="row">
			
			<div class="col-md-offset-4 col-md-4 login-box">

				<a href="{{url('/')}}">
					@if($config->logo)
						<img src="{{asset('images/logos/'.$config->logo)}}" alt="logo" class="logo">
					@endif
				</a>
				
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<input name="name" type="text" class="form-control" placeholder="First Name">
							</div>
							<div class="form-group">
								<input name="phone" type="text" class="form-control" placeholder="Phone Number">
							</div>
							<div class="form-group">
								<input name="email" type="text" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<p>
									<b style="color:white;">
										I have read the terms and conditions notice and I agree to it:
									</b>
									<input name="terms" type="checkbox">
								</p>					
								<a href="#">Terms and Conditions.</a>
							</div>

						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<a class="btn btn-primary order_now">Pay</a>
						</div>				
					</div>
					{!!Form::token()!!}
			</div>

		</div>
	</div>
</div>
{!!Html::script('assets/jquery/jquery.min.js')!!}

<script type="text/javascript">
	
function message_alert(class_alert, text) {
    $('.messages').children().remove();
    var mess = '<strong>' + text + '</strong>.';
    var alerta = '<div class="alert ' + class_alert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>' + mess + '</div>';
    $('.messages').append(alerta);
}

$(function() {
    $('.order_now').click(function() {
        if (
            $('[name=name]').val() &&
            $('[name=phone]').val() &&
            $('[name=email]').val()
        ) {

            $.ajax({
                    url: '/checkout/quick/order',
                    type: 'POST',
                    dataType: 'json',
                    headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() },
                    data: {
                        name: $('[name=name]').val(),
                        phone: $('[name=phone]').val(),
                        email: $('[name=email]').val(),
                    },
                })
                .done(function(data) {
                    if (data.status == 'correct') {
                        message_alert('alert-success', 'Order Success');

                        $('[name=name]').val('');
                        $('[name=phone]').val('');
                        $('[name=email]').val('');

                        window.setTimeout(function() {
                            window.location.href = "/choose";
                        }, 6000);
                    } else {
                        message_alert('alert-warning', data);
                    }
                })
                .error(function() {
                    message_alert('alert-danger', 'Error Conection, Refresh and try Again');
                });

        } else {
            alert('Empty Field');
        }

    });
});

</script>

	@include('sections.footer')
</body>
</html>