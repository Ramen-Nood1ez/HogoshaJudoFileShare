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
		echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Hogosha Judo File Share</title><link rel="stylesheet" href="style.css"></head><body>';
	}

	function finish() {
		echo "\n</body>\n</html>";
	}

	function changesource($newsource) {
		global $path;
		init();

		echo $newsource . "<br>";
		$selected = $path . $newsource;

		echo "<video width='320' height='240' controls>\n";
		echo "\t <source src=" . $selected . " type='video/mp4'>\n";
		echo "</video> <br>";

		finish();
	}

	function createButtons($directory) {
		echo "<form method='post'>\n";

		for	($x = 2; $x < count($directory); $x++) {
			$file_name = $directory[$x];
			echo "\t<input type='submit' name='btn$x' value='$file_name'> <br>\n";
		}
		echo "</form>";

		echo "<a href='/'>Back</a>";
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
		createButtons($directory);
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