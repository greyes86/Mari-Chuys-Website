<?php //This is the login page for registered users
//require 'includes/header.php';  moved down in the code to prevent output before session handling
if (isset($_POST['send'])) {
	$missing = array();
	$errors = array(); //contains additional user feedback regarding login
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	if (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL))  //Either empty or invalid email will be considered missing
		$missing[] = 'email';
		
	// Check for a password:
	if (empty($_POST['password']))
		$missing[]='password';
	else $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
	while (!$missing && !$errors){ 
		require_once ('../mysqli_config2.php'); // Connect to the db. Adjust your path as needed
		// Make the query:
		
//NEED TO DO QUERY WITH NEW DATABASE
		
		//$sql = "SELECT firstName, lastName, emailAddr, pw FROM JJ_reg_users WHERE emailAddr = '$email'";
		$result = mysqli_query($dbc, $sql);
		echo mysqli_num_rows($result);
		if(mysqli_num_rows($result)==1){ //email found
			$row = 	mysqli_fetch_array($result, MYSQLI_ASSOC);
			if ($password == password_verify($password, $row['pw'])) { //passwords match
				$firstName = $row['firstName'];
				$lastName = $row['lastName'];
				session_start();
				$_SESSION['firstName']=$firstName;
				$_SESSION['lastName']=$lastName;
				$_SESSION['email']=$email;
				$url = 'http://'. $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
				$url = rtrim($url, '/\\');
				$page = 'index.php';		//if logged in redirect to index.php(HOME PAGE)
				$url .= '/' . $page;
				header("Location: $url");
				exit();
			}
			else {
				$errors[]='password';
			}
		}
		else //email not found
			$errors[] = 'email';
	}
}
require 'includes/header.php';
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
						Please try another email address or use the link to the left to Register</span>
                    <?php } ?>
				</label>
                <input name="email" id="email" type="text"
				<?php if (isset($email) && !$errors['email']) {
                    echo 'value="' . htmlspecialchars($email) . '"';
                } ?>>
            </p>
			<p>
				<?php if ($errors && in_array('password', $errors)) { ?>
                        <span class="warning">The password supplied does not match the password for this email address. Please try again.</span>
                    <?php } ?>
                <label for="pw">Password: 
				
				<?php if ($missing && in_array('password', $missing)) { ?>
                        <span class="warning">Please enter a password</span>
                    <?php } ?> </label>
                <input name="password" id="pw" type="password">
            </p>
			
            <p>
                <input name="send" type="submit" value="Login">
            </p>
		</fieldset>
        </form>
	</main>
<?php include './includes/footer.php'; ?>
