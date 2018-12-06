<?php
	ini_set('error_reporting', 1);
	require './includes/header.php';
	require_once '../mysqli_config2.php';  //$dbc is the connection string set upon successful connection
		$missing = array();	
		if(isset($_POST['submit'])) {
			if (!empty($_POST['first']))
			
				$first=filter_var(trim($_POST['first']), FILTER_SANITIZE_STRING);
			else
				$missing[]= "first";
		
			if (!empty($_POST['last']))
				
				$last=filter_var(trim($_POST['last']), FILTER_SANITIZE_STRING);
			else
				$missing['last'] = "Last name is missing<br>";
			
			if (!empty($_POST['email']))
				$email =filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
			else
				$missing[] = "Email is missing<br>";
			
			if (!empty($_POST['pwd']))
				$pwd = $_POST['pwd'];
			else
				$missing[] = "password";		
			
			if (!empty($_POST['conf']))
				$conf = $_POST['conf'];
			else
				$missing[] = "confirmation";	
			
			if ($pwd != $conf) {
				$missing[] = "mismatched";
				$message = "The passwords don't match<br>";
			}
						
			if (empty($missing))
			{
				require_once '../mysqli_config2.php';  //$dbc is the connection string set upon successful connection
				echo "<main>";
				
//NEED TO ENTER QUERY HERE FROM RESTAURANT DATABASE	
				
//				$check= "SELECT emailAddr FROM JJ_reg_users WHERE emailAddr='$email'";
//				$exists= mysqli_query($dbc, $check);//check if username is already in database

				if(mysqli_num_rows($exists)>0){
					echo "sorry $email already exists";
				}
				else{
					//hash password before passing into query
					$pwd = password_hash ($pwd, PASSWORD_DEFAULT); 
					$query = "INSERT into JJ_reg_users(firstName, lastName, emailAddr, pw) VALUES ('$first', '$last', '$email','$pwd')";
					$result = mysqli_query($dbc, $query);
					if($result) { //It worked
					echo "Thanks for registering".  htmlspecialchars($first). htmlspecialchars($last)."<br>";
					echo "We will send a confirmation email to". htmlspecialchars($email)."<br>";
					}
					
				}
			echo "</main>";
			include 'includes/footer.php';
			exit;
			}
			
	}
	?>
	<main>
	<form method = "post" action="register.php">  
	<!-- the get method would not normally be used for site registration -->
	<!-- it is used here to help find the problems with the form -->
		<fieldset>
			<?php if ($missing)
				echo "There were some problems. Please try again:<br>";
			?>
			<legend>Create Your Account with Us!</legend>
			<label>
				First Name:  
				<input type="text" name="first" <?php if(isset($first)) echo " value=".htmlspecialchars($first);?>>
			</label> 
			<br>
			<label>
				Last Name: 
				<input type="text" name="last" <?php if (isset($last)) echo " value=".htmlspecialchars($last);?>>
			</label>
			<br>
			<label>
				Email: 
				<input type = "email" name="email" <?php if (isset($email)) echo " value=".htmlspecialchars($email);?>> 
			</label>
			<br>
			<!-- Inform the user if the passwords don't match but never make them sticky -->
			<?php if(isset($message)) echo "$message<br>"; ?>
			<label>
				Password:
				<input type = "password" name="pwd"> 
			</label>
			<br>
			<label>
				Confirm Password: 
				<input type = "password" name = "conf">
			</label>
		</fieldset>
			<br>
			<input type = submit value = "Register" name="submit">
	</form>
	</main>
<?php include 'includes/footer.php'; ?>

