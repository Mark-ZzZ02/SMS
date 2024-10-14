<?php 
session_start();
include('includes/header.php');
?>


<!DOCTYPE html>
<html lang="en">
<?php include './layout/head_login.php' ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Times New Roman", Times, serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 0px;
  text-align: center;
  background-color:#024bde;
  color: white;
  font-family: "Times New Roman", Times, serif;
}

footer {
    background:#024bde;
    color: white;
    text-align: center;
    padding: 1rem 0;
    margin-top: 0px;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
</style>
</head>
<body>
  <h1 style="text-align:center">PREFECT ADMINISTRATOR</h1>
<div class="row">
  <div class="column">
    <div class="card">
     <center> <img src="./css/dp.jpg" alt="Benildo" style="width:50%"> </center>
      <div class="container">
        <h2>Benildo E. Concepcion</h2>
        <p class="title">HEAD</p>
        <p>Head Prefect Management.</p>
        <p>benildo.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
   <center>
    <img src="./css/pf.png" alt="Benildo" style="height: 420px;">
      <div class="container">
        
       
        
    
    </div>
  </div>
  
  <div class="column">
    <div class="card">
    <center>  <img src="./css/p.png" alt="Benildo" style="width:50%"> </center>
      <div class="container">
        <h2>Benildo E. Concepcion</h2>
        <p class="title">HEAD</p>
        <p>HEAD PREFECT.</p>
        <p>benildo@example.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

<div class="about-section">
  
  <p><center><b>VISION</b> </center>Bestlink College of the Philippines <br> Office of the Prefect of Discipline is committed to provide a highly confidential atmosphere that constitute rules on <br> the aspect of the student behavior inside the campus as well as inside the classroom. </p>
  <p><center><b>MISSION</b></center> To provide discipline among individual and ensure fair, impartial and just <br> implementation of strict rules, regulation and policies of the school..</p>
</div>


  <footer>
        
            <p>prefect.schoolmanagementsystem2.com</p>
        </div>
    </footer>



</body>
</html>