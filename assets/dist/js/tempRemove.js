function confirmDeletion(fisherId = null, farmerId = null) {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  function askReason(fisherId, farmerId) {
    Swal.fire({
      title: "Why do you want to archive this profile?",
      icon: "question",
      input: 'select',
      inputOptions: {
        'Deceased': 'Deceased',
        'Retired': 'Retired',
        'Out of Commission': 'Out of Commission',
        'Waved': 'Waved',
        'Illegal Fisher': 'Illegal Fisher',
        'Other': 'Other (specify below)',
      },
      inputPlaceholder: 'Select a reason',
      showCancelButton: true,
      cancelButtonText: "Cancel",
      confirmButtonText: "Confirm Archival",
      inputValidator: (value) => {
        if (!value) {
          return 'You need to select a reason!';
        }
      },
      preConfirm: (selectedReason) => {
        if (selectedReason === 'other') {
          return Swal.fire({
            title: "Please provide a reason",
            input: 'textarea',
            inputLabel: 'Enter your reason here',
            inputPlaceholder: 'Describe the reason...',
            showCancelButton: true,
            confirmButtonText: "Confirm Archive",
          }).then((otherReasonResult) => {
            if (otherReasonResult.isConfirmed) {
              return {
                reason: selectedReason,
                otherReason: otherReasonResult.value || ""
              };
            }
          });
        }

        return { reason: selectedReason, otherReason: '' };
      }
    }).then((result) => {
      if (result.isConfirmed) {
        deleteProfile(fisherId, farmerId, result.value);
      } else {
        Swal.fire("Cancelled", "Profile not archived.", "error");
      }
    });
  }

  function deleteProfile(fisherId, farmerId, reasonData) {
    let profileType = '';
    if (fisherId !== null) {
      profileType = 'fisher';
    } else if (farmerId !== null) {
      profileType = 'farmer';
    }

    fetch("tempRemove.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: new URLSearchParams({
        profile_type: profileType,
        fisher_id: fisherId || '',
        farmer_id: farmerId || '',
        reason: reasonData.reason, 
        other_reason: reasonData.otherReason || ''
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          Swal.fire({
            title: "Archived!",
            text: "Profile has been archived.",
            icon: "success",
            showConfirmButton: false,
            timer: 1000,
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
      })
      .catch((error) => {
        console.error("Error deleting profile:", error);
        Swal.fire({
          title: "Error",
          text: "Could not archive the profile. Please try again later.",
          icon: "error",
        });
      });
  }

  askReason(fisherId, farmerId);
}

function setFisherId(fisherId) {
  document.getElementById("deleteFisherId").value = fisherId;
}

function setFarmerId(farmerId) {
  document.getElementById("deleteFarmerId").value = farmerId;
}
