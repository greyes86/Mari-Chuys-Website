<?php 
	//ini_set('error_reporting', 1);
	require './includes/header.php';
	require_once '../mysqli_config2.php';  //$dbc is the connection string set upon successful connection
	function shortTitle ($title)
	{ //makes a title from the filename
		$title = substr($title, 0, -4);
		$title = str_replace('_', ' ', $title);
		$title = ucwords($title);
		return $title;
	}
	//if the image ID was sent via query string, retrieve it or set the default value to 0
	if(intval($_GET['id']>0))
	{
		$id= intval($_GET['id']);
	}
	else
	{
		$id=0;
	}
	
	//query the database to retrieve all information for the given image
	$query="SELECT * from Menu where Plate_id=$id";
	$result=mysqli_query($dbc,$query);
	
	//Fetch all rows of result as an associative array
	if($result)
	{
		mysqli_fetch_array($result, MYSQLI_ASSOC); //retreive the items from the array as scalar values to use below:

		foreach ($result as $pic)
		{
			$fileName = $pic['filename'];
			$imgTitle = $pic['PlateName'];
			$imgDetails =$pic['Details'];
			$imgPrice=$pic['Price'];
			$imgID=$id;
		}
	}
	else 
	{ 
		echo mysqli_error($result);  //Change to a generic message error before deployment
		mysqli_close($dbc);
		exit; 
		//or for deployment
		//echo "We are unable to process your request at  this  time. Please try again later.";
		include './includes/footer.php'; 
		exit;
	}
?>
  <main id="menu_details_main">
	  <h2><?php echo shortTitle($fileName);?>:</h2>
	  <p><img src="images/<?php echo $fileName; ?>" alt="<?php echo $fileName; ?>"></p>
	  <h3><strong>Description:</strong></h3>
	  <h4><?php echo $imgTitle; ?></h4>
	  <h4><?php echo $imgDetails; ?></h4>
	  <h4><strong>Price: </strong>$<?php echo $imgPrice; ?>
		  <form style="display:inline;" action="#" method="post">
			  <input type="hidden" name="action" value="add">
			  <input type="hidden" name="image_id" value="<?php echo $imgID; ?>">
			  <input type="hidden" name="qty" value = 1>
			  <!--	  <input type="submit" value="Add to Cart">-->
		  </form></h4>
  </main>
<?php include './includes/footer.php'; ?>