<?php

header('Content-Type: application/json');
require '../includes/config.php';
require '../includes/functions.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// add the task
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['task'];

    if(!empty($taskName)) {
        $conn = connection();

        $result = insertRecord($conn, 'tasks', ['task_name' => $taskName, 'isComplete' => 0]);

        if($result > 0) {
            echo json_encode([
                "success" => true,
                "id" => $result,
                "task" => htmlspecialchars($taskName)
            ]);
        }
        else {
            echo json_encode(["success" => false, "message" => "Database error"]);
        }
    }
    else {
        echo json_encode(["success" => false, "message" => "Taks name cannot be empty"]);
    }
}
else {
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
