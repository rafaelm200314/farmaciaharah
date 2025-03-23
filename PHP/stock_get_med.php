<?php
// Include the database connection file to establish a connection with the database.
require_once("dbcon.php");

// Define the SQL query to select all records from the 'medicine_table'.
$sql = "SELECT * FROM medicine_table";

// Execute the query using the database connection and store the result.
$result = $conn->query($sql);

// Initialize an empty array to hold the data retrieved from the database.
$data = array();

// Check if the query returned any rows.
if ($result->num_rows > 0) {
    // If there are rows, fetch each row as an associative array.
    while ($row = $result->fetch_assoc()) {
        // Format the date field before adding it to the $data array.
        $row['med_expiry'] = date('m-d-Y', strtotime($row['med_expiry']));
        // Add the row to the $data array.
        $data[] = $row;
    }
}

// Convert the $data array to a JSON formatted string and output it.
echo json_encode($data);

// Close the database connection to free up resources.
$conn->close();
?>
