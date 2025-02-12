window.onload = function () {
  handlePasswordInput();
};

function togglePassword() {
  const passwordField = document.getElementById("password");
  const toggleIcon = document.getElementById("togglePasswordIcon");
  if (passwordField.type === "password") {
    passwordField.type = "text";
    toggleIcon.classList.replace("fa-eye", "fa-eye-slash");
  } else {
    passwordField.type = "password";
    toggleIcon.classList.replace("fa-eye-slash", "fa-eye");
  }
}

function handlePasswordInput() {
  const passwordField = document.getElementById("password");
  const toggleIcon = document.getElementById("togglePasswordIcon");
  toggleIcon.style.display = passwordField.value ? "inline" : "none";
}

$(document).ready(function () {
  bsCustomFileInput.init();
});

document.querySelector("form").addEventListener("submit", function (event) {
  event.preventDefault(); 
  console.log("Submitting form...");

  fetch("userRegister.php", {
    method: "POST",
    body: new FormData(this),
  })
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      // Check the response status
      var Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
      });

      if (data.status === "success") {
        Toast.fire({
          icon: "success",
          title: "New User Account Created.",
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
