var $ = jQuery.noConflict();

$(function () {
    "use strict";

    // Setup CSRF
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Submit form
    $("#submit-form").on("click", function () {
        $("#DataEntry_formId").submit();
    });

    // Initialize chosen selects
    $("#lan, #status").chosen();
    $("#lan").trigger("chosen:updated");
    $("#status").trigger("chosen:updated");

    // Parsley validation
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
