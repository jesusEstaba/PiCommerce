@extends('sections.main')

@section('title', 'Checkout')
@section('content')

<div class="container space">
	<div class="">
		<div class="row">
			<div class="col-xs-12">
				<h2>Pay Order</h2>
			</div>
			<div class="col-xs-12">
				<div class="row">
					<div class="col-md-8">
						<div class="white space-bottom">

							@if($select=='delivery')
							@if(!$delivery)
							<div class="divisor">
								<h3 class="text-danger">
								Your are not in the zipcode range, This order will be ready for pickup.
								</h3>
							</div>
							@endif
							@endif

							<div class="row">
								@if($select=='delivery' && $delivery)
								<div class="col-md-6">
									<div class="divisor">
										<h4>Customers Details</h4>
										<p>
											<b>Name: </b>{!!$user->Cs_Name or '<em>No Name</em>'!!}
										</p>
										<p>
											<b>Phone: </b>{!!$user->Cs_Phone or '<em>No Phone</em>'!!}
										</p>
										<p>
											<b>Email: </b>{!!$user->email or '<em>No Email</em>'!!}
										</p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="divisor">
										<h4>Delivery Details</h4>
										<p>
											<b>Street #: </b>{!!$user->Cs_Number or '<em>No Number</em>'!!}
										</p>
										<p>
											<b>Street Name: </b>{!!$user->Cs_Street or '<em>No Street</em>'!!}
										</p>
										<p>
											<b>Zip Code: </b>{!!$user->Cs_ZipCode or '<em>No Zip Code</em>'!!}
										</p>
										@if($user->Cs_Notes)
										<p class="divisor">
											<b>Special Directions: </b>{{$user->Cs_Notes}}
										</p>
										@endif
									</div>
								</div>
								@else
								<div class="col-xs-12">
									<div class="divisor">
										<h4>Customers Details</h4>
										<p>
											<b>Name: </b>{!!$user->Cs_Name or '<em>No Name</em>'!!}
										</p>
										<p>
											<b>Phone: </b>{!!$user->Cs_Phone or '<em>No Phone</em>'!!}
										</p>
										<p>
											<b>Email: </b>{!!$user->email or '<em>No Email</em>'!!}
										</p>
									</div>
								</div>
								@endif
							</div>
							<div class="divisor">
								<h4>Payment Method</h4>
								<div>
									<input name="mtpay" id="credit" value="2" type="radio" checked/>
									<label for="credit">
										<img src="{{asset('images/extras/paymethods.png')}}">
									</label>
									<input name="mtpay" id="cash" value="1" type="radio"/>
									<label for="cash">
										<b>Cash</b>
									</label>
									
									
								</div>
								<div class="hide icons-pay">
									<span class="pf pf-cash"></span>
									<span class="pf pf-maestro"></span>
									<span class="pf pf-visa"></span>
									<span class="pf pf-paypal"></span>
									<span class="pf pf-stripe"></span>
								</div>
								<form class="hide form-horizontal" role="form">
									<fieldset>
										<legend>
											<div>
												<input name="mtpay" value="2" type="radio" checked/>
												<img src="{{asset('images/extras/paymethods.png')}}">
												<input name="mtpay" value="1" type="radio"/>
												Cash
											</div>
										</legend>
										<div class="frame-pay">
											<div class="form-group">
												<label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="card-number">Card Number</label>
												<div class="col-sm-9">
													<input type="text" class="form-control" name="card-number" id="card-number" placeholder="Debit/Credit Card Number">
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
												<div class="col-sm-9">
													<div class="row">
														<div class="col-xs-3">
															<select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
																<option>Month</option>
																<option value="01">Jan (01)</option>
																<option value="02">Feb (02)</option>
																<option value="03">Mar (03)</option>
																<option value="04">Apr (04)</option>
																<option value="05">May (05)</option>
																<option value="06">June (06)</option>
																<option value="07">July (07)</option>
																<option value="08">Aug (08)</option>
																<option value="09">Sep (09)</option>
																<option value="10">Oct (10)</option>
																<option value="11">Nov (11)</option>
																<option value="12">Dec (12)</option>
															</select>
														</div>
														<div class="col-xs-3">
															<select class="form-control" name="expiry-year">
																<option>Year</option>
																<option value="16">2016</option>
																<option value="17">2017</option>
																<option value="18">2018</option>
																<option value="19">2019</option>
																<option value="20">2020</option>
																<option value="21">2021</option>
																<option value="22">2022</option>
																<option value="23">2023</option>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-3 control-label" for="cvv">Card CVV</label>
												<div class="col-sm-3">
													<input type="password" maxlength="6" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-offset-3 col-sm-9">
													<button type="button" class="btn btn-success verify">Verify</button>
												</div>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<div class="hide divisor">
								<h4>Payment Method</h4>
								<div class="btn-pay select-pay">
									<span class="glyphicon glyphicon-usd select-pay"></span>
									<p>Cash</p>
								</div>
								<div class="btn-pay">
									<span class="glyphicon glyphicon-credit-card"></span>
									<p>Credit Card</p>
								</div>
							</div>
							<div class="divisor">
								<h4>Coupon Code</h4>
								<div class="form-group">
									<input style="width:79%;display: inline-block;" name="code" placeholder="Code Here" class="form-control"></input>
									<span id="code" class="btn btn-primary" style="width: 20%">Use</span>
									<label style="font-size: .9em; font-weight: 100;" class="text-muted">if you have a code I put it here to receive a discount.</label>
								</div>
							</div>
							<div class="divisor">
								<div class="totales">
									<h4>
									<b>Sub-Total: </b>
									<span class="old-sub">
										$
										<span class="sub_total-price">{{$total_cart}}</span>
									</span>
									<b class="discount"></b>

									</h4>
									<div class="mid-messages">
										<h4>
										<b>Coupon: </b>
										- $<span class="cupon-vprice">0.00</span>
										</h4>
									</div>
									<h4>
									<b>Tax: </b>$
									<span data-tax="{{$tax}}" class="tax-price">{{$taxs}}</span>
									</h4>
									@if($select=='delivery' && $delivery)
										<h4>
										<b>Delivery: </b>$
										<span class="delivery-price">{{$delivery_value}}</span>
										</h4>
										<h4>
										<b>Gruatity: </b>$
										<input style="width:20%;display: inline-block;" name="tips" placeholder="tip" class="form-control"></input><div class="add-tip btn btn-warning">Add tip</div>
										</h4>
									@endif
									<h4 class=" ccfee">
									<b>Credit Card Processing Fee: </b>$
									<span class="fee-price">{{$fee}}</span>
									</h4>
									<h3 >
									<b>Total: </b>$
									<span class="total-price">{{$total_to_pay}}</span>
									</h3>
								</div>
							</div>
							@if($delivery)
							<div class="divisor">
								<p>
									<b>Delivery Date: </b>{{$delivery_date}}
								</p>
								<p style="font-size: .8em;">
									Note: The "Minimun Estimated Time for Delivery" during normal business hours is 1 Hour from Monday to Wednesday and during rush hours (5:00 pm to 9:00 pm) on Thursday, Friday and Saturday you might experience an brief delay.
								</p>
							</div>
							@endif
							<div class="divisor note">
								<p>
									<b>NOTE! The below IP and ISP has been recorded for security purposes.</b>
								</p>
								<p>
									<b>IP Address:</b> {{$ip_user}}
								</p>
								@if($isp_user)
								<b>ISP:</b> {{$isp_user}}
								@endif
							</div>
							<br>
							<div>
								<a href="{{url('cart')}}" class="btn btn-default">Back to cart</a>
								<a class="btn order_now btn-success has-spinner">
									<span class="spinner"><i class="icon-spin icon-refresh"></i></span>
									<span>Order Now</span>
								</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="white space-bottom">
							@if($cart)
							<h4 class="title-orange">
							<div class="row">
								<div class="col-xs-2">
									Qty.
								</div>
								<div class="col-xs-7">
									<p>
										Description
									</p>
								</div>
								<div class="col-xs-3">
									<span class="pull-right">Price</span>
								</div>
							</div>

							</h4>
							<div class="cart-actual">
								@foreach($cart as $array => $campo)
								<h4 class="titulo-product">
								<div class="row">
									<div class="col-xs-2">
										<b class="text-descrip-product">{{ $campo->quantity }}</b>
									</div>
									<div class="col-xs-7">
										<span> {{$campo->It_Descrip or $campo->Sz_Abrev}}</span>
									</div>
									<div class="col-xs-3">
										<span class="pull-right">${{number_format($campo->Sz_Price, 2)}}</span>
									</div>
								</div>

								</h4>

								<div class="row">
									<div class="col-xs-10 col-xs-offset-2">
										@foreach($campo->toppings_list as $tab => $val)
										<h5 class="text-muted">
										<span>
											<b>{{strtolower($val->Tp_Descrip)}}</b>
											<span style="margin-left: .3em;">{{$size($val->size)}} </span>
										</span>
										<span class="pull-right">
											@if($val->price > 0)
											${{number_format($val->price, 2)}}
											@endif
										</span>
										</h5>
										@endforeach
									</div>
								</div>

								@endforeach

							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{!!Form::token()!!}

<div id="min-ord" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Info</h4>
      </div>
      <div class="modal-body">
        the minimum order is $<span id="min-value">{{number_format($minValue, 2)}}</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="{{asset('css/pay.css')}}">

<script src="{{asset('js/pay.js')}}" type="text/javascript"></script>

@stop