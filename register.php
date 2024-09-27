<?php 
session_start();
include('includes/header.php');
?>

<div class="container-fluid p-5 text-white text-center">
  <!--<h1 class="text-shadow">School Management System</h1>-->
</div>

<div class="container mt-3 p-4 shadow rounded-4 w-25 bg-white text-black">
    <div class="container d-flex justify-content-center align-items-center full-height">
        <img src="admin/css/bcp_logo.png" alt="Logo" class="logo">
    </div>
    <div class="container text-black text-center">
    <h4>Registration Form</h4> 
    </div>

    <?php 
     if(isset($_SESSION['message'])) 
     {
       ?> 
       <div class="alert alert-warning alert-dismissible fade show" role="alert">
               <strong>Hey!</strong> <?= $_SESSION['message']; ?>.
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
             <?php
             unset($_SESSION['message']);
     }
    ?>

    <form action="functions/autocode.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your Email" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your Password" id="exampleInputPassword1">
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm password">
                  </div>
                  <button type="submit" name="register_btn" class="btn btn-primary">Submit</button>
                </form>
</div>


<?php include('includes/footer.php') ?>