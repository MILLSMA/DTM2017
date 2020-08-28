<!DOCTYPE html>
<html lang="en">	
	<head>
		<meta charset="utf-8">
		<title>Onslow College | Courses</title>

		<meta name="description" content="Cotains infomration about all the coursew offered at Onslow College">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/styles.css" rel="stylesheet">
		<script src="js/script.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
	</head>
	<body>
		<?php
		$dbc = mysqli_connect("localhost", "millsma", '$2y$10$QTt6z5jqyQMaqFkF.jCtMO55SCZqFZYv00pdVh5FQlf5WJqw6dtRe', "millsma_handbook");
		?>

		<div class="nav" id="navid">
	<a href="index.php" class="active"><h1>Onslow College</h1></a>
  <a href="index.php">Courses</a>
  <a href="vocational.php">Vocational Pathways</a>
  <a href="about_ncea.php">About NCEA</a>
  <a href="javascript:void(0);" class="icon" onclick="hammenu()">
    <div class="fa fa-bars"></div>
  </a>
</div>

