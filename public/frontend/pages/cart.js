var $ = jQuery.noConflict();

$(function () {
	"use strict";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	onViewCart();
	onWishlist();

	$(document).on("click", ".product_addtocart", function (event) {
		event.preventDefault();
		console.log("product_addtocart clicked");

		var id = $(this).data('id');
		var qty = $("#quantity").val();

		console.log("ID:", id, "Qty:", qty);

		// Get selected variations
		var sizeOptionsCount = $('.widget-size .size-option').length;
		var colorOptionsCount = $('.widget-color .color-option').length;
		var selectedSize = $('.size-option.active').data('size');
		var selectedColor = $('.color-option.active').data('color');

		console.log("Size Count:", sizeOptionsCount, "Selected Size:", selectedSize);
		console.log("Color Count:", colorOptionsCount, "Selected Color:", selectedColor);

		// Only require selection if there are multiple options
		if (sizeOptionsCount > 1 && !selectedSize) {
			onErrorMsg(TEXT['Please select a size.']);
			return;
		}
		if (colorOptionsCount > 1 && !selectedColor) {
			onErrorMsg(TEXT['Please select a color.']);
			return;
		}

		if ((qty == undefined) || (qty == '') || (qty <= 0)) {
			onErrorMsg(TEXT['Please enter quantity.']);
			return;
		}
		if (is_stock == 1) {
			var stockqty = $(this).data('stockqty');
			if (is_stock_status == 1) {
				if (qty > stockqty) {
					onErrorMsg(TEXT['The value must be less than or equal to']);
					return;
				}
			} else {
				onErrorMsg(TEXT['This product out of stock.']);
				return;
			}
		}

		// Prepare data with variations
		var requestData = {
			size: selectedSize,
			color: selectedColor,
			variant_id: $(this).data('variantid') || ''
		};

		$.ajax({
			type: 'GET',
			url: base_url + '/frontend/add_to_cart/' + id + '/' + qty,
			data: requestData,
			dataType: "json",
			success: function (response) {
				var msgType = response.msgType;
				var msg = response.msg;

				if (msgType == "success") {
					onSuccessMsg(msg);
				} else {
					onErrorMsg(msg);
				}
				onViewCart();
			}
		});
	});

	$(document).on("click", ".product_buy_now", function (event) {
		event.preventDefault();
		var id = $(this).data('id');
		var qty = $("#quantity").val();

		// Get selected variations
		var hasSizeOptions = $('.widget-size').length > 0;
		var hasColorOptions = $('.widget-color').length > 0;
		var selectedSize = $('.size-option.active').data('size');
		var selectedColor = $('.color-option.active').data('color');

		if (hasSizeOptions && !selectedSize) {
			onErrorMsg(TEXT['Please select a size.']);
			return;
		}
		if (hasColorOptions && !selectedColor) {
			onErrorMsg(TEXT['Please select a color.']);
			return;
		}

		if ((qty == undefined) || (qty == '') || (qty <= 0)) {
			onErrorMsg(TEXT['Please enter quantity.']);
			return;
		}
		if (is_stock == 1) {
			var stockqty = $(this).data('stockqty');
			if (is_stock_status == 1) {
				if (qty > stockqty) {
					onErrorMsg(TEXT['The value must be less than or equal to']);
					return;
				}
			} else {
				onErrorMsg(TEXT['This product out of stock.']);
				return;
			}
		}

		// Prepare data with variations
		var requestData = {
			size: selectedSize,
			color: selectedColor,
			variant_id: $(this).data('variantid') || ''
		};

		$.ajax({
			type: 'GET',
			url: base_url + '/frontend/add_to_cart/' + id + '/' + qty,
			data: requestData,
			dataType: "json",
			success: function (response) {
				var msgType = response.msgType;
				var msg = response.msg;

				if (msgType == "success") {
					// onSuccessMsg(msg);
					window.location.href = base_url + '/checkout';
				} else {
					onErrorMsg(msg);
				}
				onViewCart();
			}
		});
	});

	var currentProductVariations = [];
	var currentBasePrice = 0;

	function openQuickVariationModal() {
		var modalEl = document.getElementById('quickVariationModal');
		if (!modalEl) return;
		if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
			var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
			modal.show();
		} else if (typeof jQuery !== 'undefined' && typeof jQuery.fn.modal !== 'undefined') {
			jQuery(modalEl).modal('show');
		}
	}

	function closeQuickVariationModal() {
		var modalEl = document.getElementById('quickVariationModal');
		if (!modalEl) return;
		if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
			var modal = bootstrap.Modal.getInstance(modalEl);
			if (modal) modal.hide();
		} else if (typeof jQuery !== 'undefined' && typeof jQuery.fn.modal !== 'undefined') {
			jQuery(modalEl).modal('hide');
		}
	}

	function updateModalPrice() {
		var selectedSize = $("#modal_selected_size").val();
		var selectedColor = $("#modal_selected_color").val();
		var matched = null;

		if (currentProductVariations && currentProductVariations.length > 0) {
			matched = currentProductVariations.find(function (v) {
				var sizeMatch = !selectedSize || (v.size == selectedSize);
				var colorMatch = !selectedColor || (v.color == selectedColor);
				return sizeMatch && colorMatch;
			});
		}

		if (matched && matched.price > 0) {
			$("#modal_product_price").text('৳ ' + parseFloat(matched.price).toFixed(2));
			$("#modal_selected_variant_id").val(matched.id);
			if (matched.old_price && matched.old_price > matched.price) {
				$("#modal_product_old_price").text('৳ ' + parseFloat(matched.old_price).toFixed(2)).show();
			} else {
				$("#modal_product_old_price").hide();
			}
		} else {
			$("#modal_product_price").text('৳ ' + parseFloat(currentBasePrice).toFixed(2));
			$("#modal_selected_variant_id").val('');
			$("#modal_product_old_price").hide();
		}
	}

	// Quantity buttons in modal
	$(document).on("click", "#modal_qty_plus", function () {
		var current = parseInt($("#modal_qty").val()) || 1;
		$("#modal_qty").val(current + 1);
	});

	$(document).on("click", "#modal_qty_minus", function () {
		var current = parseInt($("#modal_qty").val()) || 1;
		if (current > 1) {
			$("#modal_qty").val(current - 1);
		}
	});

	// Size pill click in modal
	$(document).on("click", ".modal-size-pill", function () {
		$(".modal-size-pill").removeClass("active");
		$(this).addClass("active");
		$("#modal_selected_size").val($(this).data("value"));
		updateModalPrice();
	});

	// Color/Quality pill click in modal
	$(document).on("click", ".modal-color-pill", function () {
		$(".modal-color-pill").removeClass("active");
		$(this).addClass("active");
		$("#modal_selected_color").val($(this).data("value"));
		updateModalPrice();
	});

	// Modal Cancel button
	$(document).on("click", "#modal_cancel_btn, #quickVariationModal .btn-close", function () {
		closeQuickVariationModal();
	});

	// Confirm Add to Cart from modal
	$(document).on("click", "#modal_confirm_add_to_cart", function (e) {
		e.preventDefault();
		var id = $("#modal_product_id").val();
		var qty = $("#modal_qty").val() || 1;
		var size = $("#modal_selected_size").val();
		var color = $("#modal_selected_color").val();
		var variant_id = $("#modal_selected_variant_id").val();

		if ($("#modal_size_group").is(":visible") && !size) {
			onErrorMsg("Please select a size / সাইজ পছন্দ করুন");
			return;
		}

		var requestData = {
			size: size,
			color: color,
			variant_id: variant_id
		};

		var btnHtml = $(this).html();
		var $btn = $(this);
		$btn.html('<span class="spinner-border spinner-border-sm"></span> Adding...').prop("disabled", true);

		$.ajax({
			type: 'GET',
			url: base_url + '/frontend/add_to_cart/' + id + '/' + qty,
			data: requestData,
			dataType: "json",
			success: function (response) {
				$btn.html(btnHtml).prop("disabled", false);
				if (response.msgType == "success") {
					onSuccessMsg(response.msg);
					closeQuickVariationModal();
					$('.headerShopingCart').addClass('open');
				} else {
					onErrorMsg(response.msg);
				}
				onViewCart();
			},
			error: function () {
				$btn.html(btnHtml).prop("disabled", false);
				onErrorMsg("Failed to add to cart. Please try again.");
			}
		});
	});

	// Universal Add To Cart Click (Listing, Cards, Home, Category, Search)
	$(document).on("click", ".addtocart, .homepage-addtocart, .add-to-cart-btn", function (event) {
		event.preventDefault();

		// Don't trigger if it's the product details page addtocart
		if ($(this).hasClass('product_addtocart') || $(this).hasClass('product_buy_now')) {
			return;
		}

		var id = $(this).data('id') || $(this).attr('data-id');
		if (!id) return;

		var $btn = $(this);
		var originalText = $btn.html();

		// Check if product has variations
		$.ajax({
			type: 'GET',
			url: base_url + '/frontend/get_product_variations/' + id,
			dataType: "json",
			beforeSend: function () {
				$btn.html('<span class="spinner-border spinner-border-sm"></span>');
			},
			success: function (res) {
				$btn.html(originalText);

				if (res.status === 'success' && res.has_variations) {
					// Open variation modal
					currentProductVariations = res.variations || [];
					currentBasePrice = res.product.sale_price;

					$("#modal_product_id").val(res.product.id);
					$("#modal_product_title").text(res.product.title);

					var imgUrl = res.product.f_thumbnail ? (public_path + '/media/' + res.product.f_thumbnail) : (public_path + '/frontend/images/default.png');
					$("#modal_product_img").attr('src', imgUrl);

					$("#modal_qty").val(1);
					$("#modal_selected_size").val('');
					$("#modal_selected_color").val('');

					// Sizes
					if (res.sizes && res.sizes.length > 0) {
						var sizeHtml = '';
						res.sizes.forEach(function (size, idx) {
							var activeClass = (idx === 0) ? ' active' : '';
							if (idx === 0) $("#modal_selected_size").val(size);
							sizeHtml += '<div class="modal_variation_pill modal-size-pill' + activeClass + '" data-value="' + size + '">' + size + '</div>';
						});
						$("#modal_size_container").html(sizeHtml);
						$("#modal_size_group").show();
					} else {
						$("#modal_size_group").hide();
					}

					// Colors/GSM
					if (res.colors && res.colors.length > 0) {
						var colorHtml = '';
						res.colors.forEach(function (color, idx) {
							var activeClass = (idx === 0) ? ' active' : '';
							if (idx === 0) $("#modal_selected_color").val(color);
							colorHtml += '<div class="modal_variation_pill modal-color-pill' + activeClass + '" data-value="' + color + '">' + color + '</div>';
						});
						$("#modal_color_container").html(colorHtml);
						$("#modal_color_group").show();
					} else {
						$("#modal_color_group").hide();
					}

					updateModalPrice();
					openQuickVariationModal();

				} else {
					// Direct add for simple products
					$.ajax({
						type: 'GET',
						url: base_url + '/frontend/add_to_cart/' + id + '/1',
						dataType: "json",
						success: function (response) {
							if (response.msgType == "success") {
								onSuccessMsg(response.msg);
								$('.headerShopingCart').addClass('open');
							} else {
								onErrorMsg(response.msg);
							}
							onViewCart();
						}
					});
				}
			},
			error: function () {
				$btn.html(originalText);
				// Fallback to direct add
				$.ajax({
					type: 'GET',
					url: base_url + '/frontend/add_to_cart/' + id + '/1',
					dataType: "json",
					success: function (response) {
						if (response.msgType == "success") {
							onSuccessMsg(response.msg);
							$('.headerShopingCart').addClass('open');
						} else {
							onErrorMsg(response.msg);
						}
						onViewCart();
					}
				});
			}
		});
	});

	$(document).on("click", ".addtowishlist", function (event) {
		event.preventDefault();

		var id = $(this).data('id');

		$.ajax({
			type: 'GET',
			url: base_url + '/frontend/add_to_wishlist/' + id,
			dataType: "json",
			success: function (response) {
				var msgType = response.msgType;
				var msg = response.msg;

				if (msgType == "success") {
					onSuccessMsg(msg);
				} else {
					onErrorMsg(msg);
				}
				onWishlist();
			}
		});
	});
});

function onViewCart() {

	$.ajax({
		type: 'GET',
		url: base_url + '/frontend/view_cart',
		dataType: "json",
		success: function (data) {
			if (data.items == '') {
				$(".has_item_empty").show();
				$(".has_cart_item").hide();
				$(".total_qty").text(0);
			} else {
				$(".has_item_empty").hide();
				$(".has_cart_item").show();

				$('#tp_cart_data').html(data.items);
				$('#tp_cart_data_for_mobile').html(data.items);

				$(".total_qty").text(data.total_qty);
				$(".sub_total").text(data.sub_total);
				$(".tax").text(data.tax);
				$(".tp_total").text(data.total);
			}
		}
	});
}

function onRemoveToCart(id) {
	var rowid = $("#removetocart_" + id).data('id');

	$.ajax({
		type: 'GET',
		url: base_url + '/frontend/remove_to_cart/' + rowid,
		dataType: "json",
		success: function (response) {

			var msgType = response.msgType;
			var msg = response.msg;

			if (msgType == "success") {
				onSuccessMsg(msg);
			} else {
				onErrorMsg(msg);
			}

			onViewCart();
		}
	});
}

function onWishlist() {

	$.ajax({
		type: 'GET',
		url: base_url + '/frontend/count_wishlist',
		dataType: "json",
		success: function (data) {
			$(".count_wishlist").text(data);
		}
	});
}
