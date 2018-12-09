<?php
session_start();
require_once('../mysqli_config2.php');
include 'includes/header.php';
if (!isset($_SESSION['email'])){
	$message1 = 'Sorry';
	$message2 = 'You have reached this page in error!';
}
else
{
	$_SESSION=[];
	session_destroy();
	setcookie('PHPSESSID', '', time()-3600, '/', '', 0, 0);
	$message1 = 'You have logged out successfully';
	$message2 = 'THANK YOU FOR BEING PART OF US!';
}

echo "<main>";
echo "<h1>$message1</h1>";
echo "<h2>$message2</h2>";
echo "</main>";
include 'includes/footer.php';
?>