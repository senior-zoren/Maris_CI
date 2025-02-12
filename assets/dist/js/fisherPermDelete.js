async function confirmFisherDeletion(fisherId) {
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
    await deleteFisherman(fisherId);
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    swalWithBootstrapButtons.fire({
      title: "Cancelled",
      text: "Be careful next time!",
      icon: "error",
    });
  }
}

async function deleteFisherman(fisherId) {
  try {
    const response = await fetch("fisherPermDelete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({ fisher_id: fisherId }),
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

async function confirmDeleteAllFisher() {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  const isTableEmpty = await checkTableEmpty();

  if (isTableEmpty) {
    Swal.fire({
      title: "Warning",
      text: "There are no profiles to delete. The table is empty.",
      icon: "warning",
    });
    return;
  }

  const result = await swalWithBootstrapButtons.fire({
    title: "Delete All Profiles?",
    text: "This will permanently remove all archived profiles. This action cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Yes, delete all!",
    cancelButtonText: "No, cancel!",
    reverseButtons: true,
  });

  if (result.isConfirmed) {
    try {
      const response = await fetch("fisherPermDelete.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({ action: "delete_all" }),
      });

      if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`);
      }

      const data = await response.json();

      if (data.success) {
        Swal.fire({
          title: "Deleted!",
          text: "All profiles have been deleted.",
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
          "Could not delete all profiles. Please try again later.",
        icon: "error",
      });
    }
  } else if (result.dismiss === Swal.DismissReason.cancel) {
    swalWithBootstrapButtons.fire({
      title: "Cancelled",
      text: "No changes made.",
      icon: "error",
    });
  }
}

// Helper function to check if the profile exists
async function checkProfileExists(fisherId) {
  try {
    const response = await fetch("fisherPermDelete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({ fisher_id: fisherId }),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    return data.exists;
  } catch (error) {
    console.error("Error checking profile existence:", error);
    return false;
  }
}

// Helper function to check if the table is empty
async function checkTableEmpty() {
  try {
    const response = await fetch("fisherPermDelete.php");

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    const data = await response.json();
    return data.empty;
  } catch (error) {
    console.error("Error checking table status:", error);
    return false;
  }
}
