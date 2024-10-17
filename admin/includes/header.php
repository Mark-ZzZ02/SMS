<?php 
session_start(); ?>
	<head>
	<title>School Management System</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="./css/bcp_logo.png" type="image/png">
	<link href="./css/bootstrap.min.css" rel="stylesheet">
	<link href="./css/image.css" rel="stylesheet">
	<link href="./css/logo_login.css" rel="stylesheet">
	<link href="./css/login_font.css" rel="stylesheet">
	<link href="./css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" rel="stylesheet">
	<link rel="stylesheet" href="mystyle.css">
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/bootstrap.min.css"/>
	<script src="./js/bootstrap.bundle.min.js"></script>
	<script src="./js/jquery/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script>
	function toggleCustomOffense() {
		const select = document.getElementById('offenseType');
		const customOffenseInput = document.getElementById('customOffense');
		if (select.value === 'other') {
			customOffenseInput.style.display = 'block';
		} else {
			customOffenseInput.style.display = 'none';
			customOffenseInput.value = ''; // Clear the input when not in use
		}
	}
	</script>
	</head>
    <main>
    <?php include('sidebar.php'); ?>
    <?php include('navbar.php'); ?>