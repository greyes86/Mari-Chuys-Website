<?php //This is the login page for registered users
//require 'includes/header.php';  moved down in the code to prevent output before session handling
$missing = array(); //moved missing and errors outside to start with new empty array every time
$errors = array();
if (isset($_POST['send'])) {
	 //contains additional user feedback regarding login
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){  //Either empty or invalid email will be considered missing
		$missing[] = 'email';
		echo "bad email";
	}
	
	// Check for a password:
	if (empty($_POST['pwd']))
	{
		$missing[]='pwd';
	}
	else
	{
		$password = filter_var(trim($_POST['pwd']), FILTER_SANITIZE_STRING);//filters password
	}
	
	while (!$missing && !$errors)
	{ 
		require_once ('../mysqli_config2.php'); // Connect to the db. Adjust your path as needed
		// Make the query:		
		
		$sql = "SELECT CustomerID, EmailAddress, FirstName, LastName, Password, Folder FROM Customer WHERE Customer.EmailAddress = '$email' ";
		//send the query to database
		$result = mysqli_query($dbc, $sql);
		//check if the results 
		if(mysqli_num_rows($result)==1)
		{ //email found
			$row = 	mysqli_fetch_array($result, MYSQLI_ASSOC);
			//passwords match
			if ($password == password_verify($password, $row['Password'])) 
			{
				$customerID = $row['CustomerID'];
				$email = $row['EmailAddress'];
				$firstName = $row['FirstName'];
				$lastName = $row['LastName'];
				$folder = $row['Folder'];
				session_start();
				$_SESSION['CustomerID']=$customerID;
				$_SESSION['FirstName']=$firstName;
				$_SESSION['LastName']=$lastName;
				$_SESSION['EmailAddress']=$email;
				$_SESSION['Folder']=$folder;
				$url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
				$url = rtrim($url, '/\\');
				$page = 'index.php';		//if logged in redirect to index.php(HOME PAGE)
				$url .= '/' . $page;
				header("Location: $url");
				exit();
			}
			else 
			{
				$errors[]='pwd';
			}
		}
		else //email not found
			$errors[] = 'email';
	}
}
include 'includes/header.php';
?>
	<main>
		<form method="post" action="login.php">
			<fieldset>
				<legend>Registered Users Login</legend>
				<?php if ($missing || $errors) { ?>
				<p class="warning">Please fix the item(s) indicated.</p>
				<?php } ?>
				<p>
					<label for="email">Please enter your email address:
					<?php if ($missing && in_array('email', $missing)) { ?>
					<span class="warning">An email address is required</span>
                    <?php } ?>
				<?php if ($errors && in_array('email', $errors)) { ?>
					<span class="warning"><br>The email address you provided is not associated with an account<br>
					Please try another email address or register to obtain an account with us.</span>
                    <?php } ?>
				</label>
					<input name="email" id="email" type="text"
				<?php if (isset($email) && !$errors['email']) {
                    echo 'value="' . htmlspecialchars($email) . '"';
                } ?>>
				<p>
				<?php if ($errors && in_array('pwd', $errors)) { ?>
					<span class="warning">The password supplied does not match the password for this email address. Please try again. <br></span>
                    <?php } ?>
					<label for="pw">Password:
						<?php if ($missing && in_array('pwd', $missing)) { ?>
                        <span class="warning">Please enter a password</span>
						<?php } ?> 
					</label>
					<input name="pwd" id="pw" type="password">
				</p>
				<p>
					<input type="submit" name="send" value="Login">
				</p>
			</fieldset>
		</form>
	</main>
<?php include './includes/footer.php'; ?>
