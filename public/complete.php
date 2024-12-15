<?php 

    include("./DataBase/db.php");
    if(isset($_GET["task_id"])) {
        $taskID = $_GET["task_id"];
        $update_query = "UPDATE tasks SET isComplete = 1 WHERE id = {$taskID}";

        try {
            mysqli_query($conn, $update_query);
            echo "Task updated successfully <br>";
        } catch(mysqli_sql_exception) {
            echo "Error: " . mysqli_error($conn);
        }

        header("Location: index.php");
        exit();
    }

    $mysqli_close($conn);

?>