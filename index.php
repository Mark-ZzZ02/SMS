<?php 
session_start();
include('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include './layout/head_login.php'?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<script src="assets/js/password-show.js"></script>
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
    max-width: 400px;
}

.vh-90 {
    height: 90vh;
}

.login {
    background-image: url('./css/login-background.jpg');
    background-size: cover;
    background-position: center center;
}

</style>

<body>
    <div class="login d-flex align-items-center justify-content-center vh-90">
        <div class="container p-4 shadow rounded-4 bg-white text-black">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <img src="./css/bcp_logo.png" alt="Logo" class="logo">
            </div>
            <div class="text-center mb-3">
                <h2>Sign in</h2>
            </div>

            <?php 
            if (isset($_SESSIddON['message'])) {
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
                    <input type="email" class="form-control" placeholder="Enter email" id="txt_usedrname" name="email" required aria-label="Email">
                </div>
                <div class="mb-3">
                    <label for="pwd">Password:</label>
                    <div class="position-relative">
                        <input 
                        type="password" class="form-control" 
                        placeholder="Enter password" id="password" 
                        name="password" required aria-label="Password"
                        >
                        <button type="button"
                            class="btn btn-sm btn-link position-absolute top-50 translate-middle-y"
                            style="right: 10px; z-index: 2; padding: 0; color: #6c757d;">
                            <i id="passwordToggleIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    
                </div>

                <span class="text-danger fw-bold d-none" id="span_error">Error: Username and Password</span>

                <button type="submit" name="login_btn" class="btn btn-primary w-100">Login</button>
                
                <div class="text-center mt-3">
                    <a class="btn btn-success w-100" href="create_account.php">Create Account</a>
                </div>
            </form>
        </div>
    </div>
    
    
</body>
</html>



<?php include('includes/footer.php') ?>