<?php
require_once("dbcon.php");

$sql = "SELECT * FROM medicine_table";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
file_put_contents('med_table.json', $jsonData);

$conn->close();
