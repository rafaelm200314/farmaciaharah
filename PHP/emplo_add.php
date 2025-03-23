<?php
require_once("dbcon.php"); // Include the database connection file to establish a connection with the database.

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST.
    $employeeName = $_POST['employeeName']; // Get 'employeeName' from the POST request.
    $employeeContact = $_POST['employeeContact']; // Get 'employeeContact' from the POST request.
    $employeeAddress = $_POST['employeeAddress']; // Get 'employeeAddress' from the POST request.
    $employeeEmail = $_POST['employeeEmail']; // Get 'employeeEmail' from the POST request.
    $employeePassword = $_POST['employeePassword']; // Get 'employeePassword' from the POST request.

    // Check if the email already exists in the database
    $checkEmailSql = "SELECT email FROM employee_table WHERE email = ?"; // Define the SQL query to check for existing email.
    $checkEmailStmt = $conn->prepare($checkEmailSql); // Prepare the SQL statement for execution.
    $checkEmailStmt->bind_param("s", $employeeEmail); // Bind the 'employeeEmail' parameter to the SQL query, specifying it as a string.
    $checkEmailStmt->execute(); // Execute the prepared statement.
    $checkEmailStmt->store_result(); // Store the result to check the number of rows.

    if ($checkEmailStmt->num_rows > 0) { // Check if any rows are returned, indicating the email already exists.
        echo json_encode(['status' => 'error', 'message' => 'Email already exists']); // Return an error message in JSON format if email exists.
    } else {
        // Email does not exist, proceed with the insert
        $sql = "INSERT INTO employee_table (employee_name, contact_number, address, email, password)
        VALUES (?,?,?,?,?)"; // Define the SQL query to insert a new employee record.

        $insertStmt = $conn->prepare($sql); // Prepare the SQL statement for execution.
        $insertStmt->bind_param("sssss", $employeeName, $employeeContact, $employeeAddress, $employeeEmail, $employeePassword); // Bind the parameters to the SQL query.

        if ($insertStmt->execute()) { // Execute the prepared statement and check if it was successful.
            echo json_encode(['status' => 'success', 'message' => 'Employee is added successfully!']); // If successful, return a success message in JSON format.
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error in adding Employee']); // If there was an error, return an error message in JSON format.
        }
    }

    $checkEmailStmt->close(); // Close the statement used to check the email.
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // If the request method is not POST, return an error message in JSON format.
}

header('Content-Type: application/json'); // Set the content type of the response to JSON.
$conn->close(); // Close the database connection to free up resources.
?>
