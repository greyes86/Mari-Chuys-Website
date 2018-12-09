<!-- Normal navbar for computer screen sizes -->
<?php 
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<nav>
	<ul id=nav>
		<li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>
		<li>
			<a>Menu and Favorites</a>
			<ul>
				<li><a href="menu.php"<?php if ($currentPage == 'menu.php') {echo 'id="here"';}?>>Menu</a></li>
				<li><a href="favorites.php"<?php if ($currentPage == 'favorites.php') {echo 'id="here"';} ?>>Favorites</a></li>
				
			</ul>
		</li>
		<li><a href="about.php"href="about.php"<?php if ($currentPage == 'about.php') {echo 'id="here"';} ?>>About Us</a></li>
			<?php
				if ( isset($_SESSION['EmailAddress']) && basename($_SERVER['PHP_SELF']) != 'logout.php')
				{
					echo '<li><a>Upload Images</a>
							<ul>
								<li><a href = "upload_profile_image">Upload Profile Image</a></li>
								<li><a href = "upload_favorite_plate_image">Upload Favorite Plate Image</a></li>
							</ul>
						   </li>';
					echo '<li style="float:right"><a href = "logout.php">Logout</a></li>';
				}
				else
				{
					echo '<li style="float:right"><a>Login/Register</a>
							<ul>
								<li><a href = "login.php">Login</a></li>
								<li><a href = "register.php">Register</a></li>
							</ul>';
				}
			?>
	</ul>
</nav>


