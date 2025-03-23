// Adding Employee info
function addEmplo(event) {
  event.preventDefault(); // Prevent the default form submission behavior

  // Retrieve input values from the form
  var employeeName = document.getElementById("employeeName").value;
  var employeeContact = document.getElementById("employeeContact").value;
  var employeeAddress = document.getElementById("employeeAddress").value;
  var employeeEmail = document.getElementById("employeeEmail").value;
  var employeePassword = document.getElementById("employeePassword").value;

  // Create a new FormData object to send form data to the server
  var formData = new FormData();
  formData.append("employeeName", employeeName);
  formData.append("employeeContact", employeeContact);
  formData.append("employeeAddress", employeeAddress);
  formData.append("employeeEmail", employeeEmail);
  formData.append("employeePassword", employeePassword);

  // Create a new XMLHttpRequest object
  var xhr = new XMLHttpRequest();

  // Configure the XMLHttpRequest object
  xhr.open("POST", "../PHP/emplo_add.php", true);

  // Define the onload event handler to handle server response
  xhr.onload = function () {
    if (xhr.status === 200) {
      // Parse the JSON response from the server
      var response = JSON.parse(xhr.responseText);
      // Display the response message to the user
      alert(response.message);
      // Reload the page to reflect changes
      location.reload();
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
  // Add an event listener to the form with the id "editForm"
  document.getElementById("editForm").addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission behavior
    editEmplo(event); // Call the editEmplo function to handle form submission
  });
});
