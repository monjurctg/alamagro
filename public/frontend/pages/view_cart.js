var $ = jQuery.noConflict();

$(function () {
	"use strict";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	onViewCartData();

	// Handle quantity changes
	$(document).on('click', '.qty-btn', function () {
		var productKey = $(this).data('id');
		var input = $('#quantity_' + productKey);
		var currentValue = parseInt(input.val());
		var maxValue = parseInt(input.attr('max')) || 999;
		var minValue = parseInt(input.attr('min')) || 1;

		if ($(this).hasClass('plus')) {
			if (currentValue < maxValue) {
				input.val(currentValue + 1);
				updateCartQuantity(productKey, currentValue + 1);
			}
		} else if ($(this).hasClass('minus')) {
			if (currentValue > minValue) {
				input.val(currentValue - 1);
				updateCartQuantity(productKey, currentValue - 1);
			}
		}
	});

	// Handle direct input changes
	$(document).on('change', '.quantity', function () {
		var productKey = $(this).data('id');
		var newValue = parseInt($(this).val());
		var maxValue = parseInt($(this).attr('max')) || 999;
		var minValue = parseInt($(this).attr('min')) || 1;

		if (newValue > maxValue) {
			$(this).val(maxValue);
			newValue = maxValue;
		} else if (newValue < minValue) {
			$(this).val(minValue);
			newValue = minValue;
		}

		updateCartQuantity(productKey, newValue);
	});
});

function onViewCartData() {

	$.ajax({
		type: 'GET',
		url: base_url + "/frontend/viewcart_data",
		dataType: "json",
		success: function (data) {

			$(".viewcart_price_total").text(data.price_total);
			$(".viewcart_discount").text(data.discount);
			$(".viewcart_tax").text(data.tax);
			$(".viewcart_sub_total").text(data.sub_total);
			$(".viewcart_total").text(data.total);
		}
	});
}

function onRemoveToCart(cartKey) {
	$.ajax({
		type: 'GET',
		url: base_url + '/frontend/remove_to_cart/' + encodeURIComponent(cartKey),
		dataType: "json",
		success: function (response) {

			var msgType = response.msgType;
			var msg = response.msg;

			if (msgType == "success") {
				onSuccessMsg(msg);
				$('#row_delete_' + cartKey).remove();
			} else {
				onErrorMsg(msg);
			}

			onViewCartData();
			onViewCart();
		}
	});
}

function updateCartQuantity(productKey, quantity) {
	$.ajax({
		type: 'POST',
		url: base_url + '/frontend/update_cart_quantity',
		data: {
			product_id: productKey,
			quantity: quantity
		},
		dataType: "json",
		success: function (response) {
			if (response.msgType == "success") {
				onViewCartData();
				onViewCart();
				// Update the specific row total
				if (response.line_total) {
					$('#row_delete_' + productKey + ' .pro-total-price').text(response.line_total);
				}
			} else {
				onErrorMsg(response.msg);
			}
		},
		error: function (xhr, status, error) {
			onErrorMsg('Failed to update cart quantity');
		}
	});
}