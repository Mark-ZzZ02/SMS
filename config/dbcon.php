<?php

     $host = "localhost:3308";
     $user = "root";
     $password = "";
     $database = "phpecom"; 

     $con = mysqli_connect($host, $user, $password, $database);

     if(!$con)
     {
        die("Connection Failde: ". mysqli_connect_error());
     }

?>