var $ = jQuery.noConflict();
var RecordId = '';
var BulkAction = '';
var ids = [];

$(function () {
    "use strict";

    // CSRF setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Reset form when loading
    resetForm("DataEntry_formId");

    // Save button click
    $("#submit-form").on("click", function () {
        console.log("clicking")
        $("#DataEntry_formId").submit();
    });

    // Handle form submit
    $("#DataEntry_formId").on("submit", function (e) {
        e.preventDefault();
        onConfirmWhenAddEdit();
    });

    // Pagination (if needed)
    $(document).on('click', '.ProductCategories nav ul.pagination a', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        onPaginationDataLoad(page);
    });

    // Check all checkbox
    $('input:checkbox').prop('checked', false);
    $(".checkAll").on("click", function () {
        $("input:checkbox").not(this).prop("checked", this.checked);
    });
});
function resetForm(id) {
    $('#' + id).each(function () {
        this.reset();
    });
}

// =============== Add/Edit AJAX ===============
function onConfirmWhenAddEdit() {
    console.log($('#DataEntry_formId').serialize());
    
    $.ajax({
        type: 'POST',
        url: base_url + '/backend/packages/store',
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


// =============== Edit Package ===============
function onEdit(id) {
    $.get(base_url + '/backend/packages/edit/' + id, function (data) {
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

        $('#status').trigger("chosen:updated");

        onFormPanel();
    });
}


// =============== Delete Package ===============
function onDelete(id) {
    if (confirm('Do you really want to delete this record?')) {
        $.ajax({
            url: base_url + '/backend/packages/delete/' + id,
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


// =============== Bulk Action ===============
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


// =============== Search ===============
function onSearch() {
    var search = $('#search').val();
    window.location.href = base_url + '/admin/packages?search=' + search;
}


// =============== Panel Toggles ===============
function onFormPanel() {
    $('#list-panel').hide();
    $('#form-panel').show();
}

function onListPanel() {
    $('#form-panel').hide();
    $('#list-panel').show();
}
