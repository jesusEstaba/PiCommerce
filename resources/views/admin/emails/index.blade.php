@extends('admin.layout')
@section('title', 'Emails')
@section('content')
<div class="box">
	<div class="box-header">
		<h2>Emails Admin <span class="glyphicon glyphicon-plus btn btn-success new"></span></h2>
	</div>
	<div class="box-body">
		@if( count($emails) )
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								<b>Email</b>
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($emails as $arra => $admin)
						<tr>
							<td>
								<i data-email-id="{{$admin->id}}" style="margin-right: .5em;color:#6B6B6B;" class="fa fa-times delete-mail-admin"></i>
								{{$admin->email}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@else
		<h3 class="text-muted text-center">No Results</h3>
		<br>
		
		@endif
	</div>
</div>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Add Mail</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="name" placeholder="Email" autocomplete="off">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
	{!!Form::token()!!}
</div>
@stop


@section('script')
<script type="text/javascript">
$(function() {
    $('#email').addClass('active');

    $('.new').click(function() {
        $('#myModal').modal();
    });

    $('.save').click(function() {
        $.ajax({
                type: 'POST',
                dataType: 'json',
                headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() },
                data: {
                    name: $("[name=name]").val(),
                },
            })
            .done(function(data) {
                if ("New Mail" == data) {
                    if ($('.box-body table').length) {
                        $('tbody').prepend('<tr><td>' + $("[name=name]").val() + '</td></tr>');
                        $("[name=name]").val("");
                    } else {
                        document.location.reload();
                    }
                }
            });
    });

    $('.delete-mail-admin').click(function() {
        var id_mail_delete = $(this).attr('data-email-id');
        var route_to_delete = window.location.href + '/' + id_mail_delete;

        $.ajax({
                url: route_to_delete,
                type: 'DELETE',
                headers: { 'X-CSRF-TOKEN': $('[name=_token]').val() },
            })
            .done(function(data) {
                $('[data-email-id=' + id_mail_delete + ']').parent('td').parent('tr').fadeOut('slow', function() {
                    $(this).remove();
                });
               
                if ( !($('.box-body table tr').length>2) ) {
                    document.location.reload();
                }
            });
    });

});
</script>
@stop