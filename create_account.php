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
	color: white;
  font-size: 1.5rem;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.logo {
    max-width: 100%;
    height: auto;
}

.container {
    max-width: 400px; /* Limit the max width */
}

@media (max-width: 576px) {
    .container {
        width: 90%;
    }
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

    <form action="functions/autocode.php" method="POST">
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your Email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your Password" id="password" oninput="checkPasswordStrength()" required>
                    <input type="checkbox" onclick="togglePasswordVisibility('password')"> Show Password
                    <div id="password-strength" class="mt-2"></div>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm password" id="confirm-password" required>
                    <input type="checkbox" onclick="togglePasswordVisibility('confirm-password')"> Show Password
                  </div>
                  <button type="submit" name="register_btn" class="btn btn-primary w-100 mb-2">Submit</button>
                  <span class="text-danger fw-bold pt-0 d-none" id="span_error">Please fill out all fields.</span>
                  <button type="submit" class="btn btn-success w-100">Create Account</button>
                  <div class="container text-center mt-3">
                      <span class="fs-6">Already have an account?</span>
                      <a class="nav-link d-inline active rounded text-primary fs-6 text-center" href="index.php">Login</a>
    </form>

</div>

<script>
function checkPasswordStrength() {
    const password = document.getElementById("password").value;
    const strengthDisplay = document.getElementById("password-strength");
    let strength = "Weak";
    const regexWeak = /(?=.{6,})/; // at least 6 characters
    const regexMedium = /(?=.*[0-9])(?=.{8,})/; // at least 8 characters + number
    const regexStrong = /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{10,})/; // at least 10 characters + number + special char

    if (regexStrong.test(password)) {
        strength = "Strong";
        strengthDisplay.style.color = "green";
    } else if (regexMedium.test(password)) {
        strength = "Medium";
        strengthDisplay.style.color = "orange";
    } else if (regexWeak.test(password)) {
        strength = "Weak";
        strengthDisplay.style.color = "red";
    }

    strengthDisplay.innerText = `Password Strength: ${strength}`;
}

function togglePasswordVisibility(id) {
    const passwordInput = document.getElementById(id);
    passwordInput.type = passwordInput.type === "password" ? "text" : "password";
}
</script>

<?php include('includes/footer.php') ?> 
