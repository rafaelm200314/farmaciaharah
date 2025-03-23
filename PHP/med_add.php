<?php
require_once("dbcon.php"); // Including the database connection file

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get medicine details from POST data
    $medicineName = $_POST['medicineName']; // Extracting medicine name
    $medicinePrice = $_POST['medicinePrice']; // Extracting medicine price
    $medicineExpiry = $_POST['medicineExpiry']; // Extracting medicine expiry date
    $medicineQuantity = $_POST['medicineQuantity']; // Extracting medicine quantity
    $medicineDetails = $_POST['medicineDetails']; // Extracting medicine details
    $medicinePhoto = uploadImage('medicinePhoto'); // Extracting medicine photo and uploading it
    $supplierId = $_POST['supplierId']; // Extracting supplier ID

    // Validate medicine price to be non-negative
    if ($medicinePrice < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Medicine price cannot be negative']);
        exit(); // Stop further execution
    }

    // Validate medicine quantity to be non-negative
    if ($medicineQuantity < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Medicine quantity cannot be negative']);
        exit(); // Stop further execution
    }

    // Get employee ID from session variable (assuming you have stored it in session)
    session_start(); // Starting the session
    $employeeId = $_SESSION['employee_id']; // Retrieving employee ID from session

    // Prepare INSERT query with employee ID included
    $sql = "INSERT INTO medicine_table (med_name, med_price, med_expiry, med_quantity, med_details, med_photo, supplier_id, employee_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)"; // SQL query to insert medicine information

    $insertStmt = $conn->prepare($sql); // Preparing the SQL statement
    $insertStmt->bind_param("sdsissii", $medicineName, $medicinePrice, $medicineExpiry, $medicineQuantity, $medicineDetails, $medicinePhoto, $supplierId, $employeeId); // Binding parameters

    // Execute the query
    if ($insertStmt->execute()) { // Executing the statement
        echo json_encode(['status' => 'success', 'message' => 'Medicine is added successfully!']); // Output success message as JSON
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in adding Medicine']); // Output error message as JSON
    }
} else {
    // If request method is not POST, return an error message
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // Output error message for invalid request method as JSON
}

// Function to handle file upload
function uploadImage($inputName)
{
    if (isset($_FILES[$inputName]) && $_FILES[$inputName]['error'] == UPLOAD_ERR_OK) { // Checking if file upload is successful
        $filename   = uniqid() . "-" . time(); // Generating a unique filename
        $extension  = pathinfo($_FILES[$inputName]["name"], PATHINFO_EXTENSION); // Getting the file extension
        $basename   = $filename . "." . $extension; // Creating the complete filename with extension

        $source       = $_FILES[$inputName]["tmp_name"]; // Getting the temporary file location
        $destination  = "../assets/img/Uploads/{$basename}"; // Setting the destination path

        /* move the file */
        move_uploaded_file($source, $destination); // Moving the uploaded file to the destination

        // Return the image path
        return $destination; // Returning the uploaded image path
    }

    // If no image is uploaded, return a default image path
    return 'path/to/default_image.jpg'; // Returning the path to a default image
}
header('Content-Type: application/json'); // Setting response header to indicate JSON content

$conn->close(); // Closing the database connection