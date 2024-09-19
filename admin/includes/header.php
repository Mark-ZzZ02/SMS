<?php 
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>
    PREFECT
  </title>
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <link id="pagestyle" href="assets/css/material-dashboard.css" rel="stylesheet" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/smooth-scrollbar.min.js"></script>
  <style>
    .form-control {
        border: 1px solid #b3a1a1 !important;
        padding: 8px 10px;
      }
    .sidenav{
      background: #0D47A1;
      }
    .btn{
      background: #2196f2;
      box-shadow: 100px 100px 100px;
      }
    .container{
      align-items: center;
      justify-content: center;
      }
  </style>
  <script>  
      document.addEventListener("DOMContentLoaded", function(){
        document.querySelectorAll('.sidenav-header .nav-link').forEach(function(element){
          
          element.addEventListener('click', function (e) {

            let nextEl = element.nextElementSibling;
            let parentEl  = element.parentElement;	

              if(nextEl) {
                  e.preventDefault();	
                  let mycollapse = new bootstrap.Collapse(nextEl);
                  
                  if(nextEl.classList.contains('show')){
                    mycollapse.hide();
                  } else {
                      mycollapse.show();
                      // find other submenus with class=show
                      var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                      // if it exists, then close all of them
                      if(opened_submenu){
                        new bootstrap.Collapse(opened_submenu);
                      }
                  }
              }
          }); // addEventListener
        }) // forEach
      }); 
  </script>

</head>

<body class="g-sidenav-show  bg-gray-200">
    <?php include('sidebar.php'); ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <?php include('navbar.php'); ?>