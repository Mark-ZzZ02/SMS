<?php

     $host = "localhost:3308";
     $username = "root";
     $password = "";
     $database = "prefect"; 

     $con = mysqli_connect($host, $username, $password, $database);

     if(!$con)
     {
        die("Connection Failde: ". mysqli_connect_error());
     }

?>