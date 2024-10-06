<?php 
session_start();
include('includes/header.php');
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
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
  padding: 50px;
  text-align: center;
  background-color:#024bde;
  color: white;
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

<div class="about-section">
  <h1>PREFECT ADMINISTRATOR</h1>
  <p><center><b>VISION</b> </center>Bestlink College of the Philippines, Office of the Prefect of Discipline is committed to provide a highly confidential atmosphere that constitute rules on the aspect of the student behavior inside the campuS as well as inside the classroom. </p>
  <p><center><b>MISSION</b></center> To provide discipline among individual and ensure fair, impartial and just implementation of strict rules, regulation and policies of the school..</p>
</div>

<h2 style="text-align:center">ADMIN</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="./css/p.png" alt="Benildo" style="width:50%">
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
      <img src="./css/p.png" alt="Benildo" style="width:50%">
      <div class="container">
        <h2>Benildo E. Concepcion</h2>
        <p class="title">HEAD</p>
        <p>HEAD PREFECT.</p>
        <p>benildo@example.com</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  <footer>
        
            <p>&copy;  2024 Prefect.com</p>
        </div>
    </footer>



</body>
</html>