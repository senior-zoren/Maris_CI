async function confirmDelete(userId) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  const result = await swalWithBootstrapButtons.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel!",
    reverseButtons: true,
  });

  if (result.isConfirmed) {
    await deleteUserman(userId);
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    swalWithBootstrapButtons.fire({
      title: "Cancelled",
      text: "Be careful next time!",
      icon: "error",
    });
  }
}

async function deleteUserman(userId) {
  try {
    const response = await fetch("accountDelete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({ user_id: userId }),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();

    if (data.success) {
      Swal.fire({
        title: "Deleted!",
        text: "Profile has been deleted.",
        icon: "success",
        showConfirmButton: false,
        timer: 3000,
      }).then(() => {
        location.reload();
      });
    } else {
      Swal.fire({
        title: "Error",
        text: data.message || "An error occurred.",
        icon: "error",
      });
    }
  } catch (error) {
    Swal.fire({
      title: "Error",
      text:
        error.message ||
        "Could not delete the profile. Please try again later.",
      icon: "error",
    });
  }
}

