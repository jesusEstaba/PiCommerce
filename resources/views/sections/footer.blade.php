<div class="separator-fix-footer"></div>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-offset-3 col-md-6">
				@if($footer = HelperWebInfo::footer())
				{!!$footer!!}
				@endif
			</div>
			<div class="col-md-3">
				<div id="social3">
					<ul class="social-links clearfix">
						@if($facebook = HelperWebInfo::facebookLink())
							<li class="facebook">
								<a href="{{$facebook}}" title="Facebook" target="_blank">
									<i class="icon-facebook">
									</i>
								</a>
							</li>
						@endif

						@if($insta = HelperWebInfo::instagramLink())
							<li class="instagram">
								<a href="{{$insta}}" title="Instagram" target="_blank">
									<i class="icon-instagram">
									</i>
								</a>
							</li>
						@endif

						@if($twitter = HelperWebInfo::twitterlink())
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