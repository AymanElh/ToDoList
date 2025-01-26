<?php


function connection()
{
    $db_server = "localhost";
    $db_name = "todo_list";
    $db_user = "root";
    $db_password = "";

    $conn = null;

    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Database Connection Error");
    }
    return $conn;
}
