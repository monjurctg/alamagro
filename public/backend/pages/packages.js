var $ = jQuery.noConflict();
$(function () {
	"use strict";

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	resetForm("DataEntry_formId");

	$("#submit-form").on("click", function () {
        $("#DataEntry_formId").submit();
    });

	$(document).on('click', '.ProductCategories nav ul.pagination a', function(event){
		event.preventDefault();
		var page = $(this).attr('href').split('page=')[1];
		onPaginationDataLoad(page);
	});

	$('input:checkbox').prop('checked',false);

    $(".checkAll").on("click", function () {
        $("input:checkbox").not(this).prop("checked", this.checked);
    });

	$("#is_featured").chosen();
	$("#is_featured").trigger("chosen:updated");

	$("#is_publish").chosen();
	$("#is_publish").trigger("chosen:updated");

	$("#on_thumbnail").on("click", function () {
		media_type = 'Product_Thumbnail';
		onGlobalMediaModalView();
    });

	$("#on_subheader_image").on("click", function () {
		media_type = 'Subheader';
		onGlobalMediaModalView();
    });

	$("#on_og_image").on("click", function () {
		media_type = 'SEO_Image';
		onGlobalMediaModalView();
    });

	$("#media_select_file").on("click", function () {

		var thumbnail = $("#thumbnail").val();

		if(media_type == 'Product_Thumbnail'){

			if(thumbnail !=''){
				$("#category_thumbnail").val(thumbnail);
				$("#view_category_thumbnail").html('<img src="'+public_path+'/media/'+thumbnail+'">');
			}

			$("#remove_category_thumbnail").show();

		} else if (media_type == 'Subheader') {
			if(thumbnail !=''){
				$("#subheader_image").val(thumbnail);
				$("#view_subheader_image").html('<img src="'+public_path+'/media/'+thumbnail+'">');
			}

			$("#remove_subheader_image").show();

		} else if (media_type == 'SEO_Image') {

			if(thumbnail !=''){
				$("#og_image").val(thumbnail);
				$("#view_og_image").html('<img src="'+public_path+'/media/'+thumbnail+'">');
			}

			$("#remove_og_image").show();
		}

		$('#global_media_modal_view').modal('hide');
    });

	$("#name").on("blur", function () {
		if(RecordId ==''){
			onCategorySlug();
		}
	});

	$("#language_code").val(0).trigger("chosen:updated");

	$("#language_code").on("change", function () {
		onRefreshData();
	});

});
// Add/Edit AJAX
function onConfirmWhenAddEdit() {
    $.ajax({
        type: 'POST',
        url: base_url + '/admin/packages/store',
        data: $('#DataEntry_formId').serialize(),
        success: function (response) {
            if (response.success) {
                alert(response.message);
                location.reload();
            } else {
                alert('Error saving package!');
            }
        },
        error: function () {
            alert('Something went wrong!');
        }
    });
}

// Edit
function onEdit(id) {
    $.get(base_url + '/admin/packages/edit/' + id, function (data) {
        $('#title').val(data.title);
        $('#subtitle').val(data.subtitle);
        $('#price').val(data.price);
        $('#frequency').val(data.frequency);
        $('#duration').val(data.duration);
        $('#type').val(data.type);
        $('#features').val(data.features ? data.features.join(", ") : "");
        $('#is_popular').prop('checked', data.is_popular ? true : false);
        $('#status').val(data.status);
        $('#RecordId').val(data.id);

        $('#lan').trigger("chosen:updated");
        $('#status').trigger("chosen:updated");

        onFormPanel();
    });
}


// Delete
function onDelete(id) {
    if (confirm('Do you really want to delete this record?')) {
        $.ajax({
            url: base_url + '/admin/packages/delete/' + id,
            type: 'DELETE',
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert('Failed to delete package');
                }
            }
        });
    }
}

// Bulk action
function onBulkAction() {
    var action = $('#bulk-action').val();
    var ids = [];
    $('.selected_item:checked').each(function () {
        ids.push($(this).val());
    });

    if (!action) {
        alert('Please select action');
        return;
    }

    if (ids.length == 0) {
        alert('Please select record');
        return;
    }

    if (confirm('Do you really want to ' + action + ' selected records?')) {
        $.post(base_url + '/admin/packages/bulk-action', { action: action, ids: ids }, function (response) {
            if (response.success) {
                location.reload();
            } else {
                alert('Action failed');
            }
        });
    }
}

// Search (optional)
function onSearch() {
    var search = $('#search').val();
    window.location.href = base_url + '/admin/packages?search=' + search;
}

// Toggle Form/List panels
function onFormPanel() {
    $('#list-panel').hide();
    $('#form-panel').show();
}

function onListPanel() {
    $('#form-panel').hide();
    $('#list-panel').show();
}
