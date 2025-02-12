    // Function to filter the table based on search input
    function filterTable() {
      const searchTerm = document.getElementById("searchBox").value.toLowerCase();
      const tableRows = document.querySelectorAll("#activeTable tbody tr");

      tableRows.forEach(row => {
        const rowText = row.innerText.toLowerCase();
        row.style.display = rowText.includes(searchTerm) ? "" : "none";
      });
    }

    // Function to filter the table based on gender
    function filterByGender(filter) {
      const rows = document.querySelectorAll("#activeTable tbody tr");

      rows.forEach(row => {
        const gender = row.cells[4].textContent.trim(); // Gender column (5th column)
        if (filter === "All" || gender === filter) {
          row.style.display = ""; // Show row
        } else {
          row.style.display = "none"; // Hide row
        }
      });
    }

    $(document).ready(function () {
      const table = $('#activeTable');

      // Check if table is empty before initializing DataTable
      if (table.find('tbody tr').length > 0) {
        // Initialize DataTable if there are rows in the table
        if (!$.fn.DataTable.isDataTable('#activeTable')) {
          table.DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        }
      } else {
        console.warn("Table is empty, DataTables not initialized.");
      }

      // Add event listeners to gender filter options
      document.querySelectorAll(".filter-option").forEach(option => {
        option.addEventListener("click", (e) => {
          e.preventDefault();
          const filter = option.getAttribute("data-filter");
          filterByGender(filter);
        });
      });
    });