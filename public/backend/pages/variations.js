var $ = jQuery.noConflict();

$(function () {
	"use strict";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$("#submit-form").on("click", function () {
        $("#DataEntry_formId").submit();
    });

	// Add Variant Row buttons
	$("#btn-add-variant-row, #btn-add-variant-row-bottom").on("click", function () {
		addVariantRow();
	});

	// Remove Variant Row
	$(document).on("click", ".btn-remove-row", function () {
		$(this).closest("tr").remove();
		reIndexDefaultRadios();
	});
});

function addVariantRow(size, color, price, old_price, stock_qty, sku) {
	size = size || '';
	color = color || '';
	price = price || '';
	old_price = old_price || '';
	stock_qty = stock_qty || '';
	sku = sku || '';

	var rowCount = $("#variant-rows-container tr").length;
	var isChecked = rowCount === 0 ? 'checked' : '';

	var html = '<tr class="variant-row">' +
		'<td><input type="text" name="variant_size[]" class="form-control form-control-sm" value="' + size + '" placeholder="e.g. 1 Gallon"></td>' +
		'<td><input type="text" name="variant_color[]" class="form-control form-control-sm" value="' + color + '" placeholder="e.g. 300 GSM"></td>' +
		'<td><input type="number" step="0.01" name="variant_price[]" class="form-control form-control-sm variant-price" value="' + price + '" placeholder="80" required></td>' +
		'<td><input type="number" step="0.01" name="variant_old_price[]" class="form-control form-control-sm" value="' + old_price + '" placeholder="100"></td>' +
		'<td><input type="number" name="variant_stock_qty[]" class="form-control form-control-sm" value="' + stock_qty + '" placeholder="999"></td>' +
		'<td><input type="text" name="variant_sku[]" class="form-control form-control-sm" value="' + sku + '" placeholder="SKU-1"></td>' +
		'<td class="text-center align-middle"><input type="radio" name="variant_default" value="' + rowCount + '" ' + isChecked + '></td>' +
		'<td class="text-center align-middle"><button type="button" class="btn btn-sm btn-danger btn-remove-row"><i class="fa fa-trash"></i></button></td>' +
		'</tr>';

	$("#variant-rows-container").append(html);
}

function reIndexDefaultRadios() {
	$("#variant-rows-container tr").each(function (index) {
		$(this).find('input[type="radio"]').val(index);
	});
}

function showPerslyError() {
    $('.parsley-error-list').show();
}

jQuery('#DataEntry_formId').parsley({
    listeners: {
        onFieldValidate: function (elem) {
            if (!$(elem).is(':visible')) {
                return true;
            }
            else {
                showPerslyError();
                return false;
            }
        },
        onFormSubmit: function (isFormValid, event) {
            if (isFormValid) {
                onConfirmWhenAddEdit();
                return false;
            }
        }
    }
});

function onConfirmWhenAddEdit() {
    $.ajax({
		type : 'POST',
		url: base_url + '/backend/saveVariationsData',
		data: $('#DataEntry_formId').serialize(),
		success: function (response) {			
			var msgType = response.msgType;
			var msg = response.msg;
			if (msgType == "success") {
				onSuccessMsg(msg);
			} else {
				onErrorMsg(msg);
			}
		}
	});
}
