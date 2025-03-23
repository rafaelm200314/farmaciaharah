// Function to handle form submission for changing password
function changePassword(event) {
  event.preventDefault(); // Prevent form submission

  // Retrieve input values from the form
  var oldPassword = document.getElementById("password").value;
  var newPassword = document.getElementById("newpassword").value;
  var confirmNewPassword = document.getElementById("confirm").value;

  // Create a new FormData object to send form data to the server
  var formData = new FormData();
  formData.append("password", oldPassword);
  formData.append("newpassword", newPassword);
  formData.append("confirm", confirmNewPassword);

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure the XMLHttpRequest object
  xhr.open("POST", "../PHP/change.php", true);

  // Define the onload event handler to handle server response
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Get the response text from the server
      var response = xhr.responseText;
      // Alert the response message to the user
      alert(response);
      // Check if the response contains "successfully" indicating successful password change
      if (response.includes("successfully")) {
        // Redirect to the logout page upon successful password change
        window.location.href = "logout.php";
      }
    } else {
      // Alert the user if an error occurs
      alert("Error: " + xhr.status);
    }
  };

  // Send the form data to the server
  xhr.send(formData);
}

// Event listener to handle form submission when the DOM content is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  // Add an event listener to the form with the id "changePasswordForm"
  document
    .getElementById("changePasswordForm")
    .addEventListener("submit", changePassword);
});
