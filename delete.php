<?php 

    include("./DataBase/db.php");
    if(isset($_GET["task_id"])) {
        $taskID = $_GET["task_id"];
        $update_query = "DELETE FROM tasks WHERE id = {$taskID}";

        try {
            mysqli_query($conn, $update_query);
            echo "Task deleted successfully <br>";
        } catch(mysqli_sql_exception) {
            echo "Error: " . mysqli_error($conn);
        }

        header("Location: index.php");
        exit();
    }

    $mysqli_close($conn);

?>