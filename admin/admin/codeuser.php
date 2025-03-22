<?php
session_start();
include('../config/dbcon.php');
include('../functions/myfunctions.php');

if(isset($_POST['add_user_btn']))
{  
    $name = mysqli_real_escape_string($con,$_POST['name']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
  
    $check_email_query = "SELECT email FROM users WHERE email='$email' ";
    $check_email_query_run =  mysqli_query($con, $check_email_query);
  
          if(mysqli_num_rows($check_email_query_run) > 0)
          {
              $_SESSION['message'] = "Email already registered";
              header('Location: add-user.php');
          }
          else
          {
              if($password == $cpassword)
              {
                  $insert_query = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
                  $insert_query_run = mysqli_query($con, $insert_query);
  
                  if($insert_query_run)
                  {
                      $_SESSION['message'] = "Registered Successfully";
                      header('Location: users.php');
                  }
                  else
                  {
                      $_SESSION['message'] = "Something went wrong";
                      header('Location: users.php');
                  }
                  
              }
              else
              {
                  $_SESSION['message'] = "Password do not match";
                  header('Location: ../create_account.php');
              }
          }
  
  
  }
else if (isset($_POST['update_user_btn'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashed_password = $old_password; 
    }

    if ($new_image != "") {
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    $update_query = "UPDATE users SET name='$name', email='$email', password='$hashed_password', 
    role_as='$role_as', image='$update_filename' WHERE id='$category_id'";
    
    $update_query_run = mysqli_query($con, $update_query);

    if ($update_query_run) {
        if ($_FILES['image']['name'] != "") {
            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }
        }
        redirect("users.php?id=$category_id", "Users Updated Successfully");
    } else {
        redirect("users.php", "Something Went Wrong");
    }
}



else if(isset($_POST['delete_user_btn']))
{
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $category_query = "SELECT * FROM users WHERE id='$category_id'";
    $category_query_run = mysqli_query($con, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM users WHERE id='$category_id' ";
    $delete_query_run = mysqli_query($con, $delete_query);

    if($delete_query_run)
    {
        if(file_exists("../uploads/".$image))
        {
            unlink("../uploads/".$image);
        }
        redirect("users.php", "user Deleted Successfully");
    }
    else
    {
        redirect("users.php", "Something Went Wrong");
    }
}
?>