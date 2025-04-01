// send_to_mis.php
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $host = '157.173.111.118';
    $db = '	mis_db2'; 
    $username = 'mis_root2';
    $password = 'root';

    $conn = new mysqli($host, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("INSERT INTO students (first_name, last_name, email, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $data['first_name'], $data['last_name'], $data['email'], $data['course']);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'invalid data']);
}
?>
