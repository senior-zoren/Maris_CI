window.onload = function () {
  document.getElementById("loginForm").reset();
  handlePasswordInput();
  disableLoginBox();
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

function disableLoginBox() {
  const loginForm = document.querySelector("#loginForm");
  const loginFormButtons = document.querySelectorAll(".login-box button");
  const loginInputs = loginForm.querySelectorAll("input");

  loginInputs.forEach(input => input.setAttribute("disabled", "true"));
  loginFormButtons.forEach(button => button.setAttribute("disabled", "true"));
}

function showLogin() {
  const description = document.querySelector(".login-section p");
  const loginBox = document.querySelector(".login-box");
  const dashboardButton = document.querySelector('a[href="assets/dashboard.php"]');
  const loginFormButtons = document.querySelectorAll(".login-box button");
  const loginInputs = document.querySelectorAll(".login-box input");
  const topMenuContainer = document.getElementById("topMenuContainer");
  const hamburgerMenu = document.getElementById("hamburgerMenu");
  const hamburgerIcon = hamburgerMenu?.querySelector("span"); // Optional chaining

  if (description) {
    description.classList.add("hidden", "disabled");
  }

  if (loginBox) {
    loginBox.classList.add("active");
    loginBox.classList.remove("hidden");
  }

  if (dashboardButton) {
    dashboardButton.setAttribute("disabled", "true");
  }

  loginFormButtons.forEach(button => button.removeAttribute("disabled"));
  loginInputs.forEach(input => input.removeAttribute("disabled"));

  if (topMenuContainer) {
    topMenuContainer.classList.remove("active");
  }

  if (hamburgerMenu) {
    hamburgerMenu.classList.remove("active");
  }

  if (hamburgerIcon) {
    hamburgerIcon.classList.remove("fa-times");
    hamburgerIcon.classList.add("fa-bars");
  }
}


function hideLogin() {
  const description = document.querySelector(".login-section p");
  const loginBox = document.querySelector(".login-box");
  const dashboardButton = document.querySelector('a.btn.btn-success');
  const loginFormButtons = document.querySelectorAll(".login-box button");
  const loginInputs = document.querySelectorAll(".login-box input");

  if (description) {
    description.classList.remove("hidden");
    description.classList.remove("disabled");
  }

  if (loginBox) {
    loginBox.classList.remove("active");
    loginBox.classList.add("hidden");
  }

  if (dashboardButton) {
    dashboardButton.removeAttribute("disabled");
  } else {
    console.warn("Dashboard button not found.");
  }

  loginFormButtons.forEach(button => button.setAttribute("disabled", "true"));
  loginInputs.forEach(input => input.setAttribute("disabled", "true"));
}


function toggleTopMenu() {
  const topMenuContainer = document.getElementById("topMenuContainer");
  topMenuContainer.classList.toggle("active");
}

document.getElementById("hamburgerMenu").addEventListener("click", function () {
  const topMenuContainer = document.getElementById("topMenuContainer");
  const hamburgerIcon = this.querySelector("span");

  topMenuContainer.classList.toggle("active");
  this.classList.toggle("active");

  if (topMenuContainer.classList.contains("active")) {
    hamburgerIcon.classList.remove("fa-bars");
    hamburgerIcon.classList.add("fa-times");
  } else {
    hamburgerIcon.classList.remove("fa-times");
    hamburgerIcon.classList.add("fa-bars");
  }
});
