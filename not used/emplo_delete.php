<?php
require_once("dbcon.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deleteEmployeeId = $_POST['deleteEmployeeId'];

    $sql = "DELETE FROM employee_table WHERE employee_id=?";

    $deleteStmt = $conn->prepare($sql);
    $deleteStmt->bind_param("i", $deleteEmployeeId);

    if ($deleteStmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Employee is deleted successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error in deleting employee']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

header('Content-Type: application/json');
$conn->close();
