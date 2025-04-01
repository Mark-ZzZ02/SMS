<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "prefect"; 

$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Connection Failed: " . mysqli_connect_error());
}

if (!function_exists('validate')) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        global $con;
        $data = mysqli_real_escape_string($con, $data);
        return $data;
    }
}

?>
