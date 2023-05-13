<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>
	@yield('custom-css')
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("frontend/css/flaticon.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/icomoon.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/aos.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/ionicons.min.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/open-iconic-bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/bootstrap-datepicker.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/animate.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/jquery.timepicker.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("frontend/css/owl.theme.default.min.css")}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.css" integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
	{{-- Leaflet css --}}
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
    integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
    crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link type="text/css" href="{{asset("frontend/css/css/custom.css")}}">
	@yield('custom-css')
</head>
<body>
     <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="{{route('frontend.index')}}">Bus Booking</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item {{Request::routeIs('frontend.index') ? 'active':'';}}"><a href="{{route('frontend.index')}}" class="nav-link">Home</a></li>
	          <li class="nav-item {{Request::routeIs('frontend.about') ? 'active':'';}}"><a href="{{route('frontend.about')}}" class="nav-link">About</a></li>
			  @if(auth()->user())
				@if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('driver'))
				<li class="nav-item"><a href="{{url('/admin/dashboard')}}" class="nav-link">Dashboard</a></li>
				@endif
			  @endif
	          <li class="nav-item {{Request::routeIs('frontend.schedules') ? 'active':'';}}"><a href="{{route('frontend.schedules')}}" class="nav-link">Schedule</a></li>
			  @if(!auth()->user())
	          	<li class="nav-item"><a href="{{url('/contact')}}" class="nav-link">Contact Us</a></li>
			  @endif
			  @if (!auth()->user())
	          <li class="nav-item"><a href="{{url('/login')}}" class="nav-link">Login In</a></li>
			  @endif
			  @if(auth()->user())
				@if(auth()->user('user')||auth()->user()->hasRole('admin') || auth()->user()->hasRole('driver'))
					<li class="nav-item dropdown my-1">
								<button class="border-0" style="background-color: transparent !important;" type="button" id="dropdownMenuButton2"
									data-bs-toggle="dropdown" aria-expanded="false">
									<a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
										id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown"
										aria-expanded="false">
										<img class="img-account-profile rounded-circle mb-2"
											src="{{ auth()->user()->avatar == null? asset('/admin/upload/img/avatar.png'): asset('/admin/upload/img/' . Auth::user()->avatar) }}"
											alt="Avatar"
											style="width: 40px; height: 40px; object-fit: cover;" loading="lazy">
									</a>
								</button>
								<ul class="dropdown-menu active" aria-labelledby="navbarDropdownMenuLink">
									<li><a class="dropdown-item" href="{{url('/my-booking')}}">My Booking</a></li>
									<li><a class="dropdown-item" href="{{url('/edit-profile')}}">My Profile</a></li>
									<li><a class="dropdown-item" href="{{url('/change-password')}}">Change Password</a></li>
									<li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
								</ul>
							</li>
					@endif
				@endif
	        </ul>
	      </div>
	    </div>
	  </nav>
    @yield('content')
    {{-- Footer --}}
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Adventure</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
                <li class="ftco-animate"><a href="https://www.facebook.com/profile.php?id=100006769567504"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="https://www.instagram.com/xscottnguyen_/"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Information</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">About Us</a></li>
                <li><a href="#" class="py-2 d-block">Online enquiry</a></li>
                <li><a href="#" class="py-2 d-block">Call Us</a></li>
                <li><a href="#" class="py-2 d-block">General enquiries</a></li>
                <li><a href="#" class="py-2 d-block">Booking Conditions</a></li>
                <li><a href="#" class="py-2 d-block">Privacy and Policy</a></li>
                <li><a href="#" class="py-2 d-block">Refund policy</a></li>
              </ul>
            </div>
          </div>
          <!-- <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Experience</h2>
              <ul class="list-unstyled">
                <li><a href="#" class="py-2 d-block">Beach</a></li>
                <li><a href="#" class="py-2 d-block">Adventure</a></li>
                <li><a href="#" class="py-2 d-block">Wildlife</a></li>
                <li><a href="#" class="py-2 d-block">Honeymoon</a></li>
                <li><a href="#" class="py-2 d-block">Nature</a></li>
                <li><a href="#" class="py-2 d-block">Party</a></li>
              </ul>
            </div>
          </div> -->
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Pokhara, kaski, Nepal</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+977 9814141414</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">busbookingnepal@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> | This Website is made with <i class="icon-heart" aria-hidden="true"></i> apil lamsal
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
          </div>
        </div>
      </div>
    </footer>
    {{-- Leaftet map --}}
	<script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
    integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
    crossorigin=""></script>
    <script src="https://unpkg.com/leaflet.markercluster@1.3.0/dist/leaflet.markercluster.js"></script>
    <script src="https://unpkg.com/esri-leaflet@3.0.8/dist/esri-leaflet.js"
    integrity="sha512-E0DKVahIg0p1UHR2Kf9NX7x7TUewJb30mxkxEm2qOYTVJObgsAGpEol9F6iK6oefCbkJiA4/i6fnTHzM6H1kEA=="
    crossorigin=""></script>
	<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script src="{{asset("frontend/js/aos.js")}}"></script>
    <script src="{{asset("frontend/js/jquery.min.js")}}"></script>
    <script src="{{asset("frontend/js/popper.min.js")}}"></script>
    <script src="{{asset("frontend/js/jquery.easing.1.3.js")}}"></script>
    <script src="{{asset("frontend/js/jquery.waypoints.min.js")}}"></script>
    <script src="{{asset("frontend/js/jquery.magnific-popup.min.js")}}"></script>
    <script src="{{asset("frontend/js/jquery.stellar.min.js")}}"></script>
    <script src="{{asset("frontend/js/jquery-migrate-3.0.1.min.js")}}"></script>
    <script src="{{asset("frontend/js/jquery.animateNumber.min.js")}}"></script>
    <script src="{{asset("frontend/js/bootstrap-datepicker.js")}}"></script>
    <script src="{{asset("frontend/js/bootstrap.min.js")}}"></script>
    <script src="{{asset("frontend/js/scrollax.min.js")}}"></script>
    <script src="{{asset("frontend/js/owl.carousel.min.js")}}"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.6.1/nouislider.min.js" integrity="sha512-1mDhG//LAjM3pLXCJyaA+4c+h5qmMoTc7IuJyuNNPaakrWT9rVTxICK4tIizf7YwJsXgDC2JP74PGCc7qxLAHw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<!-- alert -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	{{-- Handle animate on scroll --}}
	<script>
				AOS.init({
			duration: 800,
			easing: "slide",
		});

		(function ($) {
			"use strict";

			var isMobile = {
				Android: function () {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function () {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function () {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function () {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function () {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function () {
					return (
						isMobile.Android() ||
						isMobile.BlackBerry() ||
						isMobile.iOS() ||
						isMobile.Opera() ||
						isMobile.Windows()
					);
				},
			};

			$(window).stellar({
				responsive: true,
				parallaxBackgrounds: true,
				parallaxElements: true,
				horizontalScrolling: false,
				hideDistantElements: false,
				scrollProperty: "scroll",
			});

			var fullHeight = function () {
				$(".js-fullheight").css("height", $(window).height());
				$(window).resize(function () {
					$(".js-fullheight").css("height", $(window).height());
				});
			};
			fullHeight();

			// loader
			var loader = function () {
				setTimeout(function () {
					if ($("#ftco-loader").length > 0) {
						$("#ftco-loader").removeClass("show");
					}
				}, 1);
			};
			loader();

			// Scrollax
			$.Scrollax();

			var carousel = function () {
				$(".carousel-testimony").owlCarousel({
					center: true,
					loop: true,
					items: 1,
					margin: 30,
					stagePadding: 0,
					nav: true,
					navText: [
						'<span class="ion-ios-arrow-back">',
						'<span class="ion-ios-arrow-forward">',
					],
					responsive: {
						0: {
							items: 1,
						},
						600: {
							items: 3,
						},
						1000: {
							items: 3,
						},
					},
				});

				$(".single-slider").owlCarousel({
					animateOut: "fadeOut",
					animateIn: "fadeIn",
					autoplay: true,
					loop: true,
					items: 1,
					margin: 0,
					stagePadding: 0,
					nav: true,
					dots: true,
					navText: [
						'<span class="ion-ios-arrow-back">',
						'<span class="ion-ios-arrow-forward">',
					],
					responsive: {
						0: {
							items: 1,
						},
						600: {
							items: 1,
						},
						1000: {
							items: 1,
						},
					},
				});
			};
			carousel();

			$("nav .dropdown").hover(
				function () {
					var $this = $(this);
					// 	 timer;
					// clearTimeout(timer);
					$this.addClass("show");
					$this.find("> a").attr("aria-expanded", true);
					// $this.find('.dropdown-menu').addClass('animated-fast fadeInUp show');
					$this.find(".dropdown-menu").addClass("show");
				},
				function () {
					var $this = $(this);
					// timer;
					// timer = setTimeout(function(){
					$this.removeClass("show");
					$this.find("> a").attr("aria-expanded", false);
					// $this.find('.dropdown-menu').removeClass('animated-fast fadeInUp show');
					$this.find(".dropdown-menu").removeClass("show");
					// }, 100);
				}
			);

			$("#dropdown04").on("show.bs.dropdown", function () {
				console.log("show");
			});

			// scroll
			var scrollWindow = function () {
				$(window).scroll(function () {
					var $w = $(this),
						st = $w.scrollTop(),
						navbar = $(".ftco_navbar"),
						sd = $(".js-scroll-wrap");

					if (st > 150) {
						if (!navbar.hasClass("scrolled")) {
							navbar.addClass("scrolled");
						}
					}
					if (st < 150) {
						if (navbar.hasClass("scrolled")) {
							navbar.removeClass("scrolled sleep");
						}
					}
					if (st > 350) {
						if (!navbar.hasClass("awake")) {
							navbar.addClass("awake");
						}

						if (sd.length > 0) {
							sd.addClass("sleep");
						}
					}
					if (st < 350) {
						if (navbar.hasClass("awake")) {
							navbar.removeClass("awake");
							navbar.addClass("sleep");
						}
						if (sd.length > 0) {
							sd.removeClass("sleep");
						}
					}
				});
			};
			scrollWindow();

			var isMobile = {
				Android: function () {
					return navigator.userAgent.match(/Android/i);
				},
				BlackBerry: function () {
					return navigator.userAgent.match(/BlackBerry/i);
				},
				iOS: function () {
					return navigator.userAgent.match(/iPhone|iPad|iPod/i);
				},
				Opera: function () {
					return navigator.userAgent.match(/Opera Mini/i);
				},
				Windows: function () {
					return navigator.userAgent.match(/IEMobile/i);
				},
				any: function () {
					return (
						isMobile.Android() ||
						isMobile.BlackBerry() ||
						isMobile.iOS() ||
						isMobile.Opera() ||
						isMobile.Windows()
					);
				},
			};

			var counter = function () {
				$("#section-counter").waypoint(
					function (direction) {
						if (
							direction === "down" &&
							!$(this.element).hasClass("ftco-animated")
						) {
							var comma_separator_number_step =
								$.animateNumber.numberStepFactories.separator(",");
							$(".number").each(function () {
								var $this = $(this),
									num = $this.data("number");
								console.log(num);
								$this.animateNumber(
									{
										number: num,
										numberStep: comma_separator_number_step,
									},
									7000
								);
							});
						}
					},
					{ offset: "95%" }
				);
			};
			counter();

			var contentWayPoint = function () {
				var i = 0;
				$(".ftco-animate").waypoint(
					function (direction) {
						if (
							direction === "down" &&
							!$(this.element).hasClass("ftco-animated")
						) {
							i++;

							$(this.element).addClass("item-animate");
							setTimeout(function () {
								$("body .ftco-animate.item-animate").each(function (k) {
									var el = $(this);
									setTimeout(
										function () {
											var effect = el.data("animate-effect");
											if (effect === "fadeIn") {
												el.addClass("fadeIn ftco-animated");
											} else if (effect === "fadeInLeft") {
												el.addClass("fadeInLeft ftco-animated");
											} else if (effect === "fadeInRight") {
												el.addClass(
													"fadeInRight ftco-animated"
												);
											} else {
												el.addClass("fadeInUp ftco-animated");
											}
											el.removeClass("item-animate");
										},
										k * 50,
										"easeInOutExpo"
									);
								});
							}, 100);
						}
					},
					{ offset: "95%" }
				);
			};
			contentWayPoint();

			// navigation
			var OnePageNav = function () {
				$(".smoothscroll[href^='#'], #ftco-nav ul li a[href^='#']").on(
					"click",
					function (e) {
						e.preventDefault();

						var hash = this.hash,
							navToggler = $(".navbar-toggler");
						$("html, body").animate(
							{
								scrollTop: $(hash).offset().top,
							},
							700,
							"easeInOutExpo",
							function () {
								window.location.hash = hash;
							}
						);

						if (navToggler.is(":visible")) {
							navToggler.click();
						}
					}
				);
				$("body").on("activate.bs.scrollspy", function () {
					console.log("nice");
				});
			};
			OnePageNav();

			// magnific popup
			$(".image-popup").magnificPopup({
				type: "image",
				closeOnContentClick: true,
				closeBtnInside: false,
				fixedContentPos: true,
				mainClass: "mfp-no-margins mfp-with-zoom", // class to remove default margin from left and right side
				gallery: {
					enabled: true,
					navigateByImgClick: true,
					preload: [0, 1], // Will preload 0 - before current, and 1 after the current image
				},
				image: {
					verticalFit: true,
				},
				zoom: {
					enabled: true,
					duration: 300, // don't foget to change the duration also in CSS
				},
			});

			$(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
				disableOn: 700,
				type: "iframe",
				mainClass: "mfp-fade",
				removalDelay: 160,
				preloader: false,

				fixedContentPos: false,
			});

			$(".checkin_date, .checkout_date").datepicker({
				format: "m/d/yyyy",
				autoclose: true,
			});
		})(jQuery);
	</script>

    @yield('scripts')
	
	<!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/62934e2db0d10b6f3e7496a7/1g47mip2o';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    <script>
    @if(session('status'))
            Swal.fire({
				type: 'success',
				text: "{{session('status')}}"
				});
	@elseif(session('error'))
			Swal.fire({
				type: 'warning',
				text: "{{session('error')}}"
			})
    @endif
    </script>
	<script>
		@if(Session::has('warning'))
					toastr.options = {
						"closeButton": true,
						"progressBar": true,
					}
					toastr.warning("{{session('warning')}}")
		@elseif (Session::has('success'))
					toastr.options = {
						"closeButton": true,
						"progressBar": true,
					}
					toastr.success("{{session('success')}}")
		@endif
	</script>
	
</body>
</html>