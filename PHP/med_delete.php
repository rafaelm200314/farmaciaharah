<?php
require_once("dbcon.php"); // Include the database connection file to establish a connection with the database.

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if the request method is POST.
    $deleteMedId = $_POST['deleteMedId']; // Get the 'deleteMedId' from the POST request.

    $sql = "DELETE FROM medicine_table WHERE med_id=?"; // Define the SQL query to delete a record with a specific 'med_id'.

    $deleteStmt = $conn->prepare($sql); // Prepare the SQL statement for execution.
    $deleteStmt->bind_param("i", $deleteMedId); // Bind the 'deleteMedId' parameter to the SQL query, specifying it as an integer.

    if ($deleteStmt->execute()) { // Execute the prepared statement and check if it was successful.
        echo json_encode(['status' => 'success', 'message' => 'Medicine is deleted successfully!']); // If successful, return a success message in JSON format.
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in deleting medicine']); // If there was an error, return an error message in JSON format.
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // If the request method is not POST, return an error message in JSON format.
}

header('Content-Type: application/json'); // Set the content type of the response to JSON.
$conn->close(); // Close the database connection to free up resources.
?>
