<?php
require_once("dbcon.php"); // Including the database connection file

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get supplier details from POST data
    $supplyName = $_POST['supplyName']; // Extracting supply name
    $supplyContact = $_POST['supplyContact']; // Extracting supply contact
    $supplyAddress = $_POST['supplyAddress']; // Extracting supply address

    // Get employee ID from session variable (assuming you have stored it in session)
    session_start(); // Starting the session
    $employeeId = $_SESSION['employee_id']; // Retrieving employee ID from session

    // Prepare INSERT query with employee ID included
    $sql = "INSERT INTO supplier_table (supplier_name, supplier_contact, supplier_address, employee_id)
            VALUES (?, ?, ?, ?)"; // SQL query to insert supply information

    $insertStmt = $conn->prepare($sql); // Preparing the SQL statement
    $insertStmt->bind_param("sssi", $supplyName, $supplyContact, $supplyAddress, $employeeId); // Binding parameters

    // Execute the query
    if ($insertStmt->execute()) { // Executing the statement
        echo json_encode(['status' => 'success', 'message' => 'Supply information added successfully!']); // Output success message as JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in adding supply information']); // Output error message as JSON
    }
} else {
    // If request method is not POST, return an error message
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // Output error message for invalid request method as JSON
}

header('Content-Type: application/json'); // Setting response header to indicate JSON content
$conn->close(); // Closing the database connection
?>
