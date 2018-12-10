<?php
	require 'includes/header.php';
	echo "<main>";
	if (isset($_SESSION['Folder']))
	{ //set at login
		// Check if the form has been submitted:
		if (isset($_POST['submit'])) 
		{
			// Check for an uploaded file:
			if (isset($_FILES['upload'])) 
			{
				// Validate the type. Should be GIF, JPEG or PNG.
				$allowed = array ('image/jpeg', 'image/png', 'image/gif');
				if (in_array($_FILES['upload']['type'], $allowed)) 
				{
					// Move the file over.
					$folder = $_SESSION['Folder'];
					$email = $_SESSION['EmailAddress'];
					$image_path = $_FILES['upload']['tmp_name'];
					$image_name = $_FILES['upload']['name'];
					
					$dirPath = "../uploads/$folder/$image_name";
					if (file_exists($dirPath))
					{
						echo '<h2>We are sorry, but the file already exists.</h2>';
						echo '<h2>Please try uploading the same file again to rewrite it or try uploading a new file.</h2>';
					}
					else 
					{
						if ((move_uploaded_file ($_FILES['upload']['tmp_name'], "../uploads/$folder/$image_name"))) 
						{  //adjust path if needed
							echo '<h2>The file '.$image_name.' has been uploaded!</h2>';	
							$type=$_FILES['upload']['type'];
							//write to database
							require_once ('../mysqli_config.php'); // Connect to the db.
							$sql = "INSERT into JJ_user_images (emailAddr, imageName, imageType) VALUES (?, ?, ?)";
							$stmt = mysqli_prepare($dbc, $sql);
							mysqli_stmt_bind_param($stmt, "sss", $email, $image_name, $type);
							if (mysqli_stmt_execute($stmt))
							{
								echo '<h3>And the file data has been saved.</h3>';
								include ('create_thumb.php');
							}
							else 
							{
								echo '<h2>We were unable to save your file data.</h2></main>';
							}						
							echo "</main>";
							include './includes/footer.php'; 
							// Delete the file if it still exists:
							if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']))
							{
								unlink ($_FILES['upload']['tmp_name']);
							}
							exit;
						} // End of move... IF.	
						else 
						{
							echo '<h2>The file upload was unsuccessful.</h2>';
							echo '<h3>Please try again.</h3>';
						}
					}
				} 
				else 
				{ // Invalid type.
					echo '<h2 class="warning">Please upload a GIF, JPEG or PNG image.</h2>';
				}
			} // End of isset($_FILES['upload']) IF.
			// Check for an error:
			if ($_FILES['upload']['error'] > 0) 
			{
				echo '<p class="warning">The file could not be uploaded because: <strong>';
				// Print a message based upon the error.
				switch ($_FILES['upload']['error']) 
				{
					case 1:
						echo 'The file exceeds the upload_max_filesize setting in php.ini.';
						break;
					case 2:
						echo 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
						break;
					case 3:
						echo 'The file was only partially uploaded.';
						break;
					case 4:
						echo 'No file was uploaded.';
						break;
					case 6:
						echo 'No temporary folder was available.';
						break;
					case 7:
						echo 'Unable to write to the disk.';
						break;
					case 8:
						echo 'File upload stopped.';
						break;
					default:
						echo 'A system error occurred.';
						break;
				} // End of switch.
				echo '</strong></p>';
			} // End of error IF.		
		} // End of the submitted conditional.
	} //end of session IF
	else 
	{
		echo "<h2>We are sorry, but you must be logged in as a registered user to upload images</h2>";
		echo "<h3>Use the Register link at the left to create an account</h3>";
		echo "<h3>or Login if you have an account.</h3></main>";
		include ('includes/footer.php');
		exit;
	}
?>
	<h2>Upload an image</h2>
	<form enctype="multipart/form-data" action="upload_image.php" method="post">
		<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
		<fieldset>
			<legend>Select a GIF, JPEG or PNG image of 2M or smaller to be uploaded:</legend>
			<label>
				File:<input type="file" name="upload">
			</label>
			<label>And press
				<input type="submit" name="submit" value="Submit">
			</label>
		</fieldset>
	</form>
</main>
<?php include 'includes/footer.php'; ?>