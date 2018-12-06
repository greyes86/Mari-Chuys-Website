<!-- Normal navbar for computer screen sizes -->
<nav>
	<ul>
		<li><a href="index.php">Home</a></li>
		<li>
			<a>Menu and Favorites</a>
			<ul>
				<li><a  href="menu.php">Menu</a></li>
				<li><a>Favorites</a></li>
			</ul>
		</li>
<<<<<<< HEAD
		<li><a>Link 3</a></li>
		<?php
			if ( (isset($_SESSION['email'])) && (basename($_SERVER['PHP_SELF']) != 'lougout.php'))
			{
				echo '<li style = "float:right"><a href = "lougout.php">Lougout</a></li>';
			}
			else
			{
				echo '<li style="float:right"><a>Login/Register</a>
				<ul>
					<li><a href = "login.php">Login</a></li>
					<li><a href = "register.php">Register</a></li>';
			}
		?>
=======
		<li><a href = "about.php">About Us</a></li>
		<li style="float:right">		<a>Login/Register</a>
			<ul>
				<li><a href = "login.php">Login</a></li>
				<li><a href = "register.php">Register</a></li>
			</ul>
		</li>
>>>>>>> origin/master
	</ul>
</nav>