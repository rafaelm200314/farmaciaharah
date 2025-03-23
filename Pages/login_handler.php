<?php
// Start or resume the session
session_start();
// Log a debug message indicating session start or resume, along with session ID
error_log("DEBUG: Session started or resumed. Session ID: " . session_id());

// Database connection details
$dbHost = "localhost"; // Host
$dbUser = "root"; // User
$dbPassword = ""; // Password
$dbName = "pharmasee"; // Database

// Establish a new database connection
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);

// Check if the connection was successful
if ($conn->connect_error) {
    // Log an error message if connection failed and terminate the script
    error_log("ERROR: Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
} else {
    // Log a debug message if database connection is successful
    error_log("DEBUG: Database connection established.");
}

// Log In Process
// Check if the HTTP request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve email and password from the POST data
    $email = $_POST['email'];
    $password = $_POST['password'];
    // Log a debug message indicating the received login request with email
    error_log("DEBUG: Received login request. Email: " . $email);

    // SQL query to retrieve user details based on email
    $sql = "SELECT employee_id, password, employee_name, contact_number, address FROM employee_table WHERE email = ?";
    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);
    // Check if statement preparation was successful
    if ($stmt === false) {
        // Log an error message if statement preparation failed and send an error response
        error_log("ERROR: Error preparing the statement: " . $conn->error);
        echo json_encode(['status' => 'error', 'message' => 'Error preparing the statement']);
        exit();
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // Check if a user with the provided email exists
    if ($stmt->num_rows > 0) {
        // Bind result variables
        $stmt->bind_result($employee_id, $stored_password, $employee_name, $contact_number, $address);
        $stmt->fetch();
        // Log a debug message indicating user found and employee ID
        error_log("DEBUG: User found. Employee ID: " . $employee_id);

        // Compare plaintext password directly
        if ($password === $stored_password) {
            // If password matches, set session variables and log a debug message
            $_SESSION['employee_id'] = $employee_id;
            $_SESSION['employee_name'] = $employee_name;
            $_SESSION['contact_number'] = $contact_number;
            $_SESSION['address'] = $address;
            $_SESSION['email'] = $email; // Store email in the session
            $_SESSION['loggedin'] = true; // Set logged-in status
            error_log("DEBUG: Password match. Session employee_id set: " . $_SESSION['employee_id']);
            // Send a success response
            echo json_encode(['status' => 'success', 'message' => 'Login successful']);
        } else {
            // If password doesn't match, log an error message and send an error response
            error_log("ERROR: Invalid password for email: " . $email);
            echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
        }
    } else {
        // If no user found with the provided email, log an error message and send an error response
        error_log("ERROR: No user found with email: " . $email);
        echo json_encode(['status' => 'error', 'message' => 'No user found with this email']);
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If the request method is not POST, log an error message and send an error response
    error_log("ERROR: Invalid request method.");
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
