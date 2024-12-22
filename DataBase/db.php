<?php
$db_sever = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "todo_list";
$conn = "";

$conn = mysqli_connect($db_sever, $db_user, $db_password, $db_name);

if (!$conn) {
    die("Error on connect database" . mysqli_error($conn));
}

echo "You are connected <br>";

?>