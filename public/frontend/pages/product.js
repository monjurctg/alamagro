var $ = jQuery.noConflict();

$(function () {
	"use strict";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '.pagination a', function(event){
		event.preventDefault();
		var page = $(this).attr('href').split('page=')[1];
		onPaginationDataLoad(page);
	});

	// Handle variation selection
	$(document).on('click', '.size-option, .color-option', function() {
		$(this).addClass('active').siblings().removeClass('active');

		// Get selected size and color
		var selectedSize = $('.size-option.active').data('size');
		var selectedColor = $('.color-option.active').data('color');

		// Update variation details display
		updateVariationDetails(selectedSize, selectedColor);
	});

});

function onPaginationDataLoad(page) {

	$.ajax({
		url:base_url + "/frontend/getProductReviewsGrid",
		data:{page:page,item_id:item_id},
		success:function(data){
			$('#tp_datalist').html(data);
		}
	});
}

// Update variation details display
function updateVariationDetails(size, color) {
	var variationDetails = '';
	if (size) variationDetails += 'Size: ' + size;
	if (color) variationDetails += (variationDetails ? ', ' : '') + 'Color: ' + color;

	if (variationDetails) {
		$('#variation-details').text(variationDetails);
		$('#selected-variation-info').removeClass('d-none');
	} else {
		$('#selected-variation-info').addClass('d-none');
	}
}