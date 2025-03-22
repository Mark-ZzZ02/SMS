// prefect_api.php
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
$host = '157.173.111.118'; // Your database server
$db = 'pref_prof_db';
$username = 'pref_'; // Your database username
$password = 'root'; // Your database password

// Create connection
$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);

$students = array();
while($row = $result->fetch_assoc()) {
    $students[] = $row;
}

echo json_encode($students);

$conn->close();
?>
