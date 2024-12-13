<?php
    $db_sever = "localhost";
    $db_user = "root";
    $db_password = "ayman@2003";
    $db_name = "todo_list";
    $conn = "";

    try{
        $conn = mysqli_connect($db_sever, $db_user, $db_password, $db_name);
    } catch(mysqli_sql_exception) {
        echo "Error on connect database";
    }

    if($conn) {
        echo "You are connected <br>";
    }
?>