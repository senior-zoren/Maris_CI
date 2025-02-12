function filterTable() {
  const searchTerm = document.getElementById("searchBox").value.toLowerCase();
  const tableRows = document.querySelectorAll("#dataTable tbody tr");

  tableRows.forEach(row => {
    const rowText = row.innerText.toLowerCase();
    row.style.display = rowText.includes(searchTerm) ? "" : "none";
  });
}

function filterByGender(filter) {
  const rows = document.querySelectorAll("#dataTable tbody tr");

  rows.forEach(row => {
    const gender = row.cells[4].textContent.trim(); 
    if (filter === "All" || gender === filter) {
      row.style.display = ""; 
    } else {
      row.style.display = "none"; 
    }
  });
}

$(function () {
  $('#dataTable').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": false,
    "info": true,
    "autoWidth": false,
    "responsive": true,
  });

  document.querySelectorAll(".filter-option").forEach(option => {
    option.addEventListener("click", (e) => {
      e.preventDefault();
      const filter = option.getAttribute("data-filter");
      filterByGender(filter);
    });
  });
});