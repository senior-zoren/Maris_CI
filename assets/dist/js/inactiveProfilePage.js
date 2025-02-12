function filterTable() {
  const searchTerm = document.getElementById("searchBox").value.toLowerCase();
  const tableRows = document.querySelectorAll("#inactiveTable tbody tr");

  tableRows.forEach(row => {
    const rowText = row.innerText.toLowerCase();
    row.style.display = rowText.includes(searchTerm) ? "" : "none";
  });
}

$(document).ready(function () {
  var table = $('#inactiveTable');

  if (table.find('tbody tr').length > 0) {
    if (!$.fn.DataTable.isDataTable('#inactiveTable')) {
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
});