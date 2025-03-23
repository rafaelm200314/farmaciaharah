<?php
require_once("dbcon.php"); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST
    // Extract employee details from POST data
    $employeeId = $_POST['editEmployeeId']; // Extract employee ID
    $employeeName = $_POST['editEmployeeName']; // Extract employee name
    $employeeContact = $_POST['editEmployeeContact']; // Extract employee contact
    $employeeAddress = $_POST['editEmployeeAddress']; // Extract employee address

    // Prepare and bind the UPDATE statement
    $sql = "UPDATE employee_table SET employee_name=?, contact_number=?, address=? WHERE employee_id=?"; // SQL query to update employee details
    $updateStmt = $conn->prepare($sql); // Prepare the SQL statement
    $updateStmt->bind_param("sssi", $employeeName, $employeeContact, $employeeAddress, $employeeId); // Bind parameters

    // Execute the UPDATE statement and handle errors
    if ($updateStmt->execute()) { // Execute the statement
        echo json_encode(['status' => 'success', 'message' => 'Employee details are updated successfully!']); // Output success message as JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in updating employee details']); // Output error message as JSON
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // Output error message for invalid request method as JSON
}

header('Content-Type: application/json'); // Set response header to indicate JSON content
$conn->close(); // Close the database connection
?>
