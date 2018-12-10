<?php 
	require 'includes/header.php';
    session_start();
?>
<main>
	<ul>
		<?php
			if (isset($_SESSION['EmailAddress']))
			{
				$folder = $_SESSION['Folder'];
				//This script lists the images in the uploads directory.
				$dir = '../uploads'.$folder; // Define the directory to view.
				$files = scandir($dir); // Read all the images into an array.
				echo '<p>Click on an image to view it in a separate window.</p>';
				// Display each image caption as a link 
				foreach ($files as $image) 
				{
					if (substr($image, 0, 1) != '.') 
					{ // Ignore anything starting with a period.
					  	// Get the image's size in pixels:
						$image_size = getimagesize ("$dir/$image");
						// Make the image's name URL-safe:
						$image_name = urlencode($image);
						// Print the information:
						echo "<li><a href=\"show_image.php?image=".$image."\">".$image."</a></li>\n";
					} // End of the IF.
				} // End of the foreach loop.
			}
			else
			{
				echo '<h2>You are not logged in. Please make sure to login in order to see your favorite plates images.</h2>';
			}
		?>
	</ul>
</main>
<?php include './includes/footer.php'; ?>