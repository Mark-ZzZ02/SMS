<?php 
session_start();
include('includes/header.php') ?>
<!DOCTYPE html>
<html>
<body background="1.jpg" height="300" width=100">
</body>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 50%;
  margin: 0;
  font-family: Arial, Cambria, sans-serif;
}

.hero-image {
  background-image: linear-gradient(rgba(0, 0, 0, 0.0), rgba(0, 0, 0, 0.1)), url("11.jpg");
  
  height: 500px;
  weight: 200px;
  background-position: center;
  background-repeat: no-repeat, repeat;
  background-size: cover;
  position: relative;
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

.hero-text button:hover {
  background-color: #555;
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
</head>
<body>

<div class="hero-image">
  <div class="hero-text">
  <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <h1 style="font-size:50px">WELCOME TO PREFECT</h1>
    <p> <u>PREFECT SIGN IN </u></p> 
    <a href="login.php "><button>OPEN</button></a> <br> 
   <th colspan="4"><marquee> BESLINK COLLEGE OF THE PHILIPPINES </marquee></th>
  </div>
</div>



<h1><b><u>INTRODUCTION</b></u></h1>
    <p style="color:white">A very Important Official In The Government or The Policy</u></p>

</body>
</html>
    


<?php include('includes/footer.php') ?>

