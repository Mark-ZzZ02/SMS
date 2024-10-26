<?php 
session_start();
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include './layout/head_login.php' ?>

<style>
.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}


.container {
    max-width: 400px; /* Limit the max width */
}


</style>

<body>
<div class="container-fluid p-6 text-white text-center"></div>

<div class="container mt-3 p-4 shadow rounded-4 bg-white text-black">
    <div class="d-flex justify-content-center align-items-center mb-3">
        <img src="./css/bcp_logo.png" alt="Logo" class="logo">
    </div>
    <div class="text-center mb-3">
        <h2>Sign in</h2>
    </div>

    <?php 
    if (isset($_SESSION['message'])) {
        ?> 
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?= $_SESSION['message']; ?>.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION['message']);
    }
    ?>

    <form action="functions/autocode.php" method="POST" class="py-2">
        <div class="mb-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Enter email" id="txt_username" name="email" required aria-label="Email">
        </div>
        <div class="mb-3">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" id="txt_password" name="password" required aria-label="Password">
        </div>

        <span class="text-danger fw-bold d-none" id="span_error">Error: Username and Password</span>

        <button type="submit" name="login_btn" class="btn btn-primary w-100">Login</button>
        
        <div class="text-center mt-3">
            <a class="btn btn-success w-100" href="create_account.php">Create Account</a>
        </div>
    </form>
</div>
</body>
</html>



<?php include('includes/footer.php') ?>