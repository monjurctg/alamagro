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

	// Handler for Product Page & Quick View Modal "Add to Cart"
	$(document).on("click", ".product_addtocart", function (event) {
		event.preventDefault();

		var btn = $(this);
		var id = btn.data('id');

		// Context-aware selector for interactions
		var container = btn.closest('.product-details'); // From Modal or Product Page
		if (container.length === 0) container = $('body'); // Fallback

		// Get Quantity
		var qtyInput = container.find('.quantity');
		var qty = qtyInput.length > 0 ? qtyInput.val() : $("#quantity").val();

		if ((qty == undefined) || (qty == '') || (qty <= 0)) {
			onErrorMsg(TEXT['Please enter quantity.']);
			return;
		}

		// Get selected variations
		var sizeWidget = container.find('.widget-size');
		var colorWidget = container.find('.widget-color');

		var sizeOptionsCount = sizeWidget.find('.size-option').length;
		var colorOptionsCount = colorWidget.find('.color-option').length;

		var selectedSize = sizeWidget.find('.size-option.active').data('size');
		var selectedColor = colorWidget.find('.color-option.active').data('color');

		// Retrieve global stock status from button data if available, or global variables (legacy)
		var stockQty = btn.data('stockqty') || (typeof stockqty !== 'undefined' ? stockqty : 9999);
		var isStock = btn.data('is_stock') || (typeof is_stock !== 'undefined' ? is_stock : 0);
		var isStockStatus = btn.data('is_stock_status') || (typeof is_stock_status !== 'undefined' ? is_stock_status : 1);

		// Validation
		if (sizeOptionsCount > 0 && !selectedSize) {
			onErrorMsg(TEXT['Please select a size.']);
			return;
		}
		if (colorOptionsCount > 0 && !selectedColor) {
			onErrorMsg(TEXT['Please select a color.']);
			return;
		}

		if (isStock == 1) {
			if (isStockStatus == 1) {
				if (qty > stockQty) {
					onErrorMsg(TEXT['The value must be less than or equal to'] + ' ' + stockQty);
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
			color: selectedColor
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
					// Close Modal if open
					if (btn.closest('.modal').length > 0) {
						$('.modal').modal('hide');
						$('#lightCustomModal').hide(); // If custom modal used
					}
					// Open Cart Drawer
					$('.headerShopingCart').addClass('open');
				} else {
					onErrorMsg(msg);
				}
				onViewCart();
			}
		});
	});

	$(document).on("click", ".product_buy_now", function (event) {
		event.preventDefault();
		var btn = $(this);
		var id = btn.data('id');

		var container = btn.closest('.product-details'); // From Modal or Product Page
		if (container.length === 0) container = $('body');

		var qtyInput = container.find('.quantity');
		var qty = qtyInput.length > 0 ? qtyInput.val() : $("#quantity").val();

		// Get selected variations
		var sizeWidget = container.find('.widget-size');
		var colorWidget = container.find('.widget-color');

		var hasSizeOptions = sizeWidget.length > 0;
		var hasColorOptions = colorWidget.length > 0;

		var selectedSize = sizeWidget.find('.size-option.active').data('size');
		var selectedColor = colorWidget.find('.color-option.active').data('color');

		var stockQty = btn.data('stockqty') || (typeof stockqty !== 'undefined' ? stockqty : 9999);
		var isStock = btn.data('is_stock') || (typeof is_stock !== 'undefined' ? is_stock : 0);
		var isStockStatus = btn.data('is_stock_status') || (typeof is_stock_status !== 'undefined' ? is_stock_status : 1);

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

		if (isStock == 1) {
			if (isStockStatus == 1) {
				if (qty > stockQty) {
					onErrorMsg(TEXT['The value must be less than or equal to'] + ' ' + stockQty);
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
			color: selectedColor
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
					window.location.href = base_url + '/checkout';
				} else {
					onErrorMsg(msg);
				}
				onViewCart();
			}
		});
	});

	// Handler for Listing Pages (Direct Add or Open Modal)
	$(document).on("click", ".addtocart, .homepage-addtocart", function (event) {
		event.preventDefault();

		var btn = $(this);
		var id = btn.data('id');

		// Check for variation data
		var isVariation = btn.data('is_variation');
		var varSize = btn.data('variation-size');
		var varColor = btn.data('variation-color');

		// Determine if product is variable
		if (isVariation == 1 || (varSize && varSize != '') || (varColor && varColor != '')) {
			// Open Quick View Modal
			$.ajax({
				type: 'GET',
				url: base_url + '/frontend/quickview/' + id,
				dataType: 'html',
				success: function (response) {
					// Assuming there is a generic modal container or we create one
					// The template uses #lightCustomModal but that looks like a small popup.
					// We'll use a standard Bootstrap modal if available, or reuse #lightCustomModal structure
					// Let's inject into a new modal container appended to body just to be safe

					var modalId = 'quickViewModal';
					if ($('#' + modalId).length === 0) {
						$('body').append(`
							<div class="modal fade" id="${modalId}" tabindex="-1" role="dialog" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">${TEXT['Quick View'] || 'Quick View'}</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body quick-view-body">
										</div>
									</div>
								</div>
							</div>
						`);
					}

					$('#' + modalId + ' .quick-view-body').html(response);
					var quickViewModal = new bootstrap.Modal(document.getElementById(modalId));
					quickViewModal.show();
				}
			});
			return; // Stop here, don't auto-add
		}

		var qty = 1;

		console.log("Adding to cart: ID " + id + ", Qty " + qty);

		$.ajax({
			type: 'GET',
			url: base_url + '/frontend/add_to_cart/' + id + '/' + qty,
			dataType: "json",
			success: function (response) {
				var msgType = response.msgType;
				var msg = response.msg;

				if (msgType == "success") {
					onSuccessMsg(msg);
					$('.headerShopingCart').addClass('open');
				} else {
					onErrorMsg(msg);
				}
				onViewCart();
			},
			error: function (xhr, status, error) {
				console.error("Add to cart failed:", error);
				onErrorMsg("Failed to add to cart. Please try again.");
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
