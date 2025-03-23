<?php
require_once("dbcon.php"); // Including the database connection file

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract the data from the POST request
    $supplierId = $_POST['editSupplierId'];
    $supplierName = $_POST['editSupplierName'];
    $supplierContact = $_POST['editSupplierContact'];
    $supplierAddress = $_POST['editSupplierAddress'];

    // Prepare the SQL statement
    $sql = "UPDATE supplier_table SET supplier_name=?, supplier_contact=?, supplier_address=? WHERE supplier_id=?";

    // Prepare and bind the parameters
    $updateStmt = $conn->prepare($sql); // Preparing the SQL statement
    $updateStmt->bind_param("sssi", $supplierName, $supplierContact, $supplierAddress, $supplierId); // Binding parameters

    // Execute the statement
    if ($updateStmt->execute()) { // Executing the statement
        // If successful, return a success JSON response
        $response = ['status' => 'success', 'message' => 'Supplier details are updated successfully!'];
    } else {
        // If there's an error, return an error JSON response
        $response = ['status' => 'error', 'message' => 'Error in updating supplier details'];
    }
} else {
    // If the request method is not POST, return an error JSON response
    $response = ['status' => 'error', 'message' => 'Invalid request method'];
}

// Set the response header to indicate JSON content
header('Content-Type: application/json');

// Send the JSON response
echo json_encode($response);

// Close the database connection
$conn->close();
?>
