<?php


$host = "157.173.111.118";
$dbname = "pref_prefect";
$dbusername = "pref_roott";
$dbpass = "Prefect@14";

try {

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $con = $pdo;

} catch (PDOException $e) {

    echo "Error: " . $e->getMessage();
    exit();
}


$host = "157.173.111.118";  // or use 'localhost' if MySQL is on the same server
$username = "pref_roott";
$password = "Prefect@1sadasdasd4";
$database = "pref_prefect";

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