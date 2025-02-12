const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  didOpen: (toast) => {
    toast.addEventListener("mouseenter", Swal.stopTimer);
    toast.addEventListener("mouseleave", Swal.resumeTimer);
  },
});

$(document).ready(function () {
  $(".select2").select2();

  var selectedFarmerId = null;
  var selectedFarmerName = "";
  var dateOfCatch = "";
  var farmerItems = {};

  $("#farmerSelect").change(function () {
    var selectedOption = $(this).find("option:selected");
    if (selectedOption.length) {
      selectedFarmerId = $(this).val();
      selectedFarmerName = selectedOption.text().trim();

      if (selectedFarmerId) {
        // console.log("Valid farmer selected.");
      } else {
        // console.log("No farmer selected or invalid ID.");
      }
    } else {
      selectedFarmerId = null; 
      selectedFarmerName = ""; 
    }
  });

  $("#date_of_catch").change(function () {
    dateOfCatch = $(this).val();
  });

  $("#culture").change(function () {
    selectedCulture = $(this).val();
  });

  $("#speciesClassSelect").on("change", function () {
    var classId = $(this).val();
    if (classId) {
      $.ajax({
        url: "farmerReportPage.php",
        type: "GET",
        data: { class_id: classId },
        success: function (data) {
          $("#speciesSelect")
            .empty()
            .append('<option value="">Select Species</option>');
          data.forEach(function (species) {
            $("#speciesSelect").append(
              '<option value="' +
              species.common_name +
              '">' +
              species.common_name +
              "</option>"
            );
          });
        },
      });
    } else {
      $("#speciesSelect")
        .empty()
        .append('<option value="">Select Species</option>');
    }
  });

  $("#addItemButton").on("click", function () {
    var speciesSelect = document.getElementById("speciesSelect");
    var speciesId = speciesSelect.value;
    var speciesText = speciesSelect.options[speciesSelect.selectedIndex].text;
    var quantity = prompt("Enter quantity (kg):");
    if (isNaN(quantity) || quantity <= 0) {
      Toast.fire({
        icon: "error",
        title: "Please enter a valid quantity greater than zero.",
      });
      return;
    }
    var farmerId = $("#farmerSelect").val(); 

    if (quantity > 0 && speciesId && farmerId) {
      if (!farmerItems[farmerId]) {
        farmerItems[farmerId] = [];
      }
      farmerItems[farmerId].push({
        species: speciesText,
        quantity: quantity,
      });

      var addedList = document
        .getElementById("addedItemsTable")
        .getElementsByTagName("tbody")[0];

      var newRow = addedList.insertRow(); 
      var cell1 = newRow.insertCell(0); 
      var cell2 = newRow.insertCell(1); 
      var cell3 = newRow.insertCell(2); 

      cell1.textContent = speciesText; 
      cell2.className = "quantity-cell"; 
      cell2.textContent = quantity; 

      var removeButton = document.createElement("button");
      removeButton.type = "button";
      removeButton.className = "btn btn-danger btn-sm removeItem";

      var trashIcon = document.createElement("i");
      trashIcon.className = "far fa-trash-alt"; 
      removeButton.appendChild(trashIcon);

      removeButton.onclick = function () {
        newRow.remove(); 
        updateSubmitButtonState(); 
      };
      cell3.appendChild(removeButton); 

      $("#speciesClassSelect").val("").trigger("change");
      $("#speciesSelect")
        .empty()
        .append('<option value="">Select Species</option>');

      Toast.fire({
        icon: "success",
        title: speciesText + " added successfully!",
      });
    } else {
      Toast.fire({
        icon: "error",
        title:
          "Please select a species, enter a valid quantity, and select a farmer.",
      });
    }
  });

  function updateFarmerDetails() {
    var farmerId = $("#farmerSelect").val();

    if (!farmerId) return;

    if (!farmerItems[farmerId]) {
      farmerItems[farmerId] = {
        culture: ''
      };
    }

    var selectedCulture = $("#culture").val();
    if (selectedCulture !== null) {
      selectedCulture = selectedCulture.trim();
    } else {
      selectedCulture = ''; 
    }

    farmerItems[farmerId].culture = selectedCulture;

    // console.log(farmerItems);
  }

  $("#culture").on("change blur", updateFarmerDetails);

  $("#addedItemsTable").on("click", ".removeItem", function () {
    $(this).closest("tr").remove();
    updateSubmitButtonState();
  });

  $("#certify").change(function () {
    updateSubmitButtonState();
  });

  function updateSubmitButtonState() {
    if ($("#certify").is(":checked")) {
      $(".btn-submit").prop("disabled", false);
    } else {
      $(".btn-submit").prop("disabled", true);
    }
  }

  $(".btn-submit").click(function () {
    if (!selectedFarmerId || selectedFarmerName === "") {
      console.error("farmer ID or Name is not correctly retrieved.");
      Toast.fire({
        icon: "error",
        title: "No farmer selected. Please select a farmer.",
      });
      return;
    }

    if (!dateOfCatch) {
      Toast.fire({
        icon: "error",
        title: "Please provide the date of catch.",
      });
      return;
    }

    if (!selectedCulture) {
      Toast.fire({
        icon: "error",
        title: "Please select a farm culture.",
      });
      return;
    }

    var catchReportData = [];
    var farmerGeneralChartData = [];
    var farmerChartData = [];

    Object.keys(farmerItems).forEach(function (farmerId) {
      var items = farmerItems[farmerId];
      var farmerName = $("#farmerSelect option[value='" + farmerId + "']")
        .text()
        .trim();

      items.forEach(function (item) {
        catchReportData.push({
          farmer_id: farmerId,
          farmer: farmerName,
          species: item.species,
          quantity: item.quantity,
          date_of_catch: dateOfCatch,
          date_of_submission: new Date().toISOString().slice(0, 10), 
        });

        farmerGeneralChartData.push({
          species: item.species,
          gen_quantity: item.quantity,
          date_of_catch: dateOfCatch,
          date_of_submission: new Date().toISOString().slice(0, 10), 
        });

        // Add data to farmer chart array
        farmerChartData.push({
          farmer: farmerName,
          species: item.species,
          quantity: item.quantity,
          culture: items.culture,
          date_of_catch: dateOfCatch,
          date_of_submission: new Date().toISOString().slice(0, 10), 
        });
      });
    });

    // console.log("Catch Report Data:", JSON.stringify(catchReportData));
    // console.log("Farmer General Chart Data:", JSON.stringify(farmerGeneralChartData));
    // console.log("Farmer Chart Data:", JSON.stringify(farmerChartData));

    if (catchReportData.length > 0) {
      $.ajax({
        type: "POST",
        url: "farmerReportPage.php",
        data: {
          action: "submitReport",
          catchReportData: JSON.stringify(catchReportData),
          farmerGeneralChartData: JSON.stringify(farmerGeneralChartData),
          farmerChartData: JSON.stringify(farmerChartData),
        },
        success: function (response) {
          $("#savedReportTable tbody").html("");
          $("#farmerSelect").val("").trigger("change");
          $("#quantity").val("0.0");
          $("#date_of_catch").val("");
          $("#culture").val("").trigger("change");
          $("#certify").prop("checked", false);
          $(".btn-submit").prop("disabled", true);
          farmerItems = {};
          dateOfCatch = "";
          updateSubmitButtonState();

          Toast.fire({
            icon: "success",
            title: "Report submitted successfully!",
          });
        },
        error: function (xhr, status, error) {
          console.error("Error submitting report:", error);
          Toast.fire({
            icon: "error",
            title: "Error submitting report. Please try again.",
          });
        },
      });
    } else {
      Toast.fire({
        icon: "error",
        title: "No items to save.",
      });
    }
  });

  $("#clearAllButton").on("click", function () {
    $("#farmerSelect").val("").trigger("change");
    $("#speciesClassSelect").val("").trigger("change");
    $("#speciesSelect")
      .empty()
      .append('<option value="">Select Species</option>');
    $("#date_of_catch").val("");
    $("#culture").val("").trigger("change");
    $("#certify").prop("checked", false);
    $(".btn-submit").prop("disabled", true);
    farmerItems = {};
    dateOfCatch = "";
    selectedCulture = "";

    $("#addedItemsTable tbody").empty();
    $("#savedReportTable tbody").empty();

    Toast.fire({
      icon: "success",
      title: "All items cleared successfully!",
    });
  });

  $("#saveItemButton").click(function () {
    var savedReportData = [];
    var selectedCulture = $("#culture").val().trim();

    if (!selectedCulture) {
      alert("Please enter the operation distance.");
      return;
    }

    $("#addedItemsTable tbody tr").each(function () {
      var species = $(this).find("td:eq(0)").text().trim(); 
      var quantity = $(this).find("td:eq(1)").text().trim(); 

      savedReportData.push({
        farmer_id: selectedFarmerId,
        farmer: selectedFarmerName,
        species: species,
        quantity: quantity,
        culture: selectedCulture,
      });

      var newRow = `
            <tr>
                <td>${selectedFarmerName}</td>
                <td>${species}</td>
                <td>${quantity}</td>
                <td>${selectedCulture}</td>
            </tr>`;
      $("#savedReportTable tbody").append(newRow);
    });

    if (savedReportData.length > 0) {
      // console.log("Saved Report Data: ", JSON.stringify(savedReportData));
      Toast.fire({
        icon: "success",
        title: "Items saved successfully!",
      });
      resetFormState()
    } else {
      Toast.fire({
        icon: "error",
        title: "No items to save.",
      });
    }
  });

   function resetFormState() {
    $("#addedItemsTable tbody").html("");
    $("#culture").val("");
  }
});
