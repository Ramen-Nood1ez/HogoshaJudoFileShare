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
	<h1>Login</h1>
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
		}
	?>
</body>
</html>