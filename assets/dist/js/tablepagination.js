

$(document).ready(function () {
  $(document).on('change', 'input[type="checkbox"]', function () {
    if ($(this).is(':checked')) {
      const notifId = $(this).data('notif-id');

      $.ajax({
        url: 'notificationPage.php',
        type: 'POST',
        data: { notif_id: notifId },
        dataType: 'json',
        success: function (response) {
          if (response.status === "success") {

            // Disable the checkbox and mark it as 'Read'
            $(`#check${notifId}`).prop('disabled', true);
            $(`#check${notifId}`).closest('tr').removeClass('unread');
            $(`#check${notifId}`).closest('tr').find('.mailbox-subject, .mailbox-message, .mailbox-date').css('color', 'gray');

          } else {
            console.error(response.message);
          }
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error("AJAX Error:", textStatus, errorThrown);
        }
      });
    }
  });

  $('input[type="checkbox"]').each(function () {
    const status = $(this).data('status');

    if (status === 'Read') {
      $(this).prop('checked', true);
      $(this).prop('disabled', true);
      $(this).closest('tr').removeClass('unread');
      $(this).closest('tr').find('.mailbox-subject, .mailbox-message, .mailbox-date').css('color', 'gray');
    }
  });
});

const rowsPerPage = 10;
let currentPage = 1;

const tableBody = document.querySelector("#notifTable tbody");
const rows = tableBody.getElementsByTagName("tr");

const prevPageBtn = document.getElementById("prevPageBtn");
const nextPageBtn = document.getElementById("nextPageBtn");
const pageNumberElem = document.getElementById("pageNumber");
const totalPagesElem = document.getElementById("totalPages");

function showPage(page) {
  const startIndex = (page - 1) * rowsPerPage;
  const endIndex = startIndex + rowsPerPage;

  for (let i = 0; i < rows.length; i++) {
    rows[i].style.display = "none";
  }

  for (let i = startIndex; i < endIndex && i < rows.length; i++) {
    rows[i].style.display = "";
  }

  pageNumberElem.textContent = page;

  prevPageBtn.disabled = currentPage === 1;
  nextPageBtn.disabled = currentPage === Math.ceil(rows.length / rowsPerPage);
}

function nextPage() {
  if (currentPage < Math.ceil(rows.length / rowsPerPage)) {
    currentPage++;
    showPage(currentPage);
  }
}

function prevPage() {
  if (currentPage > 1) {
    currentPage--;
    showPage(currentPage);
  }
}

function initializePagination() {
  const totalPages = Math.ceil(rows.length / rowsPerPage);
  totalPagesElem.textContent = totalPages;
  showPage(currentPage);
}

prevPageBtn.addEventListener("click", prevPage);
nextPageBtn.addEventListener("click", nextPage);

initializePagination();