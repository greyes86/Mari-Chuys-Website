<?php
	session_start();
	include './includes/title.php';
?>


<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	
	<!-- Normalized stylesheet to adjust web browsers' margins -->
	<link rel="stylesheet" href="styles/normalize.css">
			
	<!-- Customizable style sheet for proper look and feel -->
	<link rel="stylesheet" href="styles/main.css">
	
	<!-- Media Querie to adapt website to any screen size -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Website Title -->
	<title>Marichuy's Taqueria<?php if(isset($title)) {echo "&mdash;$title";} ?></title>
</head>
	
<body>	
	<!-- Includes the navigation bar along with the header -->
	<?php
		include './includes/nav_bar.php';
	?>
	
	<!-- Header section -->
	<header>
		<img src="images/marichuysLogo.png" alt="Logo">
		<h1>Marichuy's Taqueria</h1>
	</header>