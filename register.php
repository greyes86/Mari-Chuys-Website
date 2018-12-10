
<?php
	ini_set('error_reporting', 1);
	include('./includes/header.php');
	require_once '../mysqli_config2.php';
//$dbc is the connection string set upon successful connection

		$missing = array();

		if(isset($_POST['submit'])) {
			if (!empty($_POST['first']))
				
				$first = mysqli_real_escape_string($dbc, trim($_POST['first']));
			else
				$missing[]= "first";
		
			if (!empty($_POST['last']))
				$last = mysqli_real_escape_string($dbc, trim($_POST['last']));
			else
				$missing[] = "last";
			
			if (!empty($_POST['email']))
				$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
			else
				$missing[] ="email"; 
			
			if (!empty($_POST['phone']))
				$phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "phone";
			
			if (!empty($_POST['address']))
				$address = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
			else
				$missing[] ="address";
			
			if (!empty($_POST['city']))
				$city = filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "city"; 
				
			if (!empty($_POST['state']))
				$state = filter_var(trim($_POST['state']), FILTER_SANITIZE_STRING);
			else
				$missing[] ="state";
			
			if (!empty($_POST['zipcode']))
				$zipcode = filter_var(trim($_POST['zipcode']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "zipcode";
			
			if (!empty($_POST['birthdate']))
				$birth = filter_var(trim($_POST['birthdate']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "birthdate";
			
			if (!empty($_POST['pwd']))
<<<<<<< HEAD
				$pwd = filter_var(trim($_POST['pwd']), FILTER_SANITIZE_STRING);
=======
				$pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);
>>>>>>> origin/master
			else
				$missing[] = "password";		
			
			if (!empty($_POST['conf']))
<<<<<<< HEAD
				$conf = filter_var(trim($_POST['conf']), FILTER_SANITIZE_STRING);
=======
				$conf = filter_var($_POST['conf'], FILTER_SANITIZE_STRING);
>>>>>>> origin/master
			else
				$missing[] = "confirmation";	
			
			if ($pwd != $conf) {
				$missing[] = "mismatched";
				$message = "The passwords don't match<br>";
					}
			if ($missing){
				foreach ($missing as $value){
					echo "<p>You forgot to enter: $value</p>";
				}
			}
			
			if (empty($missing))
			{
				echo "we are here complete form";
				require_once '../mysqli_config2.php';  //$dbc is the connection string set upon successful connection
				echo "<main>";
				
				$check = "SELECT EmailAddress FROM Customer WHERE EmailAddress='$email'";
				$exists = mysqli_query($dbc, $check);//check if username is already in database

				if(mysqli_num_rows($exists)>0){
					echo "<h2>We are sorry, but the $email is already registered under another user.</h2>";
					echo "<h2>Please try again.</h2>";
				}
				else{
					//hash password before passing into query
<<<<<<< HEAD
					
					$pwd = password_hash ($pwd, PASSWORD_DEFAULT); 
					$query = "INSERT into Customer(FirstName, LastName, EmailAddress, PhoneNumber, Address, City, State, ZipCode, Password, DateOfBirth) VALUES ('$first', '$last', '$email', '$phone', '$address', '$city', '$state', '$zipcode', '$pwd', '$birth')";
=======
					$pwd = password_hash ($pwd, PASSWORD_DEFAULT);
					$folder = preg_replace("/[^aa-zA-Z0-9]/", "", $email);
					//make lowercase
                    $folder = strtolower($folder);
					$query = "INSERT into Customer(FirstName, LastName, EmailAddress, PhoneNumber, Address, City, State, ZipCode, Password, DateOfBirth, Folder) VALUES ('$first', '$last', '$email', '$phone', '$address', '$city', '$state', '$zipcode', '$pwd', '$birth', '$folder')";
>>>>>>> origin/master
					$result = mysqli_query($dbc, $query);
					if($result) { //It worked
						//create the directory in the uploads folder
						$dirPath = "../uploads/".$folder;
						mkdir($dirPath,0777);
						echo "Thanks for registering " . htmlspecialchars($first) . " " . htmlspecialchars($last) . "<br>";
						echo "We will send a confirmation email to ". htmlspecialchars($email)."<br>";
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
<<<<<<< HEAD
			<?php if ($missing)
				echo "There were some problems. Please try again:<br>";
			?>
			
=======
>>>>>>> origin/master
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
			<label>
				Phone Number:  
				<input type="text" name="phone" <?php if(isset($phone)) echo " value=".htmlspecialchars($phone);?>>
			</label> 
			<br>
			<label>
				Address:  
				<input type="text" name="address" <?php if(isset($address)) echo " value=".htmlspecialchars($address);?>>"
			</label> 
			<br>
			<label>
				City:  
				<input type="text" name="city" <?php if(isset($city)) echo " value=".htmlspecialchars($city);?>>
			</label> 
			
			<label>
				State:  
				<input type="text" name="state" <?php if(isset($state)) echo " value=".htmlspecialchars($state);?>>
			</label> 
			<br>
			<label>
<<<<<<< HEAD
				ZipCode:  
=======
				Zip Code:  
>>>>>>> origin/master
				<input type="text" name="zipcode" <?php if(isset($zipcode)) echo " value=".htmlspecialchars($zipcode);?>>
			</label> 
			<br>
				<label>
				Date of Birth:  
<<<<<<< HEAD
				<input type="text" name="birth" <?php if(isset($birth)) echo " value=".htmlspecialchars($birth);?>>
=======
				<input type="text" name="birthdate" <?php if(isset($birthdate)) echo " value=".htmlspecialchars($birth);?>>
>>>>>>> origin/master
			</label> 
			<br>
			<!-- Inform the user if the passwords don't match but never make them sticky -->
			<?php if(isset($message)) echo "$message<br>"; ?>
			<label>
				Password:
				<input type = "password" name="pwd" > 
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
<?php include ('includes/footer.php'); ?>

