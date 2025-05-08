document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.querySelector("#passwordToggleIcon");
  const passwordInput = document.getElementById("password");

  if (toggleBtn && passwordInput) {
      toggleBtn.parentElement.addEventListener("click", () => {
          const isHidden = passwordInput.type === "password";
          passwordInput.type = isHidden ? "text" : "password";

          toggleBtn.classList.toggle("fa-eye", !isHidden);
          toggleBtn.classList.toggle("fa-eye-slash", isHidden);
      });
  }
});