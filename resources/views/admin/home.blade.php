@extends('admin.layout')

@section('title', 'Home')
@section('section', 'Home')

@section('content')

<h2>Dashboard</h2>
<div class="row">



<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="info-box bg-yellow">
		<span class="info-box-icon">
			<i class="fa fa-comments"></i>
		</span>
		<div class="info-box-content">
			<span class="info-box-text">Pending</span>
			<span class="info-box-number">{{$pendientes}}</span>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="info-box bg-blue">
		<span class="info-box-icon">
			<i class="fa fa-shopping-cart"></i>
		</span>
		<div class="info-box-content">
			<span class="info-box-text">New Orders</span>
			<span class="info-box-number">{{$new_orders}}</span>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="info-box bg-red">
		<span class="info-box-icon">
			<i class="fa fa-users"></i>
		</span>
		<div class="info-box-content">
			<span class="info-box-text">Customers</span>
			<span class="info-box-number">{{$num_user}}</span>
		</div>
	</div>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
	<div class="info-box bg-green">
		<span class="info-box-icon">
			<i class="fa fa-bar-chart"></i>
		</span>
		<div class="info-box-content">
			<span class="info-box-text">Total Profit</span>
			<span class="info-box-number">${{$profit_month}}</span>
		</div>
	</div>
</div>



</div>


<div class="row">
	<div class="col-md-6">
		<div class="box">
			<div class="box-body">
				<canvas id="myChart"></canvas>
			</div>
		</div>
		
	</div>
	<div class="col-md-6">
		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Application Buttons</h3>
                </div>
                <div class="box-body">
                 <!--  <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a&gt;</code> tag to achieve the following:</p> -->
                  <a href="{{url('kitchen/config')}}" class="btn btn-app">
                    <i class="fa fa-cogs"></i> Configuration
                  </a>
                  <a href="{{url('kitchen/users')}}" class="btn btn-app">
                    <i class="fa fa-users"></i> Customers
                  </a>
                  <a href="{{url('kitchen/orders')}}" class="btn btn-app">
                    <i class="fa fa-shopping-cart"></i> Orders
                  </a>
                  <a class="btn disabled btn-app">
                    <i class="fa fa-book"></i> My Menu
                  </a>
                  <a class="btn disabled btn-app">
                    <i class="fa fa-money"></i> Coupons
                  </a>
                  <a class="btn disabled btn-app">
                    
                    <i class="fa fa-bullhorn"></i> Lunch Specials
                  </a>
                  <a class="btn disabled btn-app">
                    
                    <i class="fa fa-sticky-note-o"></i> Discount Coupons
                  </a>
                  <a class="btn disabled btn-app">
                    
                    <i class="fa fa-users"></i> Promo Tools
                  </a>
                  <a class="btn disabled btn-app">
                    
                    <i class="fa fa-bar-chart"></i> Reports
                  </a>
                  <a class="btn disabled btn-app">
                    
                    <i class="fa fa-credit-card"></i> Gif Cards
                  </a>
                </div><!-- /.box-body -->
              </div>
	</div>
</div>
	
<div class="row">
	<div class="col-xs-12">
		

<!-- INICIO -->

<div class="box">
	<div class="box-header">
		<div class="row">
			<div class="col-xs-12">
				<h4>Incoming orders from merchant for today <span class="text-success">{{$today}}</span></h4>
			</div>
		</div>
	</div>
	<div class="box-body">
	@if( count($orders) )
		
		<div class="row">
			<div class="col-sm-12">
				<table class="table table-bordered table-striped dataTable">
					<thead>
						<tr>
							<th>
								Order
							</th>
							<th>
								Customer
							</th>
							<th>
								Total
							</th>
							<th>
								Date Purchased
							</th>
							<th>
								Status
							</th>
							<th>
								More
							</th>
						</tr>
					</thead>

					<tbody>

					@foreach($orders as $key => $order)
						<tr>
							<td>
								{{$order->Hd_Ticket}}
							</td>
							<td>
								{{$order->Cs_Name}}
							</td>
							<td>
								${{round($order->Hd_Total, 2)}}
							</td>
							<td>
								{{$order->Hd_Date}}
							</td>
							<td>
								@if($order->Hd_Status==1)
									<span class="label label-success">Approved</span>
								@else
									<span class="label label-warning">Pending</span>
								@endif
							</td>
							<td>
								<a href="{{url('kitchen/orders/'.$order->Hd_Ticket)}}" class="btn btn-default"><span class="glyphicon glyphicon-share-alt"></span></a>
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
					Showing {{$orders->currentPage()}} to {{$orders->lastPage()}} of {{$orders->total()}} entries
				</div>
			</div>
			<div class="col-sm-7">
				<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
					@if(isset($search))
					{!!$orders->appends(['search' => $search, 'category'=>$category])->render()!!}
					@else
					{!!$orders->render()!!}
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

<!-- FIN -->

	</div>
</div>

<style type="text/css">
	#myChart{
		width: 100% !important;
	}
</style>
@stop




@section('script')
<script type="text/javascript">

$('.sidebar-menu li:eq(0)').addClass('active');
	var months_year = [
		'January', 
		'February', 
		'March', 
		'April', 
		'May', 
		'June', 
		'July', 
		'August', 
		'September', 
		'October', 
		'November',
		'December'
    ];

	var ctx = document.getElementById("myChart").getContext("2d");

	var data = {
	    labels: [
	    	@foreach($number_months as $val)
				months_year[{{(int)$val}}],
			@endforeach
	    ],
	    datasets: [
	        {
	            label: "Ventas",
	            fillColor: "#00A65A",
	            strokeColor: "#00A65A",
	            highlightFill: "#00A65A",
	            highlightStroke: "#00A65A",
	            data:[
	            	@foreach($data_month as $val)
						{{(float)$val}},
					@endforeach
				]
	            	
	            //[65, 59, 80, 81, 56, 55, 40, 50, 89, 105, 116, 123]
	        }
	    ]
	};
	

	Chart.defaults.global.responsive = true;

	var myBarChart = new Chart(ctx).Bar(data);
	
	$(window).resize(function(){
		  //myBarChart.resize()
	});

	
</script>
@stop