@extends('admin.layout')

@section('title', 'Coupons')

@section('content')



<div class="box">
	<div class="box-header">
		<h2>
			Coupons
			<span class="glyphicon glyphicon-plus btn btn-success new"></span>
		</h2>
	</div>
	<div class="box-body">
	@if( count($coupons) )
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Code
							</th>
							<th>
								Used
							</th>
							<th>
								Discount
							</th>
							<th>
								End Date
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($coupons as $arr => $data)
							<tr>
								<td>
									<a href="{{url('kitchen/coupons/'.$data->id)}}">{{$data->code}}</a>
								</td>
								<td>
									{{$data->used}}
								</td>
								<td>
									{{$data->discount}}%
								</td>
								<td>
									{{$data->rot}}
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-5">
				<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
					Showing {{$coupons->currentPage()}} to {{$coupons->lastPage()}} of {{$coupons->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					@if(isset($search))
					{!!$coupons->appends(['search' => $search])->render()!!}
					@else
					{!!$coupons->render()!!}
					@endif
				</div>
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
        <h4 class="modal-title">Add Group</h4>
      </div>
      <div class="modal-body">

      	<div class="form-group">
      		<label>Code: </label>
	      <input type="text" class="form-control" name="code" placeholder="Name Group" autocomplete="off">
	    </div>
    <div class="form-group">
      		<label>Discount:</label>
	      <input type="text" class="form-control" name="disc" placeholder="Name Group" autocomplete="off">
	    </div>
	    <div class="form-group">
      		<label>Expiration Date:</label>
	      <input type="text" class="form-control" name="date" placeholder="Name Group" autocomplete="off">
	    </div>

        
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary save" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  {!!Form::token()!!}
</div><!-- /.modal -->



@stop

@section('script')
<script type="text/javascript">

$(function()
{
	$('#coupons').addClass('active');

	$('.new').click(function(){
		$('#myModal').modal();
	});

	$('.save').click(function(){

		if($("[name=code]").val() && $("[name=disc]").val() && $("[name=date]").val())
		{
			$.ajax({
				type: 'POST',
				dataType: 'json',
				headers:{'X-CSRF-TOKEN' : $('[name=_token]').val()},
				data:
				{
					code: $("[name=code]").val(),
					disc: $("[name=disc]").val(),
					date: $("[name=date]").val(),
				},
			})
			.done(function(data)
			{
				if("New Coupon"==data)
				{
					document.location.reload(true);
				}
			});
		}
		else
			alert('Empty Field');
	});

})

</script>
@stop