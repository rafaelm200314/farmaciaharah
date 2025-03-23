// Wait for the DOM content to be fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Select all elements with the class "toggle-password"
  const togglePasswordIcons = document.querySelectorAll(".toggle-password");

  // Add click event listener to each toggle-password icon
  togglePasswordIcons.forEach((icon) => {
    icon.addEventListener("click", function () {
      // Find the input field preceding the clicked icon
      const input = this.previousElementSibling;
      // Toggle the input type between "password" and "text"
      const type = input.getAttribute("type") === "password" ? "text" : "password";
      input.setAttribute("type", type);
      // Toggle the icon class between "fa-eye" and "fa-eye-slash"
      this.classList.toggle("fa-eye");
      this.classList.toggle("fa-eye-slash");
    });
  });
});
