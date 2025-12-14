<!-- Home Slider -->
<!-- @if($section1->is_publish == 1)
	<section class="slider-section">
		<div class="home-slider owl-carousel">

			@foreach ($slider as $row)
			@php $aRow = json_decode($row->desc); @endphp
			<div class="single-slider">
				<div class="slider-screen h1-height" style="background-image: url({{ asset('public/media/'.$row->image) }});">
					<div class="container">
						<div class="row">
							<div class="order-1 col-sm-12 order-sm-1 col-md-6 order-md-0 col-lg-5 order-lg-0">
								<div class="slider-content">
									<h1>{{ $row->title }}</h1>
									@if($aRow->sub_title != '')
									<p class="relative">{{ $aRow->sub_title }}</p>
									@endif

									@if($aRow->button_text != '')
									<a href="{{ $row->url }}" class="btn theme-btn" {{ $aRow->target =='' ? '' : "target=".$aRow->target }}>{{ $aRow->button_text }}</a>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			@endforeach

		</div>
	</section>
	@endif -->

<!-- Home Slider -->
@if($section1->is_publish == 1)
	<section class="slider-section">
		<div class="home-slider owl-carousel">
			<!-- Slider Item -->
			@foreach ($slider as $row)
				@php $aRow = json_decode($row->desc); @endphp
				<div class="single-slider">
					<div class="slider-screen h1-height d-flex align-items-center justify-content-center"
						style="background: url({{ asset('public/media/' . $row->image) }}) center center/cover no-repeat;">
						<div class="container">
							<div class="row justify-content-center text-center">
								<div class="col-12 col-md-10 col-lg-8">
									<div class="slider-content text-white">
										<!-- <h1 class="fw-bold">{{ $row->title }}</h1>

																@if(!empty($aRow->sub_title))
																	<p class="mt-3">{{ $aRow->sub_title }}</p>
																@endif -->

										@if(!empty($aRow->button_text))
											<a href="{{ $row->url }}" class="btn theme-btn mt-3" {{ $aRow->target == '' ? '' : "target=" . $aRow->target }}>
												{{ $aRow->button_text }}
											</a>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			<!-- /Slider Item/ -->
		</div>
	</section>
@endif
<!-- /Home Slider/ -->

<!-- Featured Categories -->
@if($section2->is_publish == 1)
	<section class="section d-none d-md-block">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-heading text-center">


						@if($section2->title != '')
							<h2>{{ $section2->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common featured-categories">
				@foreach ($pro_category as $row)
					<div class="col-lg-12">
						<div class="featured-card">
							<div class="featured-image">
								<a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}">
									<img src="{{ asset('public/media/' . $row->thumbnail) }}" alt="{{ $row->name }}" />
								</a>
							</div>
							<div class="featured-title">
								<a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}">{{ $row->name }}</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
@endif
<!-- for mobile section -->
@if($section2->is_publish == 1)
	<section class="category-section d-block d-md-none">
		<div class="container">

			<!-- Section Header -->
			<div class="d-flex justify-content-between align-items-center mb-3">
				<h6 class="mb-0">{{ $section2->title ?? 'Featured Categories' }}</h6>
				<!-- <a href="#" class="btn btn-sm vs fs-10">View All</a> -->
			</div>

			<!-- Horizontal Scroll Categories -->
			<div class="categories-scroll">
				@foreach ($pro_category as $row)
					<div class="category-card">
						<a href="{{ route('frontend.product-category', [$row->id, $row->slug]) }}" class="category-link">
							<div class="category-img-container">
								<img src="{{ asset('public/media/' . $row->thumbnail) }}" alt="{{ $row->name }}"
									class="category-img" loading="lazy">
							</div>
							<div class="category-content">
								<h6 class="category-title">{{ $row->name }}</h6>
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>

		<style>
			/* Section Wrapper */
			.category-section {
				padding: 1.5rem 0;
				background: #fff;
			}

			/* Scrollable Container */
			.categories-scroll {
				display: flex;
				/* gap: 0.2rem; */
				gap: 5px;
				justify-content: center;
				flex-wrap: wrap;
				align-self: center;
				/* padding: 0.5rem 0.2rem; */
				/* overflow-x: auto;
							scroll-snap-type: x mandatory;
							-webkit-overflow-scrolling: touch; */
			}

			.categories-scroll::-webkit-scrollbar {
				display: none;
				/* Hide scrollbar */
			}

			/* Category Card */
			.category-card {
				flex: 0 0 auto;
				/* Don’t shrink */
				width: 32.33%;
				/* margin-top: 10, */
				/* Fixed card width */
				background: #fff;
				/* border-radius: 12px; */
				box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
				overflow: hidden;
				scroll-snap-align: start;
				transition: transform 0.3s ease;

			}

			.category-card:hover {
				transform: translateY(-3px);
				box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
			}

			.category-link {
				text-decoration: none;
				color: inherit;
				display: flex;
				flex-direction: column;
				align-items: center;
			}

			.category-img-container {
				width: 100%;
				aspect-ratio: 1 / 1;
				display: flex;
				align-items: center;
				justify-content: center;
				/* background: #f9fafb; */

			}

			.category-img {
				width: 80%;
				height: auto;
				object-fit: contain;
				transition: transform 0.3s ease;
			}

			.category-card:hover .category-img {
				transform: scale(1.05);
			}

			.category-content {
				padding: 0.6rem;
				text-align: center;
			}

			.category-title {
				font-size: 0.75rem;
				font-weight: 600;
				color: #1f2937;
				margin: 0;
				text-overflow: ellipsis;
				overflow: hidden;
				white-space: nowrap;
			}
		</style>
	</section>
@endif
<!-- /Featured Categories/ -->

<section class="brands-section py-4">
  <div class="container">

    <!-- Section Header -->
    <div class="mb-3">
      <h6 class="mb-0">Brands</h6>
    </div>

    <!-- Grid for All Devices -->
    <div class="row g-3">
      @foreach ($brands as $brand)
        <div class="col-4 col-sm-3 col-md-2 col-lg-2">
          <div class="card h-100 shadow-sm border-0 d-flex align-items-center justify-content-center"
               style="height: 100px;">
            <a href="{{ route('frontend.brand', ['id' => $brand->id, 'title' => Str::slug($brand->name)]) }}">
              <img src="{{ asset('public/media/' . $brand->thumbnail) }}"
                   alt="{{ $brand->name }}"
                   class="img-fluid p-2"
                   loading="lazy">
            </a>
          </div>
        </div>
      @endforeach
    </div>

  </div>
</section>


<!-- /Offer Section/ -->

<!-- New Products -->
@if($section4->is_publish == 1)


	<section class="section product-section py-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center mb-4">

						@if($section4->title != '')
							<h2>{{ $section4->title }}</h2>
						@endif
					</div>
				</div>
			</div>

			<!-- New Products -->
			<div class="row g-3" id="new-products">
				<div class="col-12 text-center py-5" id="loader-new">
					<i class="bi bi-arrow-repeat spin"></i> Loading new products...
				</div>
			</div>
		</div>
	</section>
@endif



<!-- Popular Products -->
@if($section5->is_publish == 1)
	<section class="section product-section py-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center mb-4">
						@if($section5->title != '')
							<h2>{{ $section5->title }}</h2>
						@endif
					</div>
				</div>
			</div>

			<!-- Popular Products -->
			<div class="row g-3" id="popular-products">
				<div class="col-12 text-center py-5" id="loader">
					<i class="bi bi-arrow-repeat spin"></i> Loading products...
				</div>
			</div>
		</div>
	</section>
@endif


<!-- /Popular Products/ -->

<!-- Top Selling Products -->
@if($section6->is_publish == 1)
	<section class="section product-section py-4">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center mb-4">

						@if($section6->title != '')
							<h2>{{ $section6->title }}</h2>
						@endif
					</div>
				</div>
			</div>

			<!-- Top Selling Products -->
			<div class="row g-3" id="top-selling-products">
				<div class="col-12 text-center py-5" id="loader-top">
					<i class="bi bi-arrow-repeat spin"></i> Loading top selling products...
				</div>
			</div>
		</div>
	</section>
@endif

<!-- /Top Selling Products/ -->

<!-- Trending Products -->
@if($section8->is_publish == 1)
	<section class="section product-section"
		style="background-image: url({{ $section8->image ? asset('public/media/' . $section8->image) : '' }});">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">


						@if($section8->title != '')
							<h2>{{ $section8->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">
				@foreach ($trending_products as $row)
					<div class="col-lg-12">
						<div class="item-card">
							<div class="item-image">
								@if(($row->is_discount == 1) && ($row->old_price != ''))
									@php
										$discount = number_format((($row->old_price - $row->sale_price) * 100) / $row->old_price);
									@endphp
									<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
								@endif
								<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
									<img src="{{ asset('public/media/' . $row->f_thumbnail) }}" alt="{{ $row->title }}" />
								</a>
							</div>
							<div class="item-title">
								<a
									href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
							</div>
							<div class="rating-wrap">
								<div class="stars-outer">
									<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
								</div>
								<span class="rating-count">({{ $row->TotalReview }})</span>
							</div>
							<div class="item-sold">
								{{ __('Sold By') }} <a
									href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
							</div>
							<div class="item-pric-card">
								@if($row->sale_price != '')
									@if($gtext['currency_position'] == 'left')
										<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
									@else
										<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
									@endif
								@endif
								@if(($row->is_discount == 1) && ($row->old_price != ''))
									@if($gtext['currency_position'] == 'left')
										<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
									@else
										<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
									@endif
								@endif
							</div>
							<div class="item-card-bottom">
								<a data-id="{{ $row->id }}"
                                   data-variation-size="{{ $row->variation_size }}"
                                   data-variation-color="{{ $row->variation_color }}"
                                   href="javascript:void(0);"
									class="btn add-to-cart homepage-addtocart">{{ __('Add To Cart') }}</a>
								<ul class="item-cart-list">
									<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i
												class="bi bi-heart"></i></a></li>
									<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i
												class="bi bi-eye"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
@endif
<!-- /Trending Products/ -->

<!-- Top Rated Products -->
@if($section9->is_publish == 1)
	<section class="section product-section">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section-heading text-center">


						@if($section9->title != '')
							<h2>{{ $section9->title }}</h2>
						@endif
					</div>
				</div>
			</div>
			<div class="row owl-carousel caro-common category-carousel">
				@foreach ($top_rated as $row)
					<div class="col-lg-12">
						<div class="item-card">
							<div class="item-image">
								@if(($row->is_discount == 1) && ($row->old_price != ''))
									@php
										$discount = number_format((($row->old_price - $row->sale_price) * 100) / $row->old_price);
									@endphp
									<span class="item-label">{{ $discount }}% {{ __('Off') }}</span>
								@endif
								<a href="{{ route('frontend.product', [$row->id, $row->slug]) }}">
									<img src="{{ asset('public/media/' . $row->f_thumbnail) }}" alt="{{ $row->title }}" />
								</a>
							</div>
							<div class="item-title">
								<a
									href="{{ route('frontend.product', [$row->id, $row->slug]) }}">{{ str_limit($row->title) }}</a>
							</div>
							<div class="rating-wrap">
								<div class="stars-outer">
									<div class="stars-inner" style="width:{{ $row->ReviewPercentage }}%;"></div>
								</div>
								<span class="rating-count">({{ $row->TotalReview }})</span>
							</div>
							<div class="item-sold">
								{{ __('Sold By') }} <a
									href="{{ route('frontend.stores', [$row->seller_id, str_slug($row->shop_url)]) }}">{{ str_limit($row->shop_name) }}</a>
							</div>
							<div class="item-pric-card">
								@if($row->sale_price != '')
									@if($gtext['currency_position'] == 'left')
										<div class="new-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->sale_price) }}</div>
									@else
										<div class="new-price">{{ NumberFormat($row->sale_price) }}{{ $gtext['currency_icon'] }}</div>
									@endif
								@endif
								@if(($row->is_discount == 1) && ($row->old_price != ''))
									@if($gtext['currency_position'] == 'left')
										<div class="old-price">{{ $gtext['currency_icon'] }}{{ NumberFormat($row->old_price) }}</div>
									@else
										<div class="old-price">{{ NumberFormat($row->old_price) }}{{ $gtext['currency_icon'] }}</div>
									@endif
								@endif
							</div>
							<div class="item-card-bottom">
								<a data-id="{{ $row->id }}"
                                   data-variation-size="{{ $row->variation_size }}"
                                   data-variation-color="{{ $row->variation_color }}"
                                   href="javascript:void(0);"
									class="btn add-to-cart homepage-addtocart">{{ __('Add To Cart') }}</a>
								<ul class="item-cart-list">
									<li><a class="addtowishlist" data-id="{{ $row->id }}" href="javascript:void(0);"><i
												class="bi bi-heart"></i></a></li>
									<li><a href="{{ route('frontend.product', [$row->id, $row->slug]) }}"><i
												class="bi bi-eye"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>
@endif
<!-- /Top Rated Products/ -->

<!-- Video Section -->
<!-- @if($home_video['is_publish'] == 1)
	<section class="section video-section"
		style="background-image: url({{ asset('public/media/' . $home_video['image']) }});">
		<div class="container">
			<div class="row justify-content-start">
				<div class="col-xl-7 text-center">
					<div class="video-card">
						<a href="{{ $home_video['video_url'] }}" class="play-icon popup-video">
							<i class="bi bi-play-fill"></i>
						</a>
					</div>
				</div>
				<div class="col-xl-5">
					<div class="video-desc">
						<h1>{{ $home_video['title'] }}</h1>
						@if($home_video['short_desc'] != '')
							<p>{{ $home_video['short_desc'] }}</p>
						@endif
						<a href="{{ $home_video['url'] }}" {{ $home_video['target'] == '' ? '' : "target=" . $home_video['target'] }} class="btn theme-btn">{{ $home_video['button_text'] }}</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@endif -->
<!-- /Video Section/ -->





<script>
	document.addEventListener("DOMContentLoaded", function () {
		fetch("{{ url('/api/popular-products') }}")
			.then(res => res.json())
			.then(res => {
				if (res.status) {
					let html = "";
					res.products.forEach(row => {
						let discount = "";
						if (row.is_discount == 1 && row.old_price) {
							discount = Math.round(((row.old_price - row.sale_price) * 100) / row.old_price);
						}

						html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="item-card h-100 shadow-sm rounded p-2">

                                <!-- Image -->
                                <div class="item-image position-relative">
                                    ${discount ? `<span class="item-label">${discount}% Off</span>` : ""}
                                    <a href="/product/${row.id}/${row.slug}">
                                        <img src="/public/media/${row.f_thumbnail}"
                                             alt="${row.title}"
                                             class="img-fluid product-img"/>
                                    </a>
                                </div>

                                <!-- Title -->
                                <div class="item-title mt-2 text-truncate">
                                    <a href="/product/${row.id}/${row.slug}">
                                        ${row.title.length > 40 ? row.title.substring(0, 40) + '…' : row.title}
                                    </a>
                                </div>

                                <!-- Rating -->
                                <div class="rating-wrap small mb-1">
                                    <div class="stars-outer">
                                        <div class="stars-inner" style="width:${row.ReviewPercentage}%;"></div>
                                    </div>
                                    <span class="rating-count">(${row.TotalReview})</span>
                                </div>

                                <!-- Price -->
                                <div class="item-pric-card mb-2">
                                    <div class="new-price fw-bold text-primary">
                                        {{ $gtext['currency_position'] == 'left'
	? $gtext['currency_icon'] : '' }}${Number(row.sale_price).toFixed(2)}{{ $gtext['currency_position'] == 'right'
	? $gtext['currency_icon'] : '' }}
                                    </div>
                                    ${row.is_discount == 1 && row.old_price ? `
                                        <div class="old-price text-muted small">
                                            <del>
                                            {{ $gtext['currency_position'] == 'left'
	? $gtext['currency_icon'] : '' }}${Number(row.old_price).toFixed(2)}{{ $gtext['currency_position'] == 'right'
	? $gtext['currency_icon'] : '' }}
                                            </del>
                                        </div>` : ""}
                                </div>

                                <!-- Buttons -->
                                <div class="item-card-bottom d-flex justify-content-between align-items-center">
                                    <a data-id="${row.id}"
                                       data-variation-size="${row.variation_size || ''}"
                                       data-variation-color="${row.variation_color || ''}"
                                       href="javascript:void(0);"
                                       class="btn btn-sm btn-primary add-to-cart homepage-addtocart">
                                        Add To Cart
                                    </a>
                                    <div class="d-flex">
                                        <a class="addtowishlist me-2" data-id="${row.id}" href="javascript:void(0);">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                        <a href="/product/${row.id}/${row.slug}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
					});

					document.getElementById("popular-products").innerHTML = html;
				}
			})
			.catch(err => {
				document.getElementById("popular-products").innerHTML =
					`<div class="col-12 text-center text-danger py-5">Failed to load products.</div>`;
			});
	});


	document.addEventListener("DOMContentLoaded", function () {
		fetch("{{ url('/api/new-products') }}")
			.then(res => res.json())
			.then(res => {
				if (res.status) {
					let html = "";
					res.products.forEach(row => {
						let discount = "";
						if (row.is_discount == 1 && row.old_price) {
							discount = Math.round(((row.old_price - row.sale_price) * 100) / row.old_price);
						}

						html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="item-card h-100 shadow-sm rounded p-2">

                                <!-- Image -->
                                <div class="item-image position-relative">
                                    ${discount ? `<span class="item-label">${discount}% Off</span>` : ""}
                                    <a href="/product/${row.id}/${row.slug}">
                                        <img src="/public/media/${row.f_thumbnail}"
                                             alt="${row.title}"
                                             class="img-fluid product-img"/>
                                    </a>
                                </div>

                                <!-- Title -->
                                <div class="item-title mt-2 text-truncate">
                                    <a href="/product/${row.id}/${row.slug}">
                                        ${row.title.length > 40 ? row.title.substring(0, 40) + '…' : row.title}
                                    </a>
                                </div>

                                <!-- Rating -->
                                <div class="rating-wrap small mb-1">
                                    <div class="stars-outer">
                                        <div class="stars-inner" style="width:${row.ReviewPercentage}%;"></div>
                                    </div>
                                    <span class="rating-count">(${row.TotalReview})</span>
                                </div>

                                <!-- Price -->
                                <div class="item-pric-card mb-2">
                                    <div class="new-price fw-bold text-primary">
                                        {{ $gtext['currency_position'] == 'left'
	? $gtext['currency_icon'] : '' }}${Number(row.sale_price).toFixed(2)}{{ $gtext['currency_position'] == 'right'
	? $gtext['currency_icon'] : '' }}
                                    </div>
                                    ${row.is_discount == 1 && row.old_price ? `
                                        <div class="old-price text-muted small">
                                            <del>
                                            {{ $gtext['currency_position'] == 'left'
	? $gtext['currency_icon'] : '' }}${Number(row.old_price).toFixed(2)}{{ $gtext['currency_position'] == 'right'
	? $gtext['currency_icon'] : '' }}
                                            </del>
                                        </div>` : ""}
                                </div>

                                <!-- Buttons -->
                                <div class="item-card-bottom d-flex justify-content-between align-items-center">
                                    <a data-id="${row.id}"
                                       data-variation-size="${row.variation_size || ''}"
                                       data-variation-color="${row.variation_color || ''}"
                                       href="javascript:void(0);"
                                       class="btn btn-sm btn-primary add-to-cart homepage-addtocart">
                                        Add To Cart
                                    </a>
                                    <div class="d-flex">
                                        <a class="addtowishlist me-2" data-id="${row.id}" href="javascript:void(0);">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                        <a href="/product/${row.id}/${row.slug}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
					});

					document.getElementById("new-products").innerHTML = html;
				}
			})
			.catch(err => {
				document.getElementById("new-products").innerHTML =
					`<div class="col-12 text-center text-danger py-5">Failed to load new products.</div>`;
			});
	});



	document.addEventListener("DOMContentLoaded", function () {
		fetch("{{ url('/api/top-selling-products') }}")
			.then(res => res.json())
			.then(res => {
				if (res.status) {
					let html = "";
					res.products.forEach(row => {
						let discount = "";
						if (row.is_discount == 1 && row.old_price) {
							discount = Math.round(((row.old_price - row.sale_price) * 100) / row.old_price);
						}

						html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                            <div class="item-card h-100 shadow-sm rounded p-2">

                                <!-- Image -->
                                <div class="item-image position-relative">
                                    ${discount ? `<span class="item-label">${discount}% Off</span>` : ""}
                                    <a href="/product/${row.id}/${row.slug}">
                                        <img src="/public/media/${row.f_thumbnail}"
                                             alt="${row.title}"
                                             class="img-fluid product-img"/>
                                    </a>
                                </div>

                                <!-- Title -->
                                <div class="item-title mt-2 text-truncate">
                                    <a href="/product/${row.id}/${row.slug}">
                                        ${row.title.length > 40 ? row.title.substring(0, 40) + '…' : row.title}
                                    </a>
                                </div>

                                <!-- Rating -->
                                <div class="rating-wrap small mb-1">
                                    <div class="stars-outer">
                                        <div class="stars-inner" style="width:${row.ReviewPercentage}%;"></div>
                                    </div>
                                    <span class="rating-count">(${row.TotalReview})</span>
                                </div>

                                <!-- Price -->
                                <div class="item-pric-card mb-2">
                                    <div class="new-price fw-bold text-primary">
                                        {{ $gtext['currency_position'] == 'left'
	? $gtext['currency_icon'] : '' }}${Number(row.sale_price).toFixed(2)}{{ $gtext['currency_position'] == 'right'
	? $gtext['currency_icon'] : '' }}
                                    </div>
                                    ${row.is_discount == 1 && row.old_price ? `
                                        <div class="old-price text-muted small">
                                            <del>
                                            {{ $gtext['currency_position'] == 'left'
	? $gtext['currency_icon'] : '' }}${Number(row.old_price).toFixed(2)}{{ $gtext['currency_position'] == 'right'
	? $gtext['currency_icon'] : '' }}
                                            </del>
                                        </div>` : ""}
                                </div>

                                <!-- Buttons -->
                                <div class="item-card-bottom d-flex justify-content-between align-items-center">
                                    <a data-id="${row.id}"
                                       data-variation-size="${row.variation_size || ''}"
                                       data-variation-color="${row.variation_color || ''}"
                                       href="javascript:void(0);"
                                       class="btn btn-sm btn-primary add-to-cart homepage-addtocart">
                                        Add To Cart
                                    </a>
                                    <div class="d-flex">
                                        <a class="addtowishlist me-2" data-id="${row.id}" href="javascript:void(0);">
                                            <i class="bi bi-heart"></i>
                                        </a>
                                        <a href="/product/${row.id}/${row.slug}">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    `;
					});

					document.getElementById("top-selling-products").innerHTML = html;
				}
			})
			.catch(err => {
				document.getElementById("top-selling-products").innerHTML =
					`<div class="col-12 text-center text-danger py-5">Failed to load top selling products.</div>`;
			});
	});

            // Handle case where data attribute might be null or undefined
            sizeStr = sizeStr ? String(sizeStr) : "";
            colorStr = colorStr ? String(colorStr) : "";

            var sizes = sizeStr.split(',').filter(s => s.trim() !== "");
            var colors = colorStr.split(',').filter(c => c.trim() !== "");
            console.log("Parsed Sizes:", sizes, "Parsed Colors:", colors);

            // Reset modal state
            $('#variation_product_id').val(id);
            $('#variation_selected_size').val('');
            $('#variation_selected_color').val('');
            $('#variation-size-group').hide();
            $('#variation-color-group').hide();
            $('#variation-size-options').empty();
            $('#variation-color-options').empty();

            // Remove active class from all options
            $('.variation-option').removeClass('active');

            var needsModal = false;
            var autoSize = null;
            var autoColor = null;

            // Size Logic
            if (sizes.length > 1) {
                needsModal = true;
                $('#variation-size-group').show();
                var sizeHtml = '';
                sizes.forEach(function(size) {
                    sizeHtml += `<div class="variation-option size-option" data-value="${size.trim()}">${size.trim()}</div>`;
                });
                $('#variation-size-options').html(sizeHtml);
            } else if (sizes.length === 1) {
                autoSize = sizes[0].trim();
                console.log("Auto-selecting size:", autoSize);
                // Pre-populate modal just in case
                var sizeHtml = `<div class="variation-option size-option active" data-value="${autoSize}">${autoSize}</div>`;
                $('#variation-size-options').html(sizeHtml);
                $('#variation_selected_size').val(autoSize);
                // If we show modal for color, show size as well (but locked/selected)
                if(colors.length > 1) $('#variation-size-group').show();
            }

            // Color Logic
            if (colors.length > 1) {
                needsModal = true;
                $('#variation-color-group').show();
                var colorHtml = '';
                colors.forEach(function(color) {
                    colorHtml += `<div class="variation-option color-option" data-value="${color.trim()}">${color.trim()}</div>`;
                });
                $('#variation-color-options').html(colorHtml);
            } else if (colors.length === 1) {
                autoColor = colors[0].trim();
                console.log("Auto-selecting color:", autoColor);
                var colorHtml = `<div class="variation-option color-option active" data-value="${autoColor}">${autoColor}</div>`;
                $('#variation-color-options').html(colorHtml);
                $('#variation_selected_color').val(autoColor);
                if(sizes.length > 1) $('#variation-color-group').show();
            }

            if (needsModal) {
                console.log("Showing modal...");
                // Show Modal
                if (typeof bootstrap !== 'undefined') {
                    var el = document.getElementById('variationModal');
                    var variationModal = bootstrap.Modal.getInstance(el) || new bootstrap.Modal(el);
                    variationModal.show();
                } else {
                    $('#variationModal').modal('show');
                }
            } else {
                console.log("Direct add to cart...");
                // Direct Add
                addToCartDirect(id, 1, autoSize, autoColor);
            }
        });

        $(document).on('click', '.variation-option.size-option', function() {
            $('.variation-option.size-option').removeClass('active');
            $(this).addClass('active');
            $('#variation_selected_size').val($(this).data('value'));
        });

        $(document).on('click', '.variation-option.color-option', function() {
            $('.variation-option.color-option').removeClass('active');
            $(this).addClass('active');
            $('#variation_selected_color').val($(this).data('value'));
        });

        $('#confirm-add-to-cart').on('click', function() {
            var id = $('#variation_product_id').val();
            var size = $('#variation_selected_size').val();
            var color = $('#variation_selected_color').val();

            // Check if visible options are selected
            if ($('#variation-size-group').is(':visible') && size === '') {
                showError("Please select a size");
                return;
            }
            if ($('#variation-color-group').is(':visible') && color === '') {
                showError("Please select a color");
                return;
            }

            // Close modal
            var modalEl = document.getElementById('variationModal');
            if (typeof bootstrap !== 'undefined') {
                 var modal = bootstrap.Modal.getInstance(modalEl);
                 if(modal) modal.hide();
                 else $(modalEl).modal('hide'); // Fallback
            } else {
                 $('#variationModal').modal('hide');
            }

            // Add to Cart with selections
            addToCartDirect(id, 1, size, color);
        });

        function showError(msg) {
            if(typeof onErrorMsg === 'function') {
                onErrorMsg(msg);
            } else {
                alert(msg);
            }
        }

        function addToCartDirect(id, qty, size = null, color = null) {
            var url = "{{ url('/frontend/add_to_cart') }}/" + id + "/" + qty;

            var data = {};
            if (size) data.size = size;
            if (color) data.color = color;

            console.log("Sending AJAX to:", url, "Data:", data);

            $.ajax({
                type: 'GET',
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    console.log("AJAX Success:", response);
                    var msgType = response.msgType;
                    var msg = response.msg;

                    if (msgType == "success") {
                        if(typeof onSuccessMsg === 'function') onSuccessMsg(msg);
                        else alert(msg);
                    } else {
                        showError(msg);
                    }
                    if(typeof onViewCart === 'function') onViewCart();
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    showError("Something went wrong. Please try again.");
                }
            });
        }
    });
</script>

<!-- Variation Selection Modal -->
<div class="modal fade" id="variationModal" tabindex="-1" aria-labelledby="variationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="variationModalLabel">Select Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="variation_product_id">
        <input type="hidden" id="variation_selected_size">
        <input type="hidden" id="variation_selected_color">

        <div class="mb-3" id="variation-size-group">
            <label class="form-label fw-bold">Size:</label>
            <div class="d-flex flex-wrap gap-2" id="variation-size-options">
                <!-- Options injected via JS -->
            </div>
        </div>

        <div class="mb-3" id="variation-color-group">
            <label class="form-label fw-bold">Color:</label>
            <div class="d-flex flex-wrap gap-2" id="variation-color-options">
                <!-- Options injected via JS -->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirm-add-to-cart">Add to Cart</button>
      </div>
    </div>
  </div>
</div>

<style>
    .variation-option {
        border: 1px solid #ddd;
        padding: 5px 15px;
        cursor: pointer;
        border-radius: 4px;
        transition: all 0.2s;
    }
    .variation-option:hover {
        border-color: #aaa;
        background-color: #f8f9fa;
    }
    .variation-option.active {
        border-color: var(--theme-color, #0d6efd);
        background-color: var(--theme-color, #0d6efd);
        color: white;
    }
</style>