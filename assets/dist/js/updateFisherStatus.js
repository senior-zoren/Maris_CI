$(document).ready(function () {
  $('input[type="checkbox"].status-checkbox').prop('checked', false);
  $('select[name^="status-"]').prop('disabled', true); 

  $('.status-checkbox').on('change', function () {
    var fisherId = $(this).data('fisher-id');
    var statusDropdown = $('select[name="status-' + fisherId + '"]');

    if ($(this).is(':checked')) {
      statusDropdown.prop('disabled', false);
      console.log('Checkbox checked, enabling dropdown for fisher_id:', fisherId);
    } else {
      statusDropdown.prop('disabled', true);
      console.log('Checkbox unchecked, disabling dropdown for fisher_id:', fisherId);
    }
  });

  $('select[name^="status-"]').on('change', function () {
    var dropdown = $(this);
    var fisherId = dropdown.attr('data-fisher-id');

    if (fisherId) {
      console.log("Dropdown changed, fisher_id:", fisherId);

      $('#check-' + fisherId).prop('checked', false);
      dropdown.prop('disabled', true); 
    } else {
      console.error("Fisher ID is undefined for the dropdown. Check HTML setup.");
    }
  });

  $('.status-update-form').on('change', 'select', function () {
    var fisherId = $(this).data('fisher-id');  
    var newStatus = $(this).val();  
    var currentRow = $(this).closest('tr');

    $.ajax({
      url: 'updateStatus.php',  
      method: 'POST',
      data: {
        fisher_id: fisherId,
        status: newStatus
      },
      dataType: 'json',  
      success: function (response) {
        if (response.success) {
          console.log(response.success ? 'Status updated successfully' : 'Error updating status: ' + response.message);

          if (newStatus === 'Inactive') {
            currentRow.remove();
            $('#inactiveTable').append(currentRow);
          } else {
            currentRow.remove();
            $('#activeTable').append(currentRow);
          }
        } else {
          alert('Error updating status: ' + response.message);
        }
      },
      error: function () {
        alert('AJAX error: Unable to update status.');
      }
    });
  });
});

