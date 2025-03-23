// Function to handle form submission for updating profile
function updateProfile(event) {
  event.preventDefault(); // Prevent form submission

  // Retrieve values from input fields
  var employeeName = document.getElementById("editEmployeeName").value;
  var employeeContact = document.getElementById("editEmployeeContact").value;
  var employeeAddress = document.getElementById("editEmployeeAddress").value;

  // Create a FormData object to store form data
  var formData = new FormData();
  formData.append("editEmployeeName", employeeName);
  formData.append("editEmployeeContact", employeeContact);
  formData.append("editEmployeeAddress", employeeAddress);

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure the request method, URL, and asynchronous flag
  xhr.open("POST", "../PHP/updateprof.php", true);

  // Define what happens on successful request completion
  xhr.onload = function () {
    if (xhr.status === 200) { // Check if request was successful
      var response = xhr.responseText; // Retrieve response text
      alert(response); // Alert the response directly to the user
      if (response.includes("successfully")) { // Check if response indicates success
        location.reload(); // Reload the page to reflect changes
      }
    } else { // Handle errors if request was not successful
      alert("Error: " + xhr.status); // Alert the error status
    }
  };

  // Send the FormData object as the request body
  xhr.send(formData);
}

// Event listener to call updateProfile function when the DOM content is loaded
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("editForm").addEventListener("submit", updateProfile);
});
