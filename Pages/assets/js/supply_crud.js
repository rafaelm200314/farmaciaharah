// Function to handle adding supply information
function addSupply(event) {
  event.preventDefault();

  // Retrieve values from form fields
  var supplyName = document.getElementById("supplyName").value;
  var supplyContact = document.getElementById("supplyContact").value;
  var supplyAddress = document.getElementById("supplyAddress").value;

  // Create form data object and append values
  var formData = new FormData();
  formData.append("supplyName", supplyName);
  formData.append("supplyContact", supplyContact);
  formData.append("supplyAddress", supplyAddress);

  // Create XMLHttpRequest object and send data to server
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../PHP/supply_add.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      alert("Supply added successfully!");
      location.reload();
    } else {
      alert("Error: " + xhr.status);
    }
  };
  xhr.send(formData);
}
// Function to handle editing supply information
function editSupply(event) {
  event.preventDefault();

  // Retrieve values from form fields
  var supplierId = document.getElementById("editSupplierId").value;
  var supplierName = document.getElementById("editSupplierName").value;
  var supplierContact = document.getElementById("editSupplierContact").value;
  var supplierAddress = document.getElementById("editSupplierAddress").value;

  // Create form data object and append values
  var formData = new FormData();
  formData.append("editSupplierId", supplierId);
  formData.append("editSupplierName", supplierName);
  formData.append("editSupplierContact", supplierContact);
  formData.append("editSupplierAddress", supplierAddress);

  // Create XMLHttpRequest object and send data to server
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../PHP/supply_edit.php", true);
  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.status === 'success') {
        alert("Supplier details updated successfully!");
        location.reload();
      } else {
        // Show error message
        alert("Error: " + response.message);
      }
    } else {
      // Show error message
      alert("Error: " + xhr.status);
    }
  };
  xhr.send(formData);
}

// Attach event listener for form submission
document.getElementById("editForm").addEventListener("submit", function (event) {
  event.preventDefault();
  editSupply(event);
});

// Function to handle deleting supply information
function deleteSupply(event, supplierId) {
  event.preventDefault();

  // Create XMLHttpRequest object for deleting
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../PHP/supply_delete.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
      if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          alert(response.message);
          if (response.status === 'success') {
              location.reload(); // Reload the page after successful deletion
          }
      } else {
          alert("Error: " + xhr.status);
      }
  };
  xhr.send("deleteSupplierId=" + encodeURIComponent(supplierId));
}


// Function to open modal for editing supply details
function openModal(supplierId, supplierName, supplierContact, supplierAddress) {
  // Set values in the edit modal form fields
  document.getElementById("editSupplierId").value = supplierId;
  document.getElementById("editSupplierName").value = supplierName;
  document.getElementById("editSupplierContact").value = supplierContact;
  document.getElementById("editSupplierAddress").value = supplierAddress;

  // Show the edit modal
  var modal = new bootstrap.Modal(document.getElementById("editModal"));
  modal.show();
}
