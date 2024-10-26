<?php

session_start();
include('../config/dbcon.php');
include('myfunctions.php');

if (isset($_POST['register_btn'])) {  
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $check_email_query = "SELECT email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "Email already registered";
        header('Location: ../create_account.php');
    } else {
        if ($password == $cpassword) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $_SESSION['message'] = "Registered Successfully";
                header('Location: ../index.php');
            } else {
                $_SESSION['message'] = "Something went wrong";
                header('Location: ../create_account.php');
            }
        } else {
            $_SESSION['message'] = "Passwords do not match";
            header('Location: ../create_account.php');
        }
    }
}

else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_query = "SELECT * FROM users WHERE email='$email'";
    $login_query_run = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_query_run) > 0)
    {
        $userdata = mysqli_fetch_array($login_query_run);
        $hashed_password = $userdata['password'];

        // Verify the password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['auth'] = true;

            $username = $userdata['name'];
            $role_as = $userdata['role_as'];
            
            $_SESSION['auth_user'] = [
                'name' => $username,
                'email' => $email
            ];

            $_SESSION['role_as'] = $role_as;

            $_SESSION['message'] = "Welcome to Dashboard";

            // Check user role and redirect accordingly
            if ($role_as == 1) {
                header('Location: ../admin/index.php');
            } elseif ($role_as == 2) {
                header('Location: ../staff/index.php');
            } else {
                header('Location: ../validation/index.php'); 
            }
            exit();
        } else {
            $_SESSION['message'] = "Invalid email or password";
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid email or password";
        header('Location: ../index.php');
        exit();
    }
}


?>