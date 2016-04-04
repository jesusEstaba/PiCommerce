@extends('sections.main')

@section('title', 'New Password')
@section('content')

<div class="container space">
	<div class="row ">
		<div class="col-xs-12">
			<div class="form-group">
				<input class="input form-control" type="password" name="pass" placeholder="New Password"/>
			</div>
			<div class="form-group">
				<input class="input form-control" type="password" name="repass" placeholder="Confirm"/>
			</div>
			<span class="change btn btn-success">Change</span>
			{!!Form::token()!!}
		</div>
	</div>
</div>


<script type="text/javascript">
		
	$(function(){
		$('.change').click(function(){
			if($('[name=pass]').val() == $('[name=repass]').val() && 
				$('[name=pass]').val().length >= 6
				)
			{
				$.ajax({
					url: window.location.href,
					type: 'POST',
					dataType: 'json',
					headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
					data: {
						pass:$('[name=pass]').val()
					},
				})
				.done(function() {
					alert('success');
					console.log("success");
				});
				
			}	
			else
			{
				alert('error');
			}

		});
	});


</script>


@stop
