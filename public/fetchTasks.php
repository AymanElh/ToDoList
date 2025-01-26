<?php 

require "../includes/config.php";
require "../includes/functions.php";

// fetch all tasks

$conn = connection();

$result = selectRecords($conn, 'tasks');

$data = [];

while($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);

?>