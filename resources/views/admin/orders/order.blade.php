@extends('admin.layout')

@section('title', 'Order')

@section('content')
	<h2>Order</h2>
	@if($order)
		
	<div class="row">
		<div class="col-md-6">
			<div class="divisor">
				<p>
					<b>Customer: </b> {{$order->first_name." ".$order->last_name}}
				</p>
				<p>
					<b>Phone:</b> {{$order->phone}}
				</p>
				<p>
					<b>Email:</b> {{$order->email}}
				</p>
			</div>
		</div>
		<div class="col-md-6">
			<div class="divisor">
				<p>
					<b>Shiping Address:</b>
				</p>
				<p>
					{{$order->street_number}}
				</p>
				<p>
					{{$order->street_name}}
				</p>
				<p>
					{{$order->zip_code}}
				</p>
				<p>
					{{$order->city}}
				</p>
				<p>
					{{$order->state}}
				</p>
				<p>
					{{$order->country}}
				</p>
			</div>
		</div>
	</div>
	<div class="divisor">
		<p>
			<b>Payment Method: </b>{{$order->Pf_Description}}
		</p>
	</div>

		<table class="table space">
			<thead>
				<tr>
					<td>
						<b>Area</b>
					</td>
					<td>
						<b>Item</b>
					</td>
					<td>
						<b>Quantity</b>
					</td>
					<td>
						<b>Price</b>
					</td>
					<td>
						<b>Top Price</b>
					</td>
					<td>
						<b>Total</b>
					</td>
					<td>
						<b>Notes</b>
					</td>
					<td>
						<b>Toppings</b>
					</td>
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
		<div class="row">
			<div class="col-md-6">
				<div class="divisor light">
					<p>
						<b>Sub Total: $</b>{{$order->Hd_Subtotal}}
					</p>
					<p>
						<b>Dsicount: $</b>{{$order->Hd_Discount}}
					</p>
					<p>
						<b>Tax: $</b>{{$order->Hd_Tax}}
					</p>
					<p>
						<b>Charge: $</b>{{$order->Hd_Charge}}
					</p>
					<p>
						<b>Tips: $</b>{{$order->Hd_Tips}}
					</p>
					<p>
						<b>Delivery: $</b>{{$order->Hd_Delivery}}
					</p>
					<p>
						<b>Total: $</b>{{$order->Hd_Total}}
					</p>
				</div>
			</div>
			<div class="col-md-6">
				
			</div>
		</div>
	@else
	
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