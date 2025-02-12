$(function () {
  $(".select2").select2();

  $("#port").change(function () {
    let portId = $(this).val();

    if (!portId) return;

    $.ajax({
      url: "updateFarmerPage.php",
      method: "GET",
      data: { port_id: portId },
      success: function (data) {
        let barangaySelect = $("#barangay");
        barangaySelect.empty(); 
        barangaySelect.append(
          '<option value="" disabled selected>Select Barangay</option>'
        );

        data.forEach(function (brgy) {
          barangaySelect.append(
            `<option value="${brgy.brgy_id}">${brgy.brgy_name}</option>`
          );
        });

        barangaySelect.select2();

        let selectedBrgyId =
          '<?php echo isset($address["brgy_id"]) ? $address["brgy_id"] : ""; ?>';
        if (selectedBrgyId) {
          barangaySelect.val(selectedBrgyId).trigger("change"); 
        }
      },
      error: function () {
        alert("Failed to fetch barangays.");
      },
    });
  });

  if ($("#port").val()) {
    $("#port").trigger("change");
  }

  $("#birthdate").on("change", calculateAge);

  function calculateAge() {
    var birthdate = document.getElementById("birthdate").value;
    if (birthdate) {
      var birthDateObj = new Date(birthdate);
      var today = new Date();
      var age = today.getFullYear() - birthDateObj.getFullYear();
      var monthDiff = today.getMonth() - birthDateObj.getMonth();
      if (
        monthDiff < 0 ||
        (monthDiff === 0 && today.getDate() < birthDateObj.getDate())
      ) {
        age--;
      }
      document.getElementById("age").value = age;
    } else {
      document.getElementById("age").value = "";
    }
  }
});
