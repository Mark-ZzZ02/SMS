<?php 

include('includes/header.php');
include('../middleware/adminMiddleware.php');

?>

<div class="container-fluid p-4 bg-white text-black text-center">
</div>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 p-4 shadow"> 
        <div class="col-md-12">
        <h4>ADD USERS</h4> 
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

    <form action="codeuser.php" method="POST">
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
                  <button type="submit" name="add_user_btn" class="btn btn-primary">Submit</button>
                </form>
    </div>
</div>

<script>
function checkPasswordStrength() {
    const password = document.getElementById("password").value;
    const strengthDisplay = document.getElementById("password-strength");
    let strength = "Weak";
    const regexWeak = /(?=.{6,})/; 
    const regexMedium = /(?=.*[0-9])(?=.{8,})/; 
    const regexStrong = /(?=.*[0-9])(?=.*[!@#$%^&*])(?=.{10,})/; 

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

<?php include('includes/footer.php');?> 
