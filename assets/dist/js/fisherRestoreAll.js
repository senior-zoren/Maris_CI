function confirmRestoreAllFisher() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This will restore all archived profiles!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, restore all!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {

            restoreAllFisherProfiles();
        }
    });
}

function restoreAllFisherProfiles() {

    $.ajax({
        url: 'fisherRestore.php',
        method: 'POST',
        data: { action: 'restore_all' },
        success: function (response) {

            const result = JSON.parse(response);
            if (result.status === 'success') {
                Swal.fire('Restored!', 'All archived profiles have been restored.', 'success')
                    .then(() => window.location.reload());
            } else {
                Swal.fire('Error!', result.message, 'error');
            }
        },
        error: function () {
            Swal.fire('Error!', 'An error occurred while trying to restore the profiles.', 'error');
        }
    });
}