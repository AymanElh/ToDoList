<?php

require '../includes/config.php';
require '../includes/functions.php';

$conn = connection();

// complete the task
if (isset($_POST["task_id"])) {
    $taskID = $_POST["task_id"];

    $result = updateRecord($conn, 'tasks', ['isComplete' => 1], $taskID);

    if ($result) {
        echo json_encode([
            "success" => true,
            "message" => "Task completed",
            "task_id" => $taskID
        ]);
    } else {
        echo json_encode([
            "success" => true,
            "message" => "Database Error"
        ]);
    }
} else {
    echo json_encode(["success" => false, "message" => "invalid Id"]);
}
