<!-- Normal navbar for computer screen sizes -->
<?php 
	$currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
<nav>
	<ul id=nav>
		<li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>
		<li>
			<a>Menu and Favorites</a>
			<ul>
				<li><a href="menu.php"<?php if ($currentPage == 'menu.php') {echo 'id="here"'; } ?>>Menu</a></li>
				<li><a href="favorites.php"<?php if ($currentPage == 'favorites.php') {echo 'id="here"'; } ?>>Favorites</a></li>
				
			</ul>
		</li>
		<li><a href="about.php"href="about.php"<?php if ($currentPage == 'about.php') {echo 'id="here"'; } ?>>About Us</a></li>
		<ul>
		<li><?php
			if ( (isset($_SESSION['email'])) && (basename($_SERVER['PHP_SELF']) != 'lougout.php'))
			{?>
				<li style = "float:right"><a href = "lougout.php">Lougout</a></li>
			<?php } ?>
			
			<?php else { ?>
				<li style="float:right"><a>Login/Register</a>
				<ul>
					<li><a href = "login.php">Login</a></li>
					<li><a href = "register.php">Register</a></li>
				</ul>
			</li>
			<?php } ?>
		</ul>
	</ul>
</nav>


