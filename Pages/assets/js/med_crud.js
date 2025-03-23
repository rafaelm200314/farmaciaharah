function addMed(event) {
  event.preventDefault();

  var medicineName = document.getElementById("medicineName").value;
  var medicinePrice = document.getElementById("medicinePrice").value;
  var medicineExpiry = document.getElementById("medicineExpiry").value;
  var medicineQuantity = document.getElementById("medicineQuantity").value;
  var medicineDetails = document.getElementById("medicineDetails").value;
  var medicinePhoto = document.getElementById("medicinePhoto").files[0]; // Get the file object
  var supplierId = document.getElementById("supplier").value; // Get the selected supplier ID

  // Validate medicinePrice to be a decimal and not negative
  if (!/^\d+(\.\d{1,2})?$/.test(medicinePrice) || parseFloat(medicinePrice) < 0) {
    alert("Please enter a valid non-negative decimal price.");
    return;
  }

  // Validate medicineQuantity to be a positive integer
  if (!/^\d+$/.test(medicineQuantity) || parseInt(medicineQuantity) < 0) {
    alert("Please enter a valid non-negative integer quantity.");
    return;
  }

  // Validate medicineExpiry to be exactly 4 digits in YYYY format
  if (!/^\d{4}$/.test(medicineExpiry)) {
    alert("Please enter a valid 4-digit year for expiry.");
    return;
  }

  var formData = new FormData();
  formData.append("medicineName", medicineName);
  formData.append("medicinePrice", medicinePrice);
  formData.append("medicineExpiry", medicineExpiry);
  formData.append("medicineQuantity", medicineQuantity);
  formData.append("medicineDetails", medicineDetails);
  formData.append("medicinePhoto", medicinePhoto);
  formData.append("supplierId", supplierId); // Append the supplier ID

  var xhr = new XMLHttpRequest();

  xhr.open("POST", "../PHP/med_add.php", true);

  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      alert(response.message);
      location.reload();
    } else {
      alert("Error: " + xhr.status);
    }
  };

  xhr.send(formData);
}
document
  .getElementById("editForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    editMed(event);
  });

 function editMed(event) {
    event.preventDefault();

    var medicineId = document.getElementById("editMedicineId").value;
    var medicineName = document.getElementById("editMedicineName").value;
    var medicinePrice = document.getElementById("editMedicinePrice").value;
    var medicineExpiry = document.getElementById("editMedicineExpiry").value;
    var medicineQuantity = document.getElementById("editMedicineQuantity").value;
    var medicineDetails = document.getElementById("editMedicineDetails").value;
    var supplierId = document.getElementById("editMedicineSupplierId").value;

    // Validate medicineExpiry to be exactly 4 digits in YYYY format
    if (!/^\d{4}$/.test(medicineExpiry)) {
        alert("Please enter a valid 4-digit year for expiry.");
        return;
    }

    // Validate medicinePrice and medicineQuantity to be non-negative
    if (medicinePrice < 0 || medicineQuantity < 0) {
        alert("Medicine price and quantity cannot be negative.");
        return;
    }

    // Get the existing values from the modal
    var existingName = document.getElementById("editMedicineName").getAttribute("data-original-value");
    var existingPrice = document.getElementById("editMedicinePrice").getAttribute("data-original-value");
    var existingExpiry = document.getElementById("editMedicineExpiry").getAttribute("data-original-value");
    var existingQuantity = document.getElementById("editMedicineQuantity").getAttribute("data-original-value");
    var existingDetails = document.getElementById("editMedicineDetails").getAttribute("data-original-value");
    var existingSupplierId = document.getElementById("editMedicineSupplierId").getAttribute("data-original-value");

    // Check if any changes were made
    if (
        medicineName === existingName &&
        medicinePrice === existingPrice &&
        medicineExpiry === existingExpiry &&
        medicineQuantity === existingQuantity &&
        medicineDetails === existingDetails &&
        supplierId === existingSupplierId
    ) {
        alert("No changes were made.");
        return;
    }

    var formData = new FormData();
    formData.append("editMedicineId", medicineId);
    formData.append("editMedicineName", medicineName);
    formData.append("editMedicinePrice", medicinePrice);
    formData.append("editMedicineExpiry", medicineExpiry);
    formData.append("editMedicineQuantity", medicineQuantity);
    formData.append("editMedicineDetails", medicineDetails);
    formData.append("editMedicineSupplierId", supplierId);

    var xhr = new XMLHttpRequest();

    xhr.open("POST", "../PHP/med_edit.php", true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            alert(response.message);
            location.reload();
        } else {
            alert("Error: " + xhr.status);
        }
    };

    xhr.send(formData);
}


// Modify the deleteMed function to accept the event parameter
function deleteMed(event) {
  event.preventDefault();

  var medicineId = document.getElementById("editMedicineId").value;

  // Send an AJAX request to delete the medicine entry
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../PHP/med_delete.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      alert(response.message);
      location.reload(); // Reload the page after successful deletion
    } else {
      alert("Error: " + xhr.status);
    }
  };
  xhr.send("deleteMedId=" + encodeURIComponent(medicineId));
}

window.onload = displayMedData;

function openModal(
  med_id,
  med_name,
  med_price,
  med_expiry,
  med_quantity,
  med_details,
  supplier_id
) {
  // Populate the modal with the row's data
  document.getElementById("editMedicineId").value = med_id;
  document.getElementById("editMedicineName").value = med_name;
  document.getElementById("editMedicinePrice").value = med_price;
  document.getElementById("editMedicineExpiry").value = med_expiry;
  document.getElementById("editMedicineQuantity").value = med_quantity;
  document.getElementById("editMedicineDetails").value = med_details;
  document.getElementById("editMedicineSupplierId").value = supplier_id;

  // Show the modal
  var modal = new bootstrap.Modal(document.getElementById("editModal"));
  modal.show();
}
