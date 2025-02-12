
$(document).ready(function () {
  $(".select2").select2();

  bsCustomFileInput.init();

  document.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault();

    fetch("addMarinePage.php", {
      method: "POST",
      body: new FormData(this), 
    })
      .then((response) => {
        return response.json().then((data) => {
          if (!response.ok) {
            throw new Error(data.message || "Network response was not ok");
          }
          return data;
        });
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
            title: data.message,
          });
          this.reset();
          $(".select2").select2();
        } else if (data.status === "warning") {
          Toast.fire({
            icon: "warning",
            title: data.message,
          });
        } else if (data.status === "error") {
          const errorDetails =
            data.file && data.line
              ? ` in ${data.file} on line ${data.line}`
              : "";

          Toast.fire({
            icon: "error",
            title: `${data.message}${errorDetails}`,
          });
        } else {
          console.error("Unexpected response format");
        }
      })
      .catch((error) => {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: error.message,
        });
        console.error("Error:", error);
      });
  });
});
