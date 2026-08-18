<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {!! $gtext['is_rtl'] == 1 ? 'dir="rtl"' : '' !!}>
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@php
	$PageVariation = PageVariation();
	$gtext = gtext();
	@endphp
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title')</title>
	@yield('meta-content')
	@if($gtext['fb_pixel_publish'] == 1)
	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '{{ $gtext["fb_pixel_id"] }}');
	  fbq('track', 'PageView');
	</script>
	<noscript>
	  <img height="1" width="1" style="display:none"
		   src="https://www.facebook.com/tr?id={{ $gtext['fb_pixel_id'] }}&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->
	@endif

	@if($gtext['ga_publish'] == 1)
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id={{ $gtext['tracking_id'] }}"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', '{{ $gtext["tracking_id"] }}');
	</script>
	@endif

	@if($gtext['gtm_publish'] == 1)
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','{{ $gtext["google_tag_manager_id"] }}');</script>
	<!-- End Google Tag Manager -->
	@endif
	<!--favicon-->
	<link rel="shortcut icon" href="{{ $gtext['favicon'] ? asset('public/media/'.$gtext['favicon']) : asset('public/backend/images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ $gtext['favicon'] ? asset('public/media/'.$gtext['favicon']) : asset('public/backend/images/favicon.ico') }}" type="image/x-icon">
	<!-- css -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&family=Spartan:wght@400;500;700;800;900&display=swap" rel="stylesheet">

	@if($gtext['is_rtl'] == 1)
	<link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="{{asset('public/frontend/css/bootstrap.rtl.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/rtl.css')}}" rel="stylesheet">
	@else
	<link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	@endif
	<link href="{{asset('public/frontend/css/bootstrap-icons.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/owl.carousel.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/magnific-popup.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/jquery-ui.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/slick.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/jquery.gritter.min.css')}}" rel="stylesheet">

	<style type="text/css">
	:root {
	  --theme-color: {{ $gtext['theme_color'] }};
	  --color-green: {{ $gtext['green_color'] }};
	  --color-light-green: {{ $gtext['light_green_color'] }};
	  --color-lightness-green: {{ $gtext['lightness_green_color'] }};
	  --color-gray: {{ $gtext['gray_color'] }};
	  --color-gray-dark: {{ $gtext['dark_gray_color'] }};
	  --color-gray-400: {{ $gtext['light_gray_color'] }};
	  --color-black: {{ $gtext['black_color'] }};
	  --color-white: {{ $gtext['white_color'] }};

	  --primary-font-family: 'Roboto', sans-serif;
	  --secondary-font-family: 'Spartan', sans-serif;
	  --arabic-font-family: 'Noto Kufi Arabic', sans-serif;
	  --font-size-100: 14px;
	  --font-size-200: 16px;
	  --font-size-300: 18px;
	  --font-size-400: 20px;
	  --font-size-500: 25px;
	  --font-size-600: 30px;
	  --font-size-700: 35px;
	  --font-size-800: 40px;
	  --font-size-900: 65px;
	  --heading-1: 40px;
	  --heading-2: 35px;
	  --heading-3: 28px;
	  --heading-4: 22px;
	  --heading-5: 18px;
	  --heading-6: 16px;
	  --line-height-100: 1;
	  --line-height-200: 1.5;
	}
	</style>
	<link href="{{asset('public/frontend/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	@stack('style')
	@if($gtext['custom_css'] != '')
	<style type="text/css">
	@php echo $gtext['custom_css']; @endphp
	</style>
	@endif
</head>
<body {!! $gtext['is_rtl'] == 1 ? 'class="rtl"' : '' !!}>
	@if($gtext['gtm_publish'] == 1)
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtext['google_tag_manager_id'] }}"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	@endif
	<!--loader-->
	<!-- <div class="tw-loader">
		<div class="tw-ellipsis">
			<div></div><div></div><div></div><div></div>
		</div>
	</div> -->
	<!--/loader/-->
	<!-- scrollToTop -->
	<a href="#top" class="scroll-to-top">
		<i class="bi bi-arrow-up"></i>
	</a>
	<!-- /scrollToTop -->

	@if($PageVariation['home_variation'] == 'home_3')
	<div class="container {{ $PageVariation['home_variation'] }}">
	@yield('header')
	@yield('content')
	@include('frontend.partials.footer')
	</div>
	@else
	@yield('header')
	@yield('content')
	@include('frontend.partials.footer')
	@endif

	@if($gtext['is_publish_cookie_consent'] == 1)
	<div class="cookie_consent_card {{ $gtext['cookie_style'] }} {{ $gtext['cookie_position'] }}">
		@if($gtext['cookie_title'] != '')
		<h4 class="cookie_consent_head">{{ $gtext['cookie_title'] }} </h4>
		@endif
		@if($gtext['cookie_message'] != '')
		<div class="cookie_consent_text">{{ $gtext['cookie_message'] }}
			@if($gtext['learn_more_text'] != '')
			<a href="{{ $gtext['learn_more_url'] }}">{{ $gtext['learn_more_text'] }}</a>
			@endif
		</div>
		@endif
		@if($gtext['button_text'] != '')
		<button class="btn accept_btn">{{ $gtext['button_text'] }}</button>
		@endif
	</div>
	@endif

	<!-- js -->
	<script src="{{ asset('public/frontend/js/jquery-3.6.0.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/popper.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery.countdown.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/scrolltop.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery.magnific-popup.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/slick.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery.popupoverlay.min.js') }}"></script>
	<script src="{{ asset('public/frontend/js/jquery.gritter.min.js') }}"></script>
	<script>
		var is_rtl = "{{ $gtext['is_rtl'] }}";
		if(is_rtl == 1){
			var isRTL = true;
		}else{
			var isRTL = false;
		}

		var theme_color = "{{ $gtext['theme_color'] }}";
		var base_url = "{{ url('/') }}";
		var public_path = "{{ asset('public') }}";

		//Cookie Consent
		var is_publish_cookie_consent = "{{ $gtext['is_publish_cookie_consent'] }}";
		if(is_publish_cookie_consent == 1){
			let cookieModal = document.querySelector(".cookie_consent_card");
			let acceptCookieBtn = document.querySelector(".accept_btn");

			acceptCookieBtn.addEventListener("click", function (){
				cookieModal.classList.remove("active");
				localStorage.setItem("cookie_consent", 1);
			});

			let cookieAccepted = localStorage.getItem("cookie_consent");
			if (cookieAccepted == 1){
				cookieModal.classList.remove("active");
			}else{
				cookieModal.classList.add("active");
			}
		}
	</script>
	<script src="{{ asset('public/frontend/js/scripts.js')}}"></script>
	<script src="{{asset('public/frontend/pages/cart.js')}}?v={{ time() }}"></script>
	<!-- Universal Quick Variation Selection Modal -->
	<div class="modal fade" id="quickVariationModal" tabindex="-1" aria-labelledby="quickVariationModalLabel" aria-hidden="true" style="z-index: 99999;">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
				<div class="modal-header" style="background: #f8f9fa; border-bottom: 1px solid #eee;">
					<h5 class="modal-title font-weight-bold" id="quickVariationModalLabel" style="font-size: 16px; color: #333;">
						{{ __('Select Options / পছন্দ করুন') }}
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
				</div>
				<div class="modal-body p-4">
					<!-- Product Header Info -->
					<div class="d-flex align-items-center mb-3 pb-3 border-bottom">
						<img id="modal_product_img" src="" alt="product" style="width: 65px; height: 65px; object-fit: cover; border-radius: 8px; margin-right: 15px; border: 1px solid #eee;" />
						<div>
							<h6 id="modal_product_title" class="mb-1 font-weight-bold" style="font-size: 15px; color: #222;"></h6>
							<div class="d-flex align-items-center">
								<span id="modal_product_price" class="text-success font-weight-bold" style="font-size: 18px;"></span>
								<span id="modal_product_old_price" class="text-muted text-decoration-line-through ml-2 ms-2" style="font-size: 14px; display: none;"></span>
							</div>
						</div>
					</div>

					<input type="hidden" id="modal_product_id" value="" />
					<input type="hidden" id="modal_selected_variant_id" value="" />
					<input type="hidden" id="modal_selected_size" value="" />
					<input type="hidden" id="modal_selected_color" value="" />

					<!-- Size Options Group -->
					<div class="mb-3" id="modal_size_group" style="display: none;">
						<label class="font-weight-bold d-block mb-2" style="font-size: 13px; color: #555;">{{ __('Size / পরিমাপ:') }}</label>
						<div class="d-flex flex-wrap gap-2" id="modal_size_container" style="gap: 8px;"></div>
					</div>

					<!-- Quality / GSM / Color Options Group -->
					<div class="mb-3" id="modal_color_group" style="display: none;">
						<label class="font-weight-bold d-block mb-2" style="font-size: 13px; color: #555;">{{ __('Quality / GSM / Color:') }}</label>
						<div class="d-flex flex-wrap gap-2" id="modal_color_container" style="gap: 8px;"></div>
					</div>

					<!-- Quantity -->
					<div class="d-flex align-items-center mt-3 pt-2">
						<label class="font-weight-bold m-0 mr-3 me-3" style="font-size: 13px; color: #555;">{{ __('Quantity:') }}</label>
						<div class="input-group" style="width: 120px;">
							<button class="btn btn-outline-secondary btn-sm" type="button" id="modal_qty_minus" style="padding: 2px 10px;">-</button>
							<input type="number" id="modal_qty" class="form-control text-center form-control-sm" value="1" min="1" readonly style="background: #fff;" />
							<button class="btn btn-outline-secondary btn-sm" type="button" id="modal_qty_plus" style="padding: 2px 10px;">+</button>
						</div>
					</div>
				</div>
				<div class="modal-footer" style="background: #f8f9fa; border-top: 1px solid #eee;">
					<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal" id="modal_cancel_btn">{{ __('Cancel') }}</button>
					<button type="button" class="btn theme-btn btn-sm font-weight-bold" id="modal_confirm_add_to_cart" style="background: #28a745; color: #fff; border: none; padding: 8px 20px; border-radius: 6px;">
						<i class="bi bi-cart-plus mr-1 me-1"></i> {{ __('Add to Cart / কার্টে যোগ করুন') }}
					</button>
				</div>
			</div>
		</div>
	</div>

	<style>
		.modal_variation_pill {
			border: 1.5px solid #d0d7de;
			padding: 6px 14px;
			cursor: pointer;
			border-radius: 6px;
			font-size: 13px;
			font-weight: 500;
			background: #fff;
			color: #333;
			transition: all 0.2s ease-in-out;
			user-select: none;
		}
		.modal_variation_pill:hover {
			border-color: #28a745;
			background: #f4faf6;
		}
		.modal_variation_pill.active {
			border-color: #28a745 !important;
			background: #28a745 !important;
			color: #fff !important;
			box-shadow: 0 2px 6px rgba(40,167,69,0.3);
		}
	</style>

	<div class="custom-popup light width-100 dnone" id="lightCustomModal">
		<div class="padding-md">
			<h4 class="m-top-none"></h4>
		</div>
		<div class="text-center">
			<a href="javascript:void(0);" class="btn blue-btn lightCustomModal_close mr-10" onClick="onConfirm()">{{ __('Confirm') }}</a>
			<a href="javascript:void(0);" class="btn danger-btn lightCustomModal_close">{{ __('Cancel') }}</a>
		</div>
	</div>
	<a href="#lightCustomModal" class="btn btn-warning btn-small lightCustomModal_open dnone">{{ __('Edit') }}</a>
	@stack('scripts')
	@if($gtext['custom_js'] != '')
	<script>
	@php echo $gtext['custom_js']; @endphp
	</script>
	@endif
</body>
</html>
