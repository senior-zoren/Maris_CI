$(document).ready(function () {
  $('input[type="checkbox"].status-checkbox').prop('checked', false); 
  $('select[name^="status-"]').prop('disabled', true); 

  $('.status-checkbox').on('change', function () {
    var farmerId = $(this).data('farmer-id');
    var statusDropdown = $('select[name="status-' + farmerId + '"]');

    if ($(this).is(':checked')) {
      statusDropdown.prop('disabled', false);
      console.log('Checkbox checked, enabling dropdown for farmer_id:', farmerId);
    } else {
      statusDropdown.prop('disabled', true);
      console.log('Checkbox unchecked, disabling dropdown for farmer_id:', farmerId);
    }
  });

  $('select[name^="status-"]').on('change', function () {
    var dropdown = $(this);
    var farmerId = dropdown.attr('data-farmer-id');

    if (farmerId) {
      console.log("Dropdown changed, farmer_id:", farmerId);

      $('#check-' + farmerId).prop('checked', false); 
      dropdown.prop('disabled', true); 
    } else {
      console.error("Farmer ID is undefined for the dropdown. Check HTML setup.");
    }
  });

  $('.status-update-form').on('change', 'select', function () {
    var farmerId = $(this).data('farmer-id');  
    var newStatus = $(this).val();  
    var currentRow = $(this).closest('tr');

    $.ajax({
      url: 'updateStatus.php', 
      method: 'POST',
      data: {
        farmer_id: farmerId,
        status: newStatus
      },
      success: function (response) {
        // Handle success (optional)
        var result = JSON.parse(response);
        if (result.success) {
          var result = JSON.parse(response);
          console.log(result.success ? 'Status updated successfully' : 'Error updating status: ' + result.message);
          if (newStatus === 'Inactive') {
            currentRow.remove();
            $('#inactiveTable').append(currentRow);
          } else {
            currentRow.remove(); table
            $('#activeTable').append(currentRow);
          }
        } else {
          alert('Error updating status: ' + result.message);
        }
      },
      error: function () {
        alert('AJAX error: Unable to update status.');
      }
    });
  });
});