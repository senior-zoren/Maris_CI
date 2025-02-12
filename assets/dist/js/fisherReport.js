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

  $('#operationPeriod').daterangepicker({
    timePicker: true,
    timePickerIncrement: 15,
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  })

  var selectedFishermanId = null;
  var selectedFishermanName = "";
  var dateOfCatch = "";
  var fishermanItems = {};

  var selectedEquipments = [];

  $("#fishermanSelect").change(function () {
    var selectedOption = $(this).find("option:selected");
    if (selectedOption.length) {
      selectedFishermanId = $(this).val();
      selectedFishermanName = selectedOption.text().trim();

      if (selectedFishermanId) {
        // console.log("Valid fisherman selected.");
      } else {
        // console.log("No fisherman selected or invalid ID.");
      }
    } else {
      selectedFishermanId = null;
      selectedFishermanName = "";
    }
  });

  $("#equipments").change(function () {
    var selectedOptions = $(this).find("option:selected");
    selectedEquipments = []; 

    selectedOptions.each(function () {
      selectedEquipments.push($(this).text().trim());
    });
  });


  $("#distance").change(function () {
    operationDistance = $(this).val();
  });

  $("#operationPeriod").change(function () {
    operationPeriod = $(this).val().trim();
    [operationStart, operationEnd] = operationPeriod.split(" - ");

    operationStart = formatDateToMySQL(operationStart);
    operationEnd = formatDateToMySQL(operationEnd);
  });

  function formatDateToMySQL(dateString) {
    var date = moment(dateString, 'MM/DD/YYYY hh:mm A');
    return date.isValid() ? date.format('YYYY-MM-DD HH:mm:ss') : ''; 
  }

  $("#date_of_catch").change(function () {
    dateOfCatch = $(this).val();
  });

  $("#speciesClassSelect").on("change", function () {
    var classId = $(this).val();
    if (classId) {
      $.ajax({
        url: "fisherReportPage.php",
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
    var fishermanId = $("#fishermanSelect").val();

    if (quantity > 0 && speciesId && fishermanId) {
      if (!fishermanItems[fishermanId]) {
        fishermanItems[fishermanId] = [];
      }
      fishermanItems[fishermanId].push({
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
        fishermanItems = {}; 
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
          "Please select a species, enter a valid quantity, and select a fisherman.",
      });
    }
  });

  function updateFishermanDetails() {
    var fishermanId = $("#fishermanSelect").val();

    if (!fishermanId) return;

    if (!fishermanItems[fishermanId]) {
      fishermanItems[fishermanId] = {
        equipment: [],
        distance: '',
        operationPeriod: {}
      };
    }

    var selectedEquipments = [];
    $("#equipments").find("option:selected").each(function () {
      selectedEquipments.push($(this).text().trim());
    });

    var operationDistance = $("#distance").val().trim();
    var operationPeriod = $("#operationPeriod").val().trim();
    var [operationStart, operationEnd] = operationPeriod ? operationPeriod.split(" - ") : ["", ""];

    fishermanItems[fishermanId].equipment = selectedEquipments;
    fishermanItems[fishermanId].distance = operationDistance;
    fishermanItems[fishermanId].operationPeriod = { start: operationStart, end: operationEnd };
  }

  $("#equipments, #distance, #operationPeriod").on("change blur", updateFishermanDetails);

  function formatDateToMySQL(dateString) {
    var [month, day, year] = dateString.split("/");
    return `${year}-${month}-${day}`;
  }

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
    if (!selectedFishermanId || selectedFishermanName === "") {
      console.error("Fisherman ID or Name is not correctly retrieved.");
      Toast.fire({
        icon: "error",
        title: "No fisherman selected. Please select a fisherman.",
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

    var catchReportData = [];
    var fisherGenChartData = [];
    var fisherChartData = [];

    Object.keys(fishermanItems).forEach(function (fishermanId) {
      var items = fishermanItems[fishermanId];
      var fishermanName = $(
        "#fishermanSelect option[value='" + fishermanId + "']"
      )
        .text()
        .trim();

      items.forEach(function (item) {
        catchReportData.push({
          fisherman_id: fishermanId,
          fisherman: fishermanName,
          species: item.species,
          quantity: item.quantity,
          date_of_catch: dateOfCatch,
          date_of_submission: new Date().toISOString().slice(0, 10),
        });

        fisherGenChartData.push({
          species: item.species,
          gen_quantity: item.quantity,
          date_of_catch: dateOfCatch,
          date_of_submission: new Date().toISOString().slice(0, 10),
        });

        fisherChartData.push({
          fisherman: fishermanName,
          species: item.species,
          quantity: item.quantity,
          equipments: items.equipment,
          distance: items.distance || 0,
          operation_start: items.operationPeriod.start,
          operation_end: items.operationPeriod.end,
          date_of_catch: dateOfCatch,
          date_of_submission: new Date().toISOString().slice(0, 10),
        });
      });
    });

    if (catchReportData.length > 0) {
      $.ajax({
        type: "POST",
        url: "fisherReportPage.php",
        data: {
          action: "submitReport",
          catchReportData: JSON.stringify(catchReportData),
          fisherGenChartData: JSON.stringify(fisherGenChartData),
          fisherChartData: JSON.stringify(fisherChartData),
        },
        success: function (response) {
          $("#savedReportTable tbody").html(""); 
          $("#fishermanSelect").val("").trigger("change"); 
          $("#quantity").val("0.0"); 
          $("#equipments").val("").trigger("change"); 
          $("#distance").val(""); 
          $("#operationPeriod").val(""); 
          $("#date_of_catch").val(""); 
          $("#certify").prop("checked", false); 
          $(".btn-submit").prop("disabled", true); 
          fishermanItems = {}; 
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
    $("#fishermanSelect").val("").trigger("change");
    $("#speciesClassSelect").val("").trigger("change");
    $("#speciesSelect")
      .empty()
      .append('<option value="">Select Species</option>');
    $("#equipments").val([]).trigger("change");
    $("#operationPeriod").val("");
    $("#distance").val("").trigger("change");
    $("#date_of_catch").val("")
    $("#certify").prop("checked", false);
    $(".btn-submit").prop("disabled", true);
    fishermanItems = {};
    dateOfCatch = "";
    selectedEquipments = [];

    $("#addedItemsTable tbody").empty(); 
    $("#savedReportTable tbody").empty(); 

    Toast.fire({
      icon: "success",
      title: "All items cleared successfully!",
    });
  });

  $("#saveItemButton").click(function () {
    var savedReportData = [];

    var operationDistance = $("#distance").val().trim();
    var operationPeriod = $("#operationPeriod").val().trim();
    var [operationStart, operationEnd] = operationPeriod ? operationPeriod.split(" - ") : ["", ""];

    if (operationStart && operationEnd) {
      operationStart = formatDateToMySQL(operationStart);
      operationEnd = formatDateToMySQL(operationEnd);
    }

    var selectedFishermanId = $("#fishermanSelect").val();
    var selectedFishermanName = $("#fishermanSelect option:selected").text().trim();

    if (!operationStart || !operationEnd) {
      alert("Please select a valid operation period.");
      return;
    }

    if (!selectedFishermanId || !selectedFishermanName) {
      alert("Please select a fisherman.");
      return;
    }

    if (!operationDistance) {
      alert("Please enter the operation distance.");
      return;
    }

    if (selectedEquipments.length === 0) {
      alert("Please select at least one equipment.");
      return;
    }

    $("#addedItemsTable tbody tr").each(function () {
      var species = $(this).find("td:eq(0)").text().trim();
      var quantity = $(this).find("td:eq(1)").text().trim();

      if (!species || !quantity) {
        alert("Please provide species and quantity for all items.");
        return false;  
      }

      savedReportData.push({
        fisherman_id: selectedFishermanId,
        fisherman: selectedFishermanName,
        species: species,
        quantity: quantity,
        equipments: selectedEquipments.slice(),
        distance: operationDistance,
        start: operationStart,
        end: operationEnd
      });

      var newRow = `
      <tr>
          <td>${selectedFishermanName}</td>
          <td>${species}</td>
          <td>${quantity}</td>
          <td>${selectedEquipments.join(", ")}</td>
          <td>${operationDistance}</td>
          <td>${operationStart}</td>
          <td>${operationEnd}</td>
      </tr>`;
      $("#savedReportTable tbody").append(newRow);
    });

    if (savedReportData.length > 0) {
      Toast.fire({
        icon: "success",
        title: "Items saved successfully!",
      });
      resetFormState();
    } else {
      Toast.fire({
        icon: "error",
        title: "No items to save.",
      });
    }
  });

  function resetFormState() {
    $("#addedItemsTable tbody").html("");
    selectedEquipments = [];
    $("#equipments").val([]);
    $("#operationPeriod").val("");
    $("#distance").val("");
  }

  function formatDateToMySQL(dateString) {
    var date = moment(dateString, 'MM/DD/YYYY hh:mm A');
    return date.isValid() ? date.format('YYYY-MM-DD HH:mm:ss') : '';
  }


});
