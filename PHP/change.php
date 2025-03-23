<?php
require_once("dbcon.php"); // Include the database connection file to establish a connection with the database.
session_start(); // Start the session to access session variables.

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['employee_id'])) { // Check if the request method is POST and if the employee is logged in.
    $employeeId = $_SESSION['employee_id']; // Get the logged-in employee's ID from the session.
    $oldPassword = $_POST['password']; // Get 'oldPassword' from the POST request.
    $newPassword = $_POST['newpassword']; // Get 'newPassword' from the POST request.
    $confirmPassword = $_POST['confirm']; // Get 'confirmPassword' from the POST request.

    // Validate if new password and confirm password match
    if ($newPassword !== $confirmPassword) { // Check if 'newPassword' matches 'confirmPassword'.
        echo "New password and confirm password do not match"; // Output an error message if passwords do not match.
        exit; // Terminate the script execution.
    }

    // Retrieve the password of the logged-in employee
    $stmt = $conn->prepare("SELECT password FROM employee_table WHERE employee_id = ?"); // Prepare a SQL query to select the password of the logged-in employee.
    $stmt->bind_param("i", $employeeId); // Bind the 'employeeId' parameter to the SQL query, specifying it as an integer.
    $stmt->execute(); // Execute the prepared statement.
    $result = $stmt->get_result(); // Get the result set from the executed query.
    $row = $result->fetch_assoc(); // Fetch the result as an associative array.
    $storedPassword = $row['password']; // Get the stored password from the result.

    // Verify the old password
    if ($oldPassword !== $storedPassword) { // Check if the provided old password matches the stored password.
        echo "Old password is incorrect"; // Output an error message if the old password is incorrect.
        exit; // Terminate the script execution.
    }

    // Check if the new password is the same as the old password
    if ($newPassword === $storedPassword) { // Check if the new password is the same as the old password.
        echo "New password cannot be the same as the old password"; // Output an error message if the new password is the same as the old password.
        exit; // Terminate the script execution.
    }

    // Update the password
    $updateStmt = $conn->prepare("UPDATE employee_table SET password=? WHERE employee_id=?"); // Prepare a SQL query to update the password.
    $updateStmt->bind_param("si", $newPassword, $employeeId); // Bind the 'newPassword' and 'employeeId' parameters to the SQL query.

    if ($updateStmt->execute()) { // Execute the prepared statement and check if it was successful.
        session_destroy(); // Password changed successfully, destroy the session to log out the user.
        echo "Password changed successfully!"; // Output a success message.
    } else {
        echo "Error changing password"; // Output an error message if there was an error in changing the password.
    }
} else {
    echo "Invalid request method or user not logged in"; // Output an error message if the request method is not POST or the user is not logged in.
}

$conn->close(); // Close the database connection to free up resources.
?>
