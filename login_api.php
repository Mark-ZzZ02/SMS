<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

session_start();
include_once("connection/connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Use PDO for the query (no mysqli functions)
        $sql = "SELECT * FROM users WHERE email = :username";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        
        // Check if the result has any rows
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Check if the password matches the hashed password
            if (password_verify($password, $row['password'])) {
                          $_SESSION['auth'] = true;

            $username = $userdata['name'];
            $role_as = $userdata['role_as'];
            
            $_SESSION['auth_user'] = [
                'name' => $username,
                'email' => $email
            ];

            $_SESSION['role_as'] = $role_as;

            $_SESSION['message'] = "Welcome to Dashboard";
            
                // Redirect after successful login
                 header("Location: https://prefect.schoolmanagementsystem2.com/admin/index.php");
				//echo "sample";
                exit();
             
            } else {
                echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'User not found']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Missing username or password fields']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request']);
  
    exit();
  
}
?>
