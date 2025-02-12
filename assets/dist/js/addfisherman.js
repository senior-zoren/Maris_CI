$("#port").change(function () {
  let portId = $(this).val(); // Get selected port ID
  let barangaySelect = $("#barangay"); // Barangay dropdown

  fetch(`agriculturist/getBarangaysByPort/${portId}`) // Updated to use the controller
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    })
    .then((data) => {
      // Clear existing barangay options
      barangaySelect.empty();
      barangaySelect.append('<option value="">Select Barangay</option>');

      // Populate the barangay dropdown with new options
      data.forEach(function (brgy) {
        barangaySelect.append(
          `<option value="${brgy.brgy_id}">${brgy.brgy_name}</option>`
        );
      });
    })
    .catch((error) => {
      console.error("Error fetching barangays:", error);
    });
});

$(document).ready(function () {
  $(".select2").select2(); // Initialize Select2 for dropdowns
});

document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault();

  fetch("agriculturist/submitFisherProfile", { // Updated to use the controller
    method: "POST",
    body: new FormData(this),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      // Toast notification setup
      var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });

      if (data.status === "success") {
        Toast.fire({
          icon: "success",
          title: "Fisherman Profile Successfully Added.",
        });
        this.reset();
        resetForm();
      } else if (data.status === "warning") {
        Toast.fire({
          icon: "warning",
          title: data.message,
        });
      } else if (data.status === "error") {
        Toast.fire({
          icon: "error",
          title: data.message,
        });
      } else {
        console.log("Unexpected response format");
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      Swal.fire({
        icon: "error",
        title: "Network Error",
        text: "An error occurred during the submission process.",
      });
    });

  function resetForm() {
    $("#port").val("").trigger("change");
    $("#barangay").val("").trigger("change");
  }
});
