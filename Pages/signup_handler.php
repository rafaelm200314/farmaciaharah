<?php
$dbHost = "localhost"; // Database host
$dbUser = "root"; // Database user
$dbPassword = ""; // Database password
$dbName = "pharmasee"; // Database name

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName); // Establishing a new connection to the database

if ($conn->connect_error) { // Check if there is a connection error
    die("Connection failed: " . $conn->connect_error); // If there is an error, stop the script and print the error message
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST
    $employeeName = $_POST['employeeName']; // Get the employee name from the POST request
    $employeeContact = $_POST['employeeContact']; // Get the employee contact from the POST request
    $employeeAddress = $_POST['employeeAddress']; // Get the employee address from the POST request
    $employeeEmail = $_POST['employeeEmail']; // Get the employee email from the POST request
    $employeePassword = $_POST['employeePassword']; // Get the employee password from the POST request

    // Hash the password before storing it
    $hashed_password = password_hash($employeePassword, PASSWORD_BCRYPT); // Hash the employee password using BCRYPT

    // Debugging: Log received form data
    error_log("Received Form Data:"); // Log message to the error log
    error_log("Name: " . $employeeName); // Log the employee name
    error_log("Contact: " . $employeeContact); // Log the employee contact
    error_log("Address: " . $employeeAddress); // Log the employee address
    error_log("Email: " . $employeeEmail); // Log the employee email
    error_log("Password: " . $hashed_password); // Log the hashed password

    $sql = "INSERT INTO employee_table (employee_name, contact_number, address, email, password)
    VALUES (?,?,?,?,?)"; // SQL query to insert a new employee into the employee_table

    $insertStmt = $conn->prepare($sql); // Prepare the SQL statement
    if ($insertStmt === false) { // Check if there is an error preparing the statement
        echo json_encode(['status' => 'error', 'message' => 'Error preparing the statement']); // Return error message as JSON
        exit(); // Stop the script execution
    }

    $insertStmt->bind_param("sssss", $employeeName, $employeeContact, $employeeAddress, $employeeEmail, $hashed_password); // Bind the parameters to the SQL query

    if ($insertStmt->execute()) { // Execute the SQL query
        echo json_encode(['status' => 'success', 'message' => 'Employee is added successfully!']); // Return success message as JSON
    } else {
        // Debugging: Log SQL error
        error_log("SQL Error: " . $conn->error); // Log the SQL error message
        echo json_encode(['status' => 'error', 'message' => 'Error in adding Employee']); // Return error message as JSON
    }

    $insertStmt->close(); // Close the prepared statement
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // Return error message for invalid request method
}

header('Content-Type: application/json'); // Set the content type of the response to JSON
$conn->close(); // Close the database connection
