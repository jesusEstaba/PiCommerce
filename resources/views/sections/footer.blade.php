<div class="separator-fix-footer"></div>

<?php

	$gplus = '';
	$facebook = DB::table('config')
		->where('Cfg_Descript', 'facebook')
		->first()
		->Cfg_Message;
	$insta = DB::table('config')
		->where('Cfg_Descript', 'instagram')
		->first()
		->Cfg_Message;
	$twitter = DB::table('config')
		->where('Cfg_Descript', 'twitter')
		->first()
		->Cfg_Message;

	$footer = DB::table('config')
		->where('Cfg_Descript', 'footer')
		->first()
		->Cfg_Message;
?>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6">
				@if($footer)
				{!!$footer!!}
				@endif
			</div>
			<div class="col-md-3">

				{!!Html::style('css/style_techandall.css')!!}
				<link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

				<style type="text/css">
				.social-links a{
					color: white !important;
					border-color: white !important;
				}
				#social3{
					margin-top: 5px;

				}
				#social3 a{
					width: 40px;
					height: 40px;
					font-size: 1.5em;
				}
				.facebook a:hover{
					border-color:#3b5a9b !important;
				}
				.googleplus a:hover{
				border-color:#f63d26 !important;
				}
				.instagram a:hover{
				border-color:#507ea4 !important;
				}
				.twitter a:hover{
				border-color:#2baae1 !important;
				}
				</style>

				<div id="social3">
					<ul class="social-links clearfix">
						
						@if($facebook)
						<li class="facebook">
							<a href="{{$facebook}}" title="Facebook" target="_blank">
								<i class="icon-facebook">
								</i>
							</a>
						</li>
						@endif
						
						@if($gplus)
						<li class="googleplus">
							<a href="{{$gplus}}" title="Google+" target="_blank">
								<i class="icon-google-plus">
								</i>
							</a>
						</li>
						@endif
						
						@if($insta)
						<li class="instagram">
							<a href="{{$insta}}" title="Instagram" target="_blank">
								<i class="icon-instagram">
								</i>
							</a>
						</li>
						@endif
						
						@if($twitter)
						<li class="twitter">
							<a href="{{$twitter}}" title="Twitter" target="_blank">
								<i class="icon-twitter">
								</i>
							</a>
						</li>
						@endif
					</ul
					>
				</div>
			</div>
		</div>
	</div>
</footer>