<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>{{$title}}</title>
	<style type="text/css">
		/*#17723A VERDE*/
		/*#D41F26 ROJO*/
		*{
			font-family: Helvetica;
			color: #000000;
		}
		h1, h2, h3, h4, h5{
			color: #000 !important;
		}
		body{
			margin: 0;
			padding: 0;
		}
		header{

		}
		header>img{
			display: block;
			margin-left: auto;
			margin-right: auto;
			height: 100px;
			max-width: 100%;
			margin-bottom: 1em;
			margin-top: 1em;
		}
		nav{
			box-shadow: 0 -2px 4px rgba(0,0,0,.26);
			background: #D41F26;
			height: 50px;
		}
		section{
			min-height: 400px;
			background: #eee;
		}
		article{
			min-height: 200px;
			max-width: 800px;
			background: white;
			margin-left: auto;
			margin-right: auto;
			box-shadow: 0 2px 5px rgba(0,0,0,.26);
			padding: 1em;
		}
		footer{
			background: #17723A;
			min-height: 100px;
			box-shadow: 0 2px 4px rgba(0,0,0,.26);
		}
		footer>div>p{
			margin: 0;
			color: #ffffff !important;
			padding-top: 1em;
			margin-left: auto;
			margin-right: auto;
			max-width: 800px;
			text-align: center;
		}
		footer>div a{
			text-decoration: none !important;
			color: #ECC704 !important;
		}
		/*ul{
			padding-left: 2.8em;
			list-style: none;
			padding-top: .2em;
		}*/
		aside{
			margin-bottom: 3em;
		}













table {
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    min-width: 100%;
    border-spacing: 0px 0px;
    font: normal normal normal normal 14px / 20px 'Source Sans Pro', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    margin: 0px 0px 20px;
    outline: rgb(51, 51, 51) none 0px;
}

thead {
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    border: 0px none rgb(128, 128, 128);
    outline: rgb(51, 51, 51) none 0px;
}

thead>tr{
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    vertical-align: middle;
    border: 0px none rgb(128, 128, 128);
    outline: rgb(51, 51, 51) none 0px;
}

thead>tr>th {
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    text-align: left;
    vertical-align: bottom;
    border-top: 0px none rgb(51, 51, 51);
    border-right: 0px none rgb(51, 51, 51);
    border-bottom: 2px solid rgb(244, 244, 244);
    border-left: 0px none rgb(51, 51, 51);
    outline: rgb(51, 51, 51) none 0px;
    padding: 8px;
}



tbody {
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    border: 0px none rgb(128, 128, 128);
    outline: rgb(51, 51, 51) none 0px;
}

tbody>tr {
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    vertical-align: middle;
    /*background: rgb(249, 249, 249) none repeat scroll 0% 0% / auto padding-box border-box;*/
    border: 0px none rgb(128, 128, 128);
    outline: rgb(51, 51, 51) none 0px;
}

tbody tr:nth-child(odd)
{
	background: #F9F9F9;
}

tbody>tr>td {
    border-collapse: collapse;
    box-sizing: border-box;
    color: rgb(51, 51, 51);
    vertical-align: top;
    border-top: 1px solid rgb(244, 244, 244);
    border-right: 0px none rgb(51, 51, 51);
    border-bottom: 0px none rgb(51, 51, 51);
    border-left: 0px none rgb(51, 51, 51);
    outline: rgb(51, 51, 51) none 0px;
    padding: 8px;
}




article>aside+table+aside>div{
	width: 350px;
	min-height: 20px;
	display: inline-block;
	padding: 1em;
	overflow: hidden;
}
article>aside+table+aside>div>div{
	padding: 2px;
	background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 3px;
    color: #777;
}


article>aside+table+aside>div+div{
	width: 350px;
	display: inline-block;
}
article>aside+table+aside>div+div>p{
	border-top: 1px solid #F9F9F9;
	margin: 0;
	padding-top: .5em;
	margin-bottom: .3em;
	padding-left: 1em;
}


/*
article>aside+table+aside>div+div h4{
	border-top: 1px solid #F9F9F9;
	margin: 0;
	margin-top: 1em;
	margin-bottom: .5em;
}


article>aside+table+aside>div+div h3{
	border-top: 1px solid #F9F9F9;
	margin: 0;
	margin-top: .5em;
	margin-bottom: .5em;
}*/
article>aside>div>span{
	float: right;
}

article>aside>div+div, article>aside>div+div+div{
	width: 350px;
	display: inline-block;
}
hr{
	border:0;
	border-bottom: 1px solid #eee;
}
ul{
	list-style: none;
}

ul>li{
	color: #757575;
}

ul>li>span{
	color: #bbb;
}

 @media only screen and (max-width: 800px){
	article>aside div,article>aside+table+aside div{
		display: block;
		min-width: 100%;
	}
}






	</style>
</head>
<body>
	<div>
		<header>
			<img src="{{asset('images/logos/'.$logo)}}" alt="Logo">
		</header>
		
		<nav>
			
		</nav>
		
		<section>
			
			<article>
				<aside>
					<div>
							<b>Order Id: </b>{{$num_order}}
							<span>{{$now}}</span>
					</div>
					<hr>

					<div>
						<p>
						<b>Name:</b> {{$name}}
					</p>
					<p>
						<b>Phone:</b> {{$phone}}
					</p>
					<p>
						<b>Email:</b> {{$email}}
					</p>
					</div>
					
					@if($delivery)
					<div>
						<p>
									<b>Street #: </b>{{$street_num}}
								</p>
								<p>
									<b>Street Name: </b>{{$street_name}}
								</p>
								<p>
									<b>Zip Code: </b>{{$zip_code}}
								</p>
					</div>
						

					@endif
				</aside>

				<table>
					<thead>
						<tr>
							<th>
								Qty
							</th>
							<th>
								Product
							</th>
							<th>
								Cooking Description
							</th>
							<th>
								Subtotal
							</th>
						</tr>
					</thead>
					<tbody>
					
						@foreach($cart as $array => $campo)
						<tr>
							<td>
								{{ $campo->quantity }}
							</td>
							<td>
								{{$campo->It_Descrip or $campo->Sz_Abrev}}
								<?php $total_price_top = 0;?>
								@if( count($campo->toppings_list) )
								<ul>
									@foreach($campo->toppings_list as $tab => $val)
									<li>
										{{strtolower($val->Tp_Descrip)}} <span>{{$size($val->size)}}</span>
									</li>
									<?php $total_price_top += $val->price;?>
									@endforeach
								</ul>
								@endif
							</td>
							<td>
								{{ $campo->cooking_instructions }}
							</td>
							<td>
								${{ number_format( ( $campo->Sz_Price + $total_price_top ) * $campo->quantity , 2) }}
							</td>

						</tr>
						@endforeach
					</tbody>
				</table>
				<aside>
					<div>
						<div>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sit amet felis ac libero iaculis tempor non ac tortor. Proin vestibulum laoreet placerat. Nullam vestibulum ac purus nec rutrum.	
						</div>
						 
					</div>
					<div>
						
							<p><b>Sub Total:</b> ${{ number_format($order->Hd_Subtotal, 2) }}</p>
							
							@if($discount)
								<p><b>Discount:</b> ${{ number_format($order->Hd_Discount, 2) }}</p>
							@endif

							<p><b>Tax:</b> ${{ number_format($order->Hd_Tax, 2) }}</p>
							
							@if($charge)
								<p><b>Charge:</b> ${{ number_format($order->Hd_Charge, 2) }}</p>
							@endif
							
							@if($tip)
							<p><b>Tips:</b> ${{ number_format($order->Hd_Tips, 2) }}</p>
							@endif
							@if($delivery)
							<p><b>Delivery:</b> ${{ number_format( $order->Hd_Delivery, 2) }}</p>
							@endif
							<p><b>Total:</b> ${{ number_format($order->Hd_Total, 2) }}</p>
						
					</div>
				</aside>
				
			</article>
		</section>
		<footer>
			<div>
				{!!$footer!!}
			</div>
			
		</footer>
	</div>
</body>
</html>