<?php 
session_start();
include('includes/header.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php include './layout/head_login.php' ?>
<style>
  
body {
  
  
  font-family: "Times New Roman", Times, serif;
    line-height: 1.6;
}

.hero-image {
  background: url('11.jpg') no-repeat center center/cover;
  

    color: white;
    height: 110vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.hero-image1 {
  background:no-repeat center center/cover;
  
   
    justify-content: center;
    align-items: center;
    text-align: center;
}

.hero-text {
  text-align: center;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-shadow: 0 0 30px;
  
  color: #FFF9E3;
}

.hero-text button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 10px 25px;
  color: black;
  background-color: #ddd;
  text-align: center;
  cursor: pointer;
}

footer {
  
    background:#024bde;
    color: white;
    text-align:right;
    padding: 1rem 0;
    margin-top: 0px;
}


.hero-text button:hover {
  background-color: #273be2;
  color: white;
}

    hr {
        position: relative;
        top: 20px;
        border: none;
        height: 12px;
        background: black;
        margin-bottom: 50px;
    }
</style>
<body>

<div class="hero-image">
  <div class="hero-text">
   <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <h1 style="font-size:50px">WELCOME TO PREFECT</h1>
    
    <a href="login.php "><button>LOGIN</button></a> <br> 
   <th colspan="4"><marquee> BESLINK COLLEGE OF THE PHILIPPINES </marquee></th>
  </div>
</div>



<footer>
<div class="hero-image1">
<img src="bc1.jpg"  width="350" height="250">
<img src="bc2.jpg"  width="350" height="250">
<img src="bc3.jpg"  width="350" height="250">
<img src="bc4.jpg"  width="350" height="250">


          <center>  <p>prefect.schoolmanagementsystem2.com</p> </center>
        </div>
    </footer>
    

</body>
</html>
    


<?php include('includes/footer.php') ?>

