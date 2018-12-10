
<?php
	ini_set('error_reporting', 1);
	include('./includes/header.php');
	require_once '../mysqli_config2.php';
//$dbc is the connection string set upon successful connection

		$missing = array();

		if(isset($_POST['submit'])) {
			if (!empty($_POST['first']))
			
				$first=filter_var(trim($_POST['first']), FILTER_SANITIZE_STRING);
			else
				$missing[]= "first";
		
			if (!empty($_POST['last']))
				
				$last=filter_var(trim($_POST['last']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "last";
				//echo "Last name is missing<br>";
			
			if (!empty($_POST['email']))
				$email =filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
			else
				$missing[] ="email"; 
				//echo "Email is missing<br>";
			
			if (!empty($_POST['phone']))
				
				$phone=filter_var(($_POST['phone']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "phone";
				//echo "phone number is missing.<br>";
			
			if (!empty($_POST['address']))
				
				$address=filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
			else
				$missing[] ="address";
				//echo "Address is missing.<br>";
			
			if (!empty($_POST['city']))
				
				$city=filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "city"; 
				//echo "City is missing.<br>";
				
			if (!empty($_POST['state']))
				
				$state=filter_var(trim($_POST['state']), FILTER_SANITIZE_STRING);
			else
				$missing[] ="state";
				//echo "State is missing.<br>";
			
			if (!empty($_POST['zipcode']))
				
				$zipcode=filter_var(trim($_POST['zipcode']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "zipcode";
				//echo "ZipCode is missing.<br>";
			
			if (!empty($_POST['birth']))
				
				$birth=filter_var(trim($_POST['birth']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "birth";
				//echo "Birthday is missing. <br>";
			
			if (!empty($_POST['pwd']))
				$pwd = filter_var(trim($_POST['pwd']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "password";		
			
			if (!empty($_POST['conf']))
				$conf = filter_var(trim($_POST['conf']), FILTER_SANITIZE_STRING);
			else
				$missing[] = "confirmation";	
			
			if ($pwd != $conf) {
				$missing[] = "mismatched";
				$message = "The passwords don't match<br>";
					}
			if ($missing){
//				echo "There were some problems. Please try again:<br>";
				foreach ($missing as $value){
					echo "You forgot to enter: -$value";
				}
			}
			
			if (empty($missing))
			{
				echo "we are here complete form";
			
				require_once '../mysqli_config2.php';  //$dbc is the connection string set upon successful connection
				echo "<main>";
				
//NEED TO ENTER QUERY HERE FROM RESTAURANT DATABASE	
				
				$check= "SELECT emailAddr FROM JJ_reg_users WHERE emailAddr='$email'";
				$exists= mysqli_query($dbc, $check);//check if username is already in database

				if(mysqli_num_rows($exists)>0){
					echo "sorry $email already exists";
				}
				else{
					//hash password before passing into query
					
					$pwd = password_hash ($pwd, PASSWORD_DEFAULT); 
					$query = "INSERT into Customer(FirstName, LastName, EmailAddress, PhoneNumber, Address, City, State, ZipCode, Password, DateOfBirth) VALUES ('$first', '$last', '$email', '$phone', '$address', '$city', '$state', '$zipcode', '$pwd', '$birth')";
					$result = mysqli_query($dbc, $query);
					if($result) { //It worked
					echo "Thanks for registering".  htmlspecialchars($first). htmlspecialchars($last)."<br>";
					echo "We will send a confirmation email to". htmlspecialchars($email)."<br>";
					}
					else{echo"didnt work";
						echo "you are here2 did not go into database";}
					
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
			<label>
				phone Number:  
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
				ZipCode:  
				<input type="text" name="zipcode" <?php if(isset($zipcode)) echo " value=".htmlspecialchars($zipcode);?>>
			</label> 
			<br>
				<label>
				Date of Birth:  
				<input type="text" name="birth" <?php if(isset($birth)) echo " value=".htmlspecialchars($birth);?>>
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

