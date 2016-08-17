<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title')</title>
	
	@include('sections.headersCommon')

	{!!Html::style('css/main.css')!!}
	{!!Html::script('assets/jquery/jquery.min.js')!!}
	<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>

	<style type="text/css">
		h2.title{
			padding-top: 1.2em;
		}

		@media (max-width: 767px){
			nav{
				position: fixed;
				width: 100%;
				z-index: 100;
				left: 0;
				top: 0;
			}
			.image-category{
				margin-top: 65px;
			}
		}

		@media (min-width: 768px){
			.sticky {
				left: 0;
				position: fixed;
				top: 0;
				width: 100%;
				z-index: 99;
			}
			.sticky+.container{
				margin-top: 63px;
			}
		}
	</style>

</head>
<body>
	<nav>
		<div class="container">
			<div class="dropdown">

				<a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default btn-infosite visible-xs-inline-block">
					<span class="glyphicon glyphicon-menu-hamburger"></span>
				</a>

				<ul class="dropdown-menu" aria-labelledby="dLabel">
					<li role="presentation">
						<a role="menuitem" tabindex="-1" href="{{url('/menu')}}">Home</a>
					</li>

					@if(Auth::check())
						<li role="presentation">
							<a role="menuitem" tabindex="-1" href="{{url('account')}}">
								My Account
							</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1" href="{{url('logout')}}">
								Logout
							</a>
						</li>
					@endif

					<hr>

					@if($categoryList = HelperMenu::categoryList())
						@foreach($categoryList as $array => $category)
							<li role="presentation">
								<a role="menuitem" tabindex="-1" href="{{url('category/'.$category->url)}}">{{$category->name}}</a>
							</li>
						@endforeach
					@endif

				</ul>

			<a href="{{url('/menu')}}" class="btn btn-infosite btn-info hidden-xs"><span class="glyphicon glyphicon-home"></span> Home</a>


			<a href="{{url('menu')}}">
				@if($logo = HelperWebInfo::logo())
					<img src="{{asset('images/logos/'.$logo)}}" alt="logo" class="logo">
				@endif
			</a>

			@if( Auth::check() )
				<a class="btn btn-warning btn-cart" href="{{url('cart')}}">
					<span class="glyphicon glyphicon-shopping-cart"></span>
					<span>
						$<span class="total-in_cart">{{HelperMenu::totalInCart()}}</span>
					</span>
				</a>
				<a style="margin-right: .3em;" class="btn btn-default btn-cart hidden-xs" href="{{url('logout')}}">
					Logout
				</a>
				<a style="margin-right: .3em;" class="btn btn-primary btn-cart hidden-xs" href="{{url('account')}}">
					My Account
				</a>
			@else
				<a href="{{url('login')}}" class="btn btn-default btn-cart">Login</a>
			@endif
		</div>
	</nav>


	@yield('content')

	@include('sections.footer')
	<script type="text/javascript">

		$(document).ready(function() {
			if ($('.nav').length) {
				var stickyNavTop = $('.nav').offset().top;

				var stickyNav = function() {
					var scrollTop = $(window).scrollTop();

					if (scrollTop > stickyNavTop) {
						$('.nav').addClass('sticky');
					} else {
						$('.nav').removeClass('sticky');
					}

				};

				stickyNav();

				$(window).scroll(function() {
					stickyNav();
				});
			}
		});
	</script>
</body>
</html>