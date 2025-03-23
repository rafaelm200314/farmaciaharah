<?php
require_once("dbcon.php"); // Including the database connection file

header('Content-Type: application/json'); // Setting response header to indicate JSON content

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Checking if the request method is POST
    $deleteSupplierId = $_POST['deleteSupplierId']; // Extracting the supplier ID from POST data

    // Check if there are any medicines referencing this supplier
    $checkSql = "SELECT COUNT(*) AS count FROM medicine_table WHERE supplier_id = ?";
    $checkStmt = $conn->prepare($checkSql);
    if ($checkStmt === false) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]); // Output error message as JSON
        exit;
    }
    $checkStmt->bind_param("i", $deleteSupplierId);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $row = $checkResult->fetch_assoc();
    $medicineReferenceCount = $row['count'];

    if ($medicineReferenceCount > 0) {
        // Medicines reference this supplier, prevent deletion
        echo json_encode(['status' => 'error', 'message' => 'Cannot delete supplier. Medicines are referencing this supplier.']); // Output error message as JSON
    } else {
        // No medicines referencing this supplier, proceed with deletion
        $sql = "DELETE FROM supplier_table WHERE supplier_id=?";
        $deleteStmt = $conn->prepare($sql); // Preparing the SQL statement
        if ($deleteStmt === false) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $conn->error]); // Output error message as JSON
            exit;
        }
        $deleteStmt->bind_param("i", $deleteSupplierId); // Binding parameters

        if ($deleteStmt->execute()) { // Executing the statement
            if ($deleteStmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Supplier deleted successfully!']); // Output success message as JSON
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Supplier ID not found or deletion operation failed.']); // Output error message as JSON
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error in executing deletion query: ' . $conn->error]); // Output detailed error message as JSON
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']); // Output error message for invalid request method as JSON
}

$conn->close(); // Closing the database connection
?>
