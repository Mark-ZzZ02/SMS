<?php
include('../functions/myfunctions.php');

if (isset($_SESSION['auth'])) {
  // Check if the user is not an admin (role 1) or a regular user (role 0)
  if ($_SESSION['role_as'] != 1 && $_SESSION['role_as'] != 0 && $_SESSION['role_as'] != 2) {
      redirect("../index.php", "You are not authorized to access this page");
  }
} else {
  redirect("../index.php", "Login to continue"); 
}

?>