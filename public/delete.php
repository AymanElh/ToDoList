<?php

require '../includes/config.php';
require '../includes/functions.php';

$conn = connection();

// delete the task
if (isset($_GET["task_id"])) {
    $taskID = (int)$_GET["task_id"];

    $result = deleteRecord($conn, 'tasks', $taskID);

    if ($result) {

        echo json_encode([
            "success" => true,
            "message" => "Task Deleted",
            "task_id" => $taskID
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "task deletion failed"
        ]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid Id"]);
}
