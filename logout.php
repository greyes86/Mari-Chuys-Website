<?php
require 'includes/header.php';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Logged Out</title>
</head>

<body>
	<h1> YOU HAVE BEEN SUCCESSFULLY LOGGED OUT</h1><br>
	<h3>Thank you for being a part of us. </h3><br>
	<h3> Please click on home button to go back to our homepage.</h3>
	<form action = "index.php">
	<input type = submit value = "HOME">
	</form>
</body>
</html>

<?php
include './includes/footer.php';
?>