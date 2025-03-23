<?php
require_once("dbcon.php"); // Including the database connection file
session_start(); // Starting the session

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Checking if the request method is POST
    // Retrieve form data
    $employeeName = $_POST['editEmployeeName'];
    $employeeContact = $_POST['editEmployeeContact'];
    $employeeAddress = $_POST['editEmployeeAddress'];

    // Prepare update statement
    $sql = "UPDATE employee_table SET employee_name=?, contact_number=?, address=? WHERE employee_id=?";
    $stmt = $conn->prepare($sql); // Preparing the SQL statement
    $stmt->bind_param("sssi", $employeeName, $employeeContact, $employeeAddress, $_SESSION['employee_id']); // Binding parameters

    // Execute the update statement
    if ($stmt->execute()) { // Executing the statement
        // Update session variables
        $_SESSION['employee_name'] = $employeeName;
        $_SESSION['contact_number'] = $employeeContact;
        $_SESSION['address'] = $employeeAddress;

        echo "Profile changed successfully!"; // Output success message
    } else {
        echo "Error changing profile"; // Output error message
    }
} else {
    echo "Invalid request method or user not logged in"; // Output error message for invalid request method or user not logged in
}
?>