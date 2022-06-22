<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: login.php");
		exit;
	}
?>

<?php
	$dom = new DOMDocument();

	$selected_tournament = "";

	if (isset($_GET["tournament"])) {
		$selected_tournament = htmlspecialchars($_GET["tournament"]) . "/";
	}

	$path = "/tournament/" . $selected_tournament; // Tohkon_2022/";

	function init() {
		global $dom;
		$dom = new DOMDocument();
		echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon"><title>Hogosha Judo File Share</title><link rel="stylesheet" href="style.css"></head><body>';
	}

	function finish() {
		echo "<a href='logout.php'>Logout</a>";
		echo "\n</body>\n</html>";
	}

	function changesource($newsource) {
		global $path, $selected_tournament;
		init();

		echo $newsource . "<br>";
		$selected = $path . $newsource;

		echo "<video width='320' height='240' controls>\n";
		echo "\t <source src=" . $selected . " type='video/mp4'>\n";
		echo "</video> <br>";
		echo "<a href='/?$selected_tournament'>Back</a>";

		finish();
	}

	function createButtons($directory, $tournaments = false) {
		if (!$tournaments) {

			echo "<form method='post'>\n";

			for	($x = 2; $x < count($directory); $x++) {
				$file_name = $directory[$x];
				echo "\t<input type='submit' name='btn$x' value='$file_name'> <br>\n";
			}
			echo "</form>";

			echo "<a href='/'>Back</a>";
		} else {
			for	($x = 2; $x < count($directory); $x++) {
				$tournament_name = $directory[$x];
				echo "<a href='/?tournament=$tournament_name'>$tournament_name</a> <br>\n";
			}
		}
	}

	init();

	$directory = scandir("./tournament/" . $selected_tournament); // Tohkon_2022/");

	$found_selected = false;

	for ($x = 2; $x < count($directory); $x++) {
		$file_name = $directory[$x];
		if (isset($_POST["btn$x"])) {
			changesource($file_name, $dom);
			$found_selected = true;
			break;
		}
	}

	if (!$found_selected) {
		createButtons($directory, ($selected_tournament === "") ? true : false);
		finish();
	}

	/*
	foreach	($directory as $item) {
		echo "$item <br>";
	}

	$selected = "/tournament/Tohkon_2022/Aimana_Daniyar_vs_Peyton_Lang.MOV";

	echo "<video width='320' height='240' controls>\n";
	echo "\t <source src=$selected type='video/mp4'>\n";
	echo "</video> <br>";
	*/
?>