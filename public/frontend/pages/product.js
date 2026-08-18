var $ = jQuery.noConflict();

$(function () {
	"use strict";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '.pagination a', function (event) {
		event.preventDefault();
		var page = $(this).attr('href').split('page=')[1];
		onPaginationDataLoad(page);
	});

	// Handle variation selection
	$(document).on('click', '.size-option, .color-option', function () {
		$(this).addClass('active').siblings().removeClass('active');

		// Get selected size and color
		var selectedSize = $('.size-option.active').data('size') || '';
		var selectedColor = $('.color-option.active').data('color') || '';

		// Update variation details display and dynamic pricing
		updateVariationDetails(selectedSize, selectedColor);
	});

	// Auto-select if only one option exists
	if ($('.widget-size .size-option').length === 1) {
		$('.widget-size .size-option').first().click();
	}
	if ($('.widget-color .color-option').length === 1) {
		$('.widget-color .color-option').first().click();
	}

	// If default variation exists in product_variations, auto-select it
	if (typeof product_variations !== 'undefined' && product_variations.length > 0) {
		var defaultVar = product_variations.find(function (v) {
			return v.is_default == 1;
		});

		if (defaultVar) {
			if (defaultVar.size) {
				$('.size-option[data-size="' + defaultVar.size + '"]').addClass('active');
			}
			if (defaultVar.color) {
				$('.color-option[data-color="' + defaultVar.color + '"]').addClass('active');
			}
			updateVariationDetails(defaultVar.size, defaultVar.color);
		}
	}
});

function onPaginationDataLoad(page) {
	$.ajax({
		url: base_url + "/frontend/getProductReviewsGrid",
		data: { page: page, item_id: item_id },
		success: function (data) {
			$('#tp_datalist').html(data);
		}
	});
}

// Format price with currency icon and position
function formatCurrency(amount) {
	var num = parseFloat(amount).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
	if (typeof currency_pos !== 'undefined' && currency_pos === 'right') {
		return num + (currency_icon || '৳');
	} else {
		return (currency_icon || '৳') + num;
	}
}

// Update variation details display and dynamic price calculation
function updateVariationDetails(size, color) {
	var variationDetails = '';
	if (size) variationDetails += 'Size: ' + size;
	if (color) variationDetails += (variationDetails ? ', ' : '') + 'Quality/Color: ' + color;

	if (variationDetails) {
		$('#variation-details').text(variationDetails);
		$('#selected-variation-info').removeClass('d-none');
	} else {
		$('#selected-variation-info').addClass('d-none');
	}

	// Check if dynamic price variations exist
	if (typeof product_variations !== 'undefined' && product_variations.length > 0) {
		var matchedVariant = null;

		// Exact match search
		for (var i = 0; i < product_variations.length; i++) {
			var v = product_variations[i];
			var sizeMatch = !size || (v.size && v.size.toString().trim() === size.toString().trim());
			var colorMatch = !color || (v.color && v.color.toString().trim() === color.toString().trim());

			if (size && color) {
				if (sizeMatch && colorMatch) {
					matchedVariant = v;
					break;
				}
			} else if (size) {
				if (sizeMatch) {
					matchedVariant = v;
					break;
				}
			} else if (color) {
				if (colorMatch) {
					matchedVariant = v;
					break;
				}
			}
		}

		if (matchedVariant && matchedVariant.price) {
			var price = parseFloat(matchedVariant.price);
			$('#display-item-price').text(formatCurrency(price));

			if (matchedVariant.old_price && parseFloat(matchedVariant.old_price) > price) {
				var oldPrice = parseFloat(matchedVariant.old_price);
				var discount = Math.round(((oldPrice - price) * 100) / oldPrice);

				$('#display-old-price').text(formatCurrency(oldPrice)).removeClass('d-none');
				$('#display-discount').text('-' + discount + '%').removeClass('d-none');
			} else {
				$('#display-old-price').addClass('d-none');
				$('#display-discount').addClass('d-none');
			}

			// Store matched variant ID on buttons
			$('.product_addtocart, .product_buy_now').data('variantid', matchedVariant.id);
		}
	}
}