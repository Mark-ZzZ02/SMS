<?php


$host = "157.173.111.118";
$dbname = "pref_prefects";
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

?>