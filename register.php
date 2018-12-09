<?php 
	include('includes/header.php');
?>

<?php
	
	if (isset($_POST['submit'])) {
	
		// Create scalar variables for the form data:
		if (!empty($_POST['first']))
			$first = $_POST['first'];
		else
			$missing[] = "first";
		
		if (!empty($_POST['last']))
			$last = $_POST['last'];
		else
			$missing[] = 'last';
		
		if (!empty($_POST['email']))
			$email = $_POST['email'];
		else
			$missing[] = "email";
		
		if (!empty($_POST['phone']))
			$phone = $_POST['phone'];
		else
			$missing[] = 'phone';
		
		if (!empty($_POST['address']))
			$address = 'address';
		else
			$missing[] = 'address';
		
		if (!empty($_POST['city']))
			$city = 'city';
		else
			$missing[] = 'city';
		
		if (!empty($_POST['state']))
			$state = 'state';
		else
			$missing[] = 'state';
		
		if (!empty($_POST['zip']))
			$zip = 'zip';
		else
			$missing[] = 'zip';
		
		
		//The first option of a select list is the default, so there will always be something set
		if ($_POST['age'] != "default") {
			$age = $_POST['age'];
		}
		else
			$missing[] = "age";
		if ($missing) { //There is at least one element in the $missing array
			echo 'You forgot the following form item(s):<br>';
			//output the contents of the array
			foreach ($missing as $value)
			{
				echo "<p>-$value</p>";
			}
		}
		else {
			//Form was filled out completely and submitted. Print the submitted information:
			echo "<p>Thank you, $name, for the following comments:<br>";
			echo "<pre>\"$comments\"</pre>"; //HTML pre is preformatted text. We are assuming the comment is non-malicious
			echo "<p>We will reply to you at $email</p>";
			echo "You entered <strong>$age</strong> for your year of birth, and <strong>$gender</strong> for your gender<br>";
			exit;
		}
	}
?>

<form action="register.php" method="post">
	<fieldset>
		<legend>Enter your information in the form below:</legend>
		
		<p>
			<label>
				Name: 
				<input type="text" name="name" size="20" maxlength="40" 
					   value="<?php 
							  	if (isset($_POST['name'])) {
									echo $_POST['name'];
								}
							  ?>">
			</label>
		</p>

		<p>
			<label>
				Email Address: 
				<input type="email" name="email" size="40" maxlength="60"
					   value="<?php
							  	if (isset($_POST['email'])) {
									echo $_POST['email'];
								}
							  ?>">
			</label>
		</p>

		<p>
			<label for="gender">
				Gender: 
			</label>
			<input type="radio" name="gender" value="M" 
				   <?php
				   		if ($gender == 'M') {
							echo 'checked="checked"';
						}
				   ?>> Male
			
			<input type="radio" name="gender" value="F"
				   <?php
				   		if ($gender == 'F') {
					   		echo 'checked="checked"';
				   		}
				   ?>> Female
		</p>

		<p>
			<label>
				Year of birth:
				<?php
					echo '<select name="age">';
					
					define('START',1920);
					define('END',2020);
					$years = range(START, END);
					$middleYear = floor((START + END)/2);
				
					foreach ($years as $value) {						
						if($middleYear == $value){
							echo "<option value=\"$value\" selected>$value</option>";
						}
						else {
							echo "<option value=\"$value\">$value</option>\n";
						}
						
					}
					
					
					echo '</select>';
				?>
			</label>
		</p>

		<p>
			<label>
				Comments: 
				<textarea name="comments" rows="3" cols="40"><?php echo $comments; ?></textarea>
			</label>
		</p>
	</fieldset>
	
	<p align="center">
		<input type="submit" name="submit" value="Submit My Information">
	</p>
</form>

<?php
	include('includes/footer.php');
?>