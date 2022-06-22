<?php
	$dom = new DOMDocument();
	$path = "/tournament/Tohkon_2022/";

	function init() {
		global $dom;
		$dom = new DOMDocument();
		$dom->loadHTML('<!DOCTYPE html>\n<html lang="en">\n<head>\n\t<meta charset="UTF-8">\n\t<meta http-equiv="X-UA-Compatible" content="IE=edge">\n\t<meta name="viewport" content="width=device-width, initial-scale=1.0">\n\t<title>Document</title>\n\t<link rel="stylesheet" href="style.css">\n</head>\n<body>\n');
		echo $dom;
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
	}

	init();

	$directory = scandir("./tournament/Tohkon_2022/");

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