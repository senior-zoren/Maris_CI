
$(document).ready(function () {

  $(".select2").select2();
});


document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault();

  fetch("addFarmerProfile.php", {
    method: "POST",
    body: new FormData(this),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {

      var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });

      if (data.status === "success") {
 
        Toast.fire({
          icon: "success",
          title: "Farmer Profile Successfully Added.",
        });

        this.reset();
      } else if (data.status === "warning") {

        Toast.fire({
          icon: "warning",
          title: data.message,
        });
      } else if (data.status === "error") {

        Toast.fire({
          icon: "error",
          title: data.message,
        });
      } else {
        console.log("Unexpected response format");
      }
    })
    .catch((error) => {
      console.error("Error:", error);

      Swal.fire({
        icon: "error",
        title: "Network Error",
        text: "An error occurred during the submission process.",
      });
    });
});
