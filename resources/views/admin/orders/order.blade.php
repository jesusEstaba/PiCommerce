@extends('admin.layout')

@section('title', 'Order')

@section('content')
	<h2>Order</h2>
	@if($order)
		
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<p>
						<b>Name: </b> {!!$order->Cs_Name or 'No Name'!!}
					</p>
					<p>
						<b>Phone:</b> {!!$order->Cs_Phone or 'No Phone'!!}
					</p>
					<p>
						<b>Email:</b> {!!$order->Cs_Email1 or 'No Email'!!}
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<p>
						<b>Shiping Address:</b>
					</p>
					<p>
						{!!$order->Cs_Number or 'No Number Street'!!}
					</p>
					<p>
						{!!$order->Cs_Street or 'No Name Street'!!}
					</p>
					<p>
						{!!$order->Cs_ZipCode or 'No Zip Code'!!}
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="box">
		<div class="box-body">
			<p>
				<b>Payment Method: </b>{{$order->Pf_Description}}
			</p>
		</div>
	</div>



<div class="box">
	<div class="box-body">
		@if(count($products))
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Area
							</th>
							<th>
								Item
							</th>
							<th>
								Quantity
							</th>
							<th>
								Price
							</th>
							<th>
								Top Price
							</th>
							<th>
								Total
							</th>
							<th>
								Notes
							</th>
							<th>
								Toppings
							</th>
						</tr>
					</thead>
					<tbody>
						@foreach($products as $arra => $product)
						<tr>
							<td>{{$product->F_Descripc}}</td>
							<td>{{$product->Sz_Abrev}}</td>
							<td>{{$product->Dt_Qty}}</td>
							<td><b>$</b>{{$product->Dt_Price}}</td>
							<td><b>$</b>{{$product->Dt_TopPrice}}</td>
							<td><b>$</b>{{$product->Dt_Total}}</td>
							<td class="hide notes">{{$product->Dt_Detail}}</td>
							<td>
								@if($product->Dt_Detail)
								<a class="btn note btn-default">view</a>
								@endif
							</td>
							<td class="hide top">
								<div class="tops">
									@foreach($product->topppings as $arra => $topping)
									<p>
										{{ucwords( strtolower($topping->DTt_Detail) )}}
										<b>${{$topping->DTt_Topprice}}</b>
									</p>
									@endforeach
								</div>
							</td>
							<td>
								@if( count($product->topppings) )
								<a class="btn toppings btn-default">view</a>
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		@else
		<h3 class="text-muted text-center">No Products</h3>
		<br>
		
		@endif
	</div>
</div>



<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-body">
				<h4>
					<b>Sub Total: </b>${{$order->Hd_Subtotal}}
				</h4>
				<h4>
					<b>Dsicount: </b>${{$order->Hd_Discount}}
				</h4>
				<h4>
					<b>Tax: </b>${{$order->Hd_Tax}}
				</h4>
				<h4>
					<b>Charge: </b>${{$order->Hd_Charge}}
				</h4>
				<h4>
					<b>Tips: </b>${{$order->Hd_Tips}}
				</h4>
				<h4>
					<b>Delivery: </b>${{$order->Hd_Delivery}}
				</h4>
				<h3>
					<b>Total: </b>${{$order->Hd_Total}}
				</h3>
			</div>
		</div>
	</div>
	
</div>
	@else
		<div class="box">
			<div class="box-body">
			<h3 class="text-center text-muted">This order does not exist!</h3>
		</div>
		</div>
		
	@endif

<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<style type="text/css">
.space{
	margin-top: 2em;
}
.divisor{
		border-radius: 2px;
		border:solid #b2b2b2 1px;
		padding: .5em;
		margin: 1em;
	}

.divisor.light{
		border:solid #eee 1px;
	}
	.btn.note{
		background-color: #9BB8E2; 
	}
	.btn.toppings{
		background-color: #E2C29B;
	}
</style>
@stop

@section('script')
	<script type="text/javascript">
		$('.note').click(function()
		{
			var note = $(this).parent().siblings('td.hide.notes').html();

			$('#myModal .modal-title').html("Notes");
			$('#myModal .modal-body').html("<p>"+note+"</p>");
			$('#myModal').modal();
		});

		$('.toppings').click(function()
		{
			var top = $(this).parent().siblings('td.hide.top').html();

			$('#myModal .modal-title').html("Topppings");
			$('#myModal .modal-body').html("<p>"+top+"</p>");
			$('#myModal').modal();
		});
	</script>
@stop