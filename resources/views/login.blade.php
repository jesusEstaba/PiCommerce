<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	{!!Html::style('assets/bootstrap/css/bootstrap.min.css')!!}
	{!!Html::style('css/login.css')!!}

	<style type="text/css">
	body{
		background: url("{{asset('images/backgrounds/'.$config->background)}}") center center no-repeat fixed !important;
		background-size: cover !important;
	}
	.restore{
		display: none;
	}
	.forgot{
		cursor: pointer !important;
	}
	</style>
	
</head>
<body>

@if( Session::has('message-error') )
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>Warning!</strong> {{Session::get('message-error')}}.
	</div>
@endif

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
				{!!Form::open(['url'=>'login'])!!}
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<input name="email" type="text" class="form-control" placeholder="Email">
							</div>
							<div class="form-group">
								<input name="password" type="password" class="form-control" placeholder="Password">
							</div>
							<a class="forgot">Forgot your password?</a>
						</div>
					</div>

					<div class="row">
						<div class="col-xs-12">
							<input class="btn btn-primary" type="submit" value="Login">
							<a href="{{url('register')}}" class="btn btn-success">Register</a>
							<a href="{{url('choose')}}" class="btn btn-warning">Skip</a>
						</div>
					</div>
					{!!Form::token()!!}
				{!!Form::close()!!}
				<div class="restore">
					<input name="email-reset-pass" type="text" class="form-control" placeholder="Email">
					<div class="btn btn-primary restore-now no-press">Continue</div>
				</div>
			</div>
		</div>
	</div>
</div>

	@include('sections.footer')
	<script type="text/javascript" src="{{asset('assets/jquery/jquery.min.js')}}"></script>

	<script type="text/javascript">

function message_alert(class_alert, text) {
    $('.messages').children().remove();
    var mess = '<strong>' + text + '</strong>.';
    var alerta = '<div class="alert alert-' + class_alert + ' alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button>' + mess + '</div>';
    $('.messages').append(alerta);
}


    $('.forgot').click(function() {
        $('form').fadeOut('slow', function() {
            $('.restore').fadeIn('slow');
        });
    });

    $('.restore-now').click(function() {
		if ($(this).hasClass('no-press')) {
			if ($('[name=email-reset-pass]').val()) {
				$('.restore-now')
					.removeClass('no-press')
					.addClass('reload-now');

				var ruta = '/reset/to/' + $('[name=email-reset-pass]').val();

				$.get(ruta, function(data) {
					if (data.message == 'Email Send! Please check your email') {
						message_alert('success', data.message)

						$('[name=email-reset-pass]')
							.fadeOut('fast')
							.val("");

						$('.restore-now')
							.text('Next')
							.removeClass('btn-primary')
							.addClass('btn-success');
					} else {
						message_alert('danger', data.message)
					}
				});
			} else {
				alert('Empty Field');
			}
		}

		if ($(this).hasClass('reload-now') && $(this).hasClass('btn-success')) {
			window.location.reload(true);
		}
    });


	</script>
</body>
</html>