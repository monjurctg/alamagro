// Variation Selection Logic - Robust Version 2.0 (External File)
jQuery(document).ready(function ($) {
    console.log("home_variation.js loaded successfully. v2.0");

    $(document).on("click", ".homepage-addtocart", function (event) {
        event.preventDefault();
        console.log("Add to cart clicked! (External JS)");

        var id = $(this).attr('data-id'); // Use attr to ensure string
        var sizeStr = $(this).attr('data-variation-size');
        var colorStr = $(this).attr('data-variation-color');
        console.log("Product ID:", id, "SizeStr:", sizeStr, "ColorStr:", colorStr);

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
            sizes.forEach(function (size) {
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
            // If we show modal for color, show size as well (but locked/selected) // No, hide if single? User says "auto select".
            // If color needs modal, we might want to show size for confirmation?
            // Current logic: If color is multi, show color. Size is auto-selected hidden unless we explicitly show it.
            // Let's show it if Color is shown, so user sees context.
            if (colors.length > 1) $('#variation-size-group').show();
        }

        // Color Logic
        if (colors.length > 1) {
            needsModal = true;
            $('#variation-color-group').show();
            var colorHtml = '';
            colors.forEach(function (color) {
                colorHtml += `<div class="variation-option color-option" data-value="${color.trim()}">${color.trim()}</div>`;
            });
            $('#variation-color-options').html(colorHtml);
        } else if (colors.length === 1) {
            autoColor = colors[0].trim();
            console.log("Auto-selecting color:", autoColor);
            var colorHtml = `<div class="variation-option color-option active" data-value="${autoColor}">${autoColor}</div>`;
            $('#variation-color-options').html(colorHtml);
            $('#variation_selected_color').val(autoColor);
            if (sizes.length > 1) $('#variation-color-group').show();
        }

        if (needsModal) {
            console.log("Showing modal...");
            // Show Modal
            if (typeof bootstrap !== 'undefined') {
                var el = document.getElementById('variationModal');
                // Use Bootstrap 5 API safely
                var variationModal = bootstrap.Modal.getInstance(el);
                if (!variationModal) {
                    variationModal = new bootstrap.Modal(el);
                }
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

    $(document).on('click', '.variation-option.size-option', function () {
        $('.variation-option.size-option').removeClass('active');
        $(this).addClass('active');
        $('#variation_selected_size').val($(this).data('value'));
    });

    $(document).on('click', '.variation-option.color-option', function () {
        $('.variation-option.color-option').removeClass('active');
        $(this).addClass('active');
        $('#variation_selected_color').val($(this).data('value'));
    });

    $('#confirm-add-to-cart').on('click', function () {
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
            if (modal) modal.hide();
            else $(modalEl).modal('hide');
        } else {
            $('#variationModal').modal('hide');
        }

        // Add to Cart with selections
        addToCartDirect(id, 1, size, color);
    });

    function showError(msg) {
        if (typeof onErrorMsg === 'function') {
            onErrorMsg(msg);
        } else {
            alert(msg);
        }
    }

    function addToCartDirect(id, qty, size = null, color = null) {
        var url = base_url + "/frontend/add_to_cart/" + id + "/" + qty;

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
                    if (typeof onSuccessMsg === 'function') onSuccessMsg(msg);
                    else alert(msg);
                } else {
                    showError(msg);
                }
                // Try to update cart view if function exists
                if (typeof onViewCart === 'function') {
                    onViewCart();
                } else {
                    console.warn("onViewCart function not defined");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", error, xhr.status, xhr.responseText);
                if (xhr.status == 500) {
                    showError("Server error (500). Item may be added, but cart failed to update.");
                } else {
                    showError("Something went wrong. Please try again.");
                }
            }
        });
    }
});
