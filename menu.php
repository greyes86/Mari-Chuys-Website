<?php 
	ini_set('error_reporting', 1);
	require './includes/header.php';
	require_once '../mysqli_config2.php';  //$dbc is the connection string set upon successful connection
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
		//echo mysqli_error($result);  //Change to a generic message error before deployment
		//mysqli_close($dbc);
		//exit;
		//or for deployment
		echo "We are unable to process your request at  this  time. Please try again later.";
		include './includes/footer.php'; 
		exit;
	} 
?>
  <main id="menu_main">
	  <h2>MENU</h2><br>
		<h3>ALL OUR PLATES ARE MADE FRESH</h3><br>
		<h4>Please click the "View Details" link to view further details</h4><br>      
    	<table>
			<thead>
				<tr>
					<th>PLATE</th>
					<th>DETAILS</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($result as $row) { ?>
				<tr>
					<td id="plates"><?php echo shortTitle($row['filename']); ?></td>
					<!--			<td><img src = "images/<?php echo $row['filename'];?>"></td>use if we have thumbnails-->
					<td id="details_column"><?php echo'<a href="menu_details.php?id='. $row['Plate_id'].'">View Details</a>';?></td>
				</tr><?php } //endforeach loop ?>
			</tbody>
			
			
		</table>
  </main>
<?php include './includes/footer.php'; ?>