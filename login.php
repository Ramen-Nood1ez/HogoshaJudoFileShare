<?php
	// Intialize the session
	session_start();

	// Check if user is already logged in, 
	// if yes send them to the welcome page
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: main.php");
		exit;
	}
	
	// Include config file
	require_once "config.php";

	// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = $login_err = "";

	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		// Check if username is empty
		if (empty(trim($_POST["username"]))) {
			$username_err = trim($_POST["username"]);
		} else {
			$username = trim($_POST["username"]);
		}

		// Check if password is empty
		if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter your password.";
		} else {
			$password = trim($_POST["password"]);
		}

		// Validate credentials
		if (empty($username_err) && empty($password_err)) {
			// Prepare a select statement
			$sql = "SELECT id, username, password FROM users WHERE username = ?";

			if ($stmt = mysqli_prepare($link, $sql)) {
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);

				// Set parameters
				$param_username = $username;

				// Attempt to execute prepared statement
				if (mysqli_stmt_execute($stmt)) {
					// Store result
					mysqli_stmt_store_result($stmt);

					// Check if username exists, if yes then verify password
					if (mysqli_stmt_num_rows($stmt) == 1) {
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
						
						if (mysqli_stmt_fetch($stmt)) {
							if (password_verify($password, $hashed_password)) {
								// Password is correct, so start a new session
								session_start();

								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $username;

								// Redirect user to main page
								header("location: main.php");
							} else {
								// Password is not valid, display a generic error message
								$login_err = "Invalid username or password.";
							}
						}
					} else {
						// Username doesn't exist, display a generic error message
						$login_err = "Invalid username or password.";
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}

		// Close connection
		mysqli_close($link);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hogosha Judo File Share</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h2>Login</h2>
	<p>Please fill in your credentials to login.</p>

	<?php 
		if (!empty($login_err)) {
			echo "<div class='error'> " . $login_err . "</div>";
		}
	?>

	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<div>
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
			<span><?php echo $username_err; ?></span>
		</div>
		<div>
			<label>Password</label>
			<input type="password" name="password">
			<span><?php echo $password_err; ?></span>
		</div>
		<div>
			<input type="submit" value="Login">
		</div>
	</form>

</body>
</html>