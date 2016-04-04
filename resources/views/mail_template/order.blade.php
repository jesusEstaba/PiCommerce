<!--
Template Name: Aero
Template URI: http://themeforest.net/item/vince-responsive-email-template/5488963
Description: Simple and clean Business template.
Author: nutzumi
Author URI: http://themeforest.net/user/nutzumi/portfolio
Version: 1.0
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
		<title>{subject}</title>
	</head>
	<body>
		<style type="text/css">
		.ReadMsgBody { width: 100%; background-color: #ffffff; }
		.ExternalClass { width: 100%; background-color: #ffffff; }
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
		html { width: 100%; }
		body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
		table { border-spacing: 0; border-collapse: collapse; table-layout: fixed; margin:0 auto; }
		table table table { table-layout: auto; }
		img { display: block !important; over-flow: hidden !important; }
		table td { border-collapse: collapse; }
		.yshortcuts a { border-bottom: none !important; }
		a { color: #17733a; text-decoration: none; }
		.textbutton a { font-family: 'open sans', arial, sans-serif !important; color: #ffffff !important; }
		.footer-link a { color: #979797 !important; }
		/*Responsive*/
		@media only screen and (max-width: 640px) {
		body { width: auto !important; }
		table[class="table600"] { width: 450px !important; }
		table[class="table-inner"] { width: 90% !important; }
		table[class="table2-2"] { width: 47% !important; text-align: left !important; }
		table[class="table3-3"] { width: 100% !important; text-align: center !important; }
		table[class="table1-3"] { width: 29% !important; }
		table[class="table3-1"] { width: 64% !important; text-align: left !important; }
		td[class="header-td"] { height: 50px !important; max-height: 50px !important; line-height: 0px !important; }
		td[class="td-hide"] { height: 0px !important; max-height: 0px !important; line-height: 0px !important; }
		/* Image */
		img[class="img1"] { width: 100% !important; height: auto !important; }
		}
		@media only screen and (max-width: 479px) {
		body { width: auto !important; }
		table[class="table600"] { width: 290px !important; }
		table[class="table-inner"] { width: 82% !important; }
		table[class="table2-2"] { width: 100% !important; text-align: center !important; }
		table[class="table3-3"] { width: 100% !important; text-align: center !important; }
		table[class="table1-3"] { width: 100% !important; }
		table[class="table3-1"] { width: 100% !important; text-align: center !important; }
		td[class="header-td"] { height: 50px !important; max-height: 50px !important; line-height: 0px !important; }
		td[class="td-hide"] { height: 0px !important; max-height: 0px !important; line-height: 0px !important; }
		/* image */
		img[class="img1"] { width: 100% !important; }
		}
		/*hide preheader by deafult */
		div.preheader{line-height:0px;font-size:0px;height:0px;display:none !important;display:none;visibility:hidden;}
		</style>
		<div class="preheader">{preheader}</div>
		<!-- header bar -->
		<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff" style="border-top:3px solid #17733a;">
			<tr>
				<td align="center">
					<table bgcolor="#FFFFFF" class="table600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
						<tr>
							<td height="35"></td>
						</tr>
						<tr>
							<td>
								<table align="left" class="table3-3" width="130" border="0" cellspacing="0" cellpadding="0">
									<!-- logo -->
									<tr>
										<td align="center" valign="middle" style="line-height:0px;">
											<img editable label="logo" style="display:block; font-size:0px; line-height:0px; border:0px;" src="img/logo.png" width="89" height="21" alt="img" />
										</td>
									</tr>
									<!-- end logo -->
								</table>
								<!--Space-->
								<table width="1" height="20" border="0" cellpadding="0" cellspacing="0" align="left">
									<tr>
										<td height="20" style="font-size: 0;line-height: 0;border-collapse: collapse;">
											<p style="padding-left: 24px;">&nbsp;</p>
										</td>
									</tr>
								</table>
								<!--End Space-->
								<table class="table3-3" align="right" border="0" cellspacing="0" cellpadding="0">
									<!-- menu -->
									<tr>
										<td align="center">
											<table class="table-inner" width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td class="footer-link" align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#7f8c8d; font-size:13px; line-height:28px;padding-left: 15px;padding-right: 15px;">
														<a href="#"><single label="menu">Menu</single></a>
													</td>
													<td class="footer-link" align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#7f8c8d; font-size:13px; line-height:28px;padding-left: 15px;padding-right: 15px;">
														<a href="#"><single label="menu">About us</single></a>
													</td>
													<td align="center">
														<table class="footer-link" style="border-radius:20px;" bgcolor="#e8e8e8" border="0" align="center" cellpadding="0" cellspacing="0">
															<tr>
																<td align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#7f8c8d; font-size:13px; line-height:28px;padding-left: 15px;padding-right: 15px;">
																	<a href="#" editable label="button">Contact</a>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<!-- end menu -->
								</table>
							</td>
						</tr>
						<tr>
							<td height="25"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- end header bar -->
		<!-- Header -->
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
			<tr>
				<td align="center" bgcolor="#3b3b3b" background="img/header-bg.jpg" style="background-size:cover; background-position:center;">
					<table align="center" class="table600" width="600" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td align="center" background="img/header-fade.png" style="background-repeat:repeat;">
								<table width="550" class="table-inner" border="0" align="center" cellpadding="0" cellspacing="0">
									<tr>
										<td height="95" class="header-td"></td>
									</tr>
									<!-- Head-line -->
									<tr>
										<td align="center" style="font-family: century gothic, open sans, arial; font-size:44px; font-weight: 100; color:#FFFFFF; line-height:auto;">
											<multi label="Headline">
											<span style="font-weight: bold; color:#17733a;">Digino's</span>
											</multi>
										</td>
									</tr>
									<!-- end Head-line -->
									<tr>
										<td height="5"></td>
									</tr>
									<!-- slogan -->
									<tr>
										<td align="center" style="font-family: century gothic, open sans, arial; font-size:13px; color:#FFFFFF; letter-spacing:3px; line-height:26px;"><multi label="slogan">WHERE THE FOOD’S THE STAR.</multi></td>
									</tr>
									<!-- end slogan-->
									<tr>
										<td height="15"></td>
									</tr>
									<!-- button -->
									<tr>
										<td align="center">
											<table class="textbutton" style="border-radius:20px;" bgcolor="#17733a" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td height="40" align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#7f8c8d; font-size:13px; line-height:28px; font-weight: bold; padding-left: 20px;padding-right: 20px;">
														<a href="#" editable label="button">RESERVE NOW</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<!-- end button -->
									<tr>
										<td height="60"></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- end header -->
		<!-- 1/1 Content -->
	<div>
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
									<span class="pull-right">${{$campo->Sz_Price}}</span>
								</div>
							</div>							
							
						</h4>
						
						<div class="row">
							<div class="col-xs-10 col-xs-offset-2">
								<?php //$total_price_top = 0;?>
								@foreach($campo->toppings_list as $tab => $val)
									<?php
									if($val->size==1)
										$size_topping = "";
									elseif($val->size==2)
										$size_topping = " [left]";
									elseif($val->size==3)
										$size_topping = " [rigth]";
									elseif($val->size==4)
										$size_topping = " [extra]";
									elseif($val->size==5)
										$size_topping = " [lite]";
									else
										$size_topping = "";
									?>

									<h5 class="text-muted">
										<span><b>{{strtolower($val->Tp_Descrip).$size_topping}}</b></span>
										<span class="pull-right">
											@if($val->price > 0)
												${{$val->price}}
											@endif
										</span>
									</h5>
									<?php //$total_price_top += $val->price;?>

								@endforeach
	</div>
		<!-- end 1/1 Content -->
		
		<!-- footer -->
		<table bgcolor="#FFFFFF" align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td height="60"></td>
			</tr>
			<tr>
				<td style="border-top:4px solid #17733a;" bgcolor="#3b3b3b" align="center">
					<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="table600">
						<tr>
							<td>
								<!-- left -->
								<table class="table3-3" width="166" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40"></td>
									</tr>
									<!-- title -->
									<tr>
										<td align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#ffffff; font-size:20px; font-weight: bold; line-height:28px;">
											<single label="title">About us</single>
										</td>
									</tr>
									<!-- end title -->
									<tr>
										<td height="10"></td>
									</tr>
									<!-- content -->
									<tr>
										<td class="footer-link" align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#979797; font-size:13px; line-height:28px;">
											<a href="#">
												<single label="link">Company</single>
											</a>
											<br />
											<a href="#">
												<single label="link">Our Team</single>
											</a>
											<br />
											<a href="#">
												<single label="link">Testimonials</single>
											</a>
										</td>
									</tr>
									<!-- end content -->
								</table>
								<!-- end left -->
								<!--Space-->
								<table width="1" height="25" border="0" cellpadding="0" cellspacing="0" align="left">
									<tr>
										<td height="25" style="font-size: 0;line-height: 0;border-collapse: collapse;">
											<p style="padding-left: 24px;">&nbsp;</p>
										</td>
									</tr>
								</table>
								<!--End Space-->
								<!-- middle -->
								<table class="table3-3" width="166" border="0" align="left" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40"></td>
									</tr>
									<!-- title -->
									<tr>
										<td align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#ffffff; font-size:20px; font-weight: bold; line-height:28px;">
											<single label="title">Preference</single>
										</td>
									</tr>
									<!-- end title -->
									<tr>
										<td height="10"></td>
									</tr>
									<!-- content -->
									<tr>
										<td class="footer-link" align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#979797; font-size:13px; line-height:28px;">
											<a href="#">{webversion}</a>
											<br />
											<a href="#">{unsub}</a>
											<br />
											<a href="#">{forward}</a>
										</td>
									</tr>
									<!-- end content -->
								</table>
								<!-- end middle -->
								<!--Space-->
								<table width="1" height="25" border="0" cellpadding="0" cellspacing="0" align="left">
									<tr>
										<td height="25" style="font-size: 0;line-height: 0;border-collapse: collapse;">
											<p style="padding-left: 24px;">&nbsp;</p>
										</td>
									</tr>
								</table>
								<!--End Space-->
								<!-- right -->
								<table class="table3-3" bgcolor="#4a4a4a" width="217" border="0" align="right" cellpadding="0" cellspacing="0">
									<tr>
										<td height="40"></td>
									</tr>
									<!-- logo -->
									<tr>
										<td align="center" valign="bottom" style="line-height:0px;">
											<img editable label="logo" style="display:block; line-height:0px; font-size:0px; border:0px;" src="img/footer-logo.png" width="89" height="21" alt="img" />
										</td>
									</tr>
									<!-- end logo -->
									<tr>
										<td height="10"></td>
									</tr>
									<!-- content -->
									<tr>
										<td align="center" style="font-family: 'Open Sans', Arial, sans-serif; color:#ffffff; font-size:13px; line-height:28px;">
											<multi label="content">
											121 King Street, Melbourne
											<br />
											Victoria 3000 Australia
											</multi>
										</td>
									</tr>
									<!-- end content -->
									<tr>
										<td height="10"></td>
									</tr>
									<!-- social -->
									<tr>
										<td align="center">
											<table width="130" border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td width="25" align="center" style="line-height:0px">
														<a href="#" editable label="social">
															<img src="img/social/facebook.png" width="26" height="26" alt="img" />
														</a>
													</td>
													<td width="10"></td>
													<td width="25" align="center" style="line-height:0px">
														<a href="#" editable label="social">
															<img src="img/social/twitter.png" width="26" height="26" alt="img" />
														</a>
													</td>
													<td width="10"></td>
													<td width="25" align="center" style="line-height:0px">
														<a href="#" editable label="social">
															<img src="img/social/linkedin.png" width="26" height="26" alt="img" />
														</a>
													</td>
													<td width="10"></td>
													<td width="25" align="center" style="line-height:0px">
														<a href="#" editable label="social">
															<img src="img/social/googleplus.png" width="26" height="26" alt="img" />
														</a>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<!-- end social -->
									<tr>
										<td height="45"></td>
									</tr>
								</table>
								<!-- end right -->
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- end footer -->
	</body>
</html>