<?php 
session_start();
include('includes/header.php') ?>
<!DOCTYPE html>
<html>
<head>
  
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  
    font-family: 'Arial', sans-serif;
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
    background:#273be2;
    color: white;
    text-align: center;
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
</head>
<body>

<div class="hero-image">
  <div class="hero-text">
  <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <h1 style="font-size:50px">WELCOME TO PREFECT</h1>
    
    <a href="login.php "><button>PREFECT ADMISSION CLICK HERE</button></a> <br> 
   <th colspan="4"><marquee> BESLINK COLLEGE OF THE PHILIPPINES </marquee></th>
  </div>
</div>


<footer>
        
            <p>&copy;  2024 BCP.com</p>
        </div>
    </footer>

</body>
</html>
    


<?php include('includes/footer.php') ?>

