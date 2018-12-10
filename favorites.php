<?php 
	ini_set('error_reporting', 1);
	include './includes/header.php';
	require_once '../mysqli_config2.php';
	
	function shortTitle ($title)
	{
		$title = substr($title, 0, -4);
		$title = str_replace('_', ' ', $title);
		$title = ucwords($title);
		return $title;
	}
	$query = "SELECT * from Menu";
	$result = mysqli_query($dbc, $query);
	//Fetch all rows of result as an associative array
	if($result)
		mysqli_fetch_all($result, MYSQLI_ASSOC);
	else 
	{ 
		echo mysqli_error($result);  //Change to a generic message error before deployment
		mysqli_close($dbc);
		exit; 
		//or for deployment
		//echo "We are unable to process your request at  this  time. Please try again later.";
		//include './includes/footer.php'; 
		exit;
	}
?>
<div class="bss-slides demo1" tabindex="1" autofocus="autofocus" id="div_slideshow">
	<?php foreach ($result as $row) {?>
    <figure>
        <img src="images/<?php echo $row['filename']; ?>" alt="<?php echo $row['FileName']; ?>"/><figcaption><?php echo $row['FileName']; ?></figcaption>
    </figure>
	<?php } ?>
</div> <!-- // bss-slides -->
<script src="https://leemark.github.io/better-simple-slideshow/demo/js/hammer.min.js"></script><!-- for swipe support on touch interfaces -->
<?php include './includes/footer.php'; ?>