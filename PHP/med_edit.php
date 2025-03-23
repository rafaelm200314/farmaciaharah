<?php
require_once("dbcon.php"); // Including the database connection file

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extracting medicine details from POST data
    $medicineId = $_POST['editMedicineId']; // Extracting medicine ID
    $medicineName = $_POST['editMedicineName']; // Extracting medicine name
    $medicinePrice = $_POST['editMedicinePrice']; // Extracting medicine price
    $medicineExpiry = $_POST['editMedicineExpiry']; // Extracting medicine expiry date
    $medicineQuantity = $_POST['editMedicineQuantity']; // Extracting medicine quantity
    $medicineDetails = $_POST['editMedicineDetails']; // Extracting medicine details
    $supplierId = $_POST['editMedicineSupplierId']; // Extracting supplier ID

    // Validate medicine price and quantity to be non-negative
    if ($medicinePrice < 0 || $medicineQuantity < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Medicine price and quantity cannot be negative.']); // Output error message as JSON
        exit; // Exit the script
    }

    // Prepare and bind the SELECT statement to retrieve existing medicine details
    $selectSql = "SELECT * FROM medicine_table WHERE med_id=?";
    $selectStmt = $conn->prepare($selectSql);
    $selectStmt->bind_param("i", $medicineId);
    $selectStmt->execute();
    $result = $selectStmt->get_result();
    $existingMedicine = $result->fetch_assoc();

    // Check if no changes were made
    if (
        $existingMedicine['med_name'] == $medicineName &&
        $existingMedicine['med_price'] == $medicinePrice &&
        $existingMedicine['med_expiry'] == $medicineExpiry &&
        $existingMedicine['med_quantity'] == $medicineQuantity &&
        $existingMedicine['med_details'] == $medicineDetails &&
        $existingMedicine['supplier_id'] == $supplierId
    ) {
        echo json_encode(['status' => 'error', 'message' => 'No changes were made.']); // Output error message as JSON
        exit; // Exit the script
    }

    // Prepare and bind the UPDATE statement
    $updateSql = "UPDATE medicine_table SET med_name=?, med_price=?, med_expiry=?, med_quantity=?, med_details=?, supplier_id=? WHERE med_id=?";
    $updateStmt = $conn->prepare($updateSql); // Preparing the UPDATE statement
    $updateStmt->bind_param("sdsisii", $medicineName, $medicinePrice, $medicineExpiry, $medicineQuantity, $medicineDetails, $supplierId, $medicineId); // Binding parameters

    // Execute the UPDATE statement and handle errors
    try {
        if ($updateStmt->execute()) { // Executing the UPDATE statement
            echo json_encode(['status' => 'success', 'message' => 'Medicine is updated successfully!']); // Output success message as JSON
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error in updating medicine']); // Output error message as JSON
        }
    } catch (Exception $e) { // Catching exceptions
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]); // Outputting error message with exception details as JSON
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // Output error message for invalid request method as JSON
}

// Close the database connection
$conn->close(); // Closing the database connection