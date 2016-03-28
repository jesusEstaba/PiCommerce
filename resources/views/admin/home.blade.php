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
			<span class="info-box-number">41</span>
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
			<span class="info-box-number">410</span>
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
			<span class="info-box-number">10</span>
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
			<span class="info-box-number">$41,410</span>
		</div>
	</div>
</div>



</div>


<div class="row">
	<div class="col-md-6">
		<canvas id="myChart" width="400" height="400"></canvas>
	</div>
	<div class="col-md-6">
		<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Application Buttons</h3>
                </div>
                <div class="box-body">
                 <!--  <p>Add the classes <code>.btn.btn-app</code> to an <code>&lt;a&gt;</code> tag to achieve the following:</p> -->
                  <a class="btn btn-app">
                    <i class="fa fa-edit"></i> Edit
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-play"></i> Play
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-repeat"></i> Repeat
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-pause"></i> Pause
                  </a>
                  <a class="btn btn-app">
                    <i class="fa fa-save"></i> Save
                  </a>
                  <a class="btn btn-app">
                    <span class="badge bg-yellow">3</span>
                    <i class="fa fa-bullhorn"></i> Notifications
                  </a>
                  <a class="btn btn-app">
                    <span class="badge bg-green">300</span>
                    <i class="fa fa-barcode"></i> Products
                  </a>
                  <a class="btn btn-app">
                    <span class="badge bg-purple">891</span>
                    <i class="fa fa-users"></i> Users
                  </a>
                  <a class="btn btn-app">
                    <span class="badge bg-teal">67</span>
                    <i class="fa fa-inbox"></i> Orders
                  </a>
                  <a class="btn btn-app">
                    <span class="badge bg-aqua">12</span>
                    <i class="fa fa-envelope"></i> Inbox
                  </a>
                  <a class="btn btn-app">
                    <span class="badge bg-red">531</span>
                    <i class="fa fa-heart-o"></i> Likes
                  </a>
                </div><!-- /.box-body -->
              </div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="white">
			
			<div class="row">
				<div class="col-md-6">
<div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div>
				</div>
				<div class="col-md-6">
					<div class="input-group margin">
						<input type="text" placeholder="Order Id" class="form-control">
		                    <div class="input-group-btn">
		                      <button type="button" class="btn btn-info">Search</button>
		                    </div><!-- /btn-group -->
		                    
		            </div>
				</div>
			</div>

			<table class="table table-striped">
				<thead>
				<tr>
					<td>
						<b>Order</b>
					</td>
					<td>
						<b>Customer</b>
					</td>
					<td>
						<b>Total</b>
					</td>
					<td>
						<b>Date Purchased</b>
					</td>
					<td>
						<b>More</b>
					</td>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							123
						</td>
						<td>
							Jesús
						</td>
						<td>
							$9.99
						</td>
						<td>
							Now
						</td>
						<td>
							More
						</td>
					</tr>
					<tr>
						<td>
							123
						</td>
						<td>
							Jesús
						</td>
						<td>
							$9.99
						</td>
						<td>
							Now
						</td>
						<td>
							More
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
@stop




@section('script')
<script type="text/javascript">

$('.sidebar-menu li:eq(0)').addClass('active');


	var ctx = document.getElementById("myChart").getContext("2d");

	var data = {
	    labels: [
	    	"January", 
	    	"February", 
	    	"March", 
	    	"April", 
	    	"May", 
	    	"June", 
	    	"July", 
	    	"August", 
	    	"September", 
	    	"October", 
	    	"November",
	    	"December"
	    ],
	    datasets: [
	        {
	            label: "Ventas",
	            fillColor: "rgba(42,55,132,0.5)",
	            strokeColor: "rgba(220,220,220,0.8)",
	            highlightFill: "rgba(0,115,135,0.75)",
	            highlightStroke: "rgba(220,220,220,1)",
	            data: [65, 59, 80, 81, 56, 55, 40, 50, 89, 105, 116, 123]
	        }
	    ]
	};

	var myBarChart = new Chart(ctx).Bar(data);
</script>
@stop