<?php
	$dom = new DOMDocument();
	$dom->loadHTMLFile("/default.html");

	function changesource($newsource, $dom) {
		$dom = new DOMDocument();
		$dom->loadHTMLFile("default.html");

		echo $newsource;

		echo "<video width='320' height='240' controls>\n";
		echo "\t <source src='$newsource' type='video/mp4'>\n";
		echo "</video> <br>";
	}

	function createButtons($directory) {
		echo "<form method='post'>\n";

		for	($x = 0; $x < count($directory); $x++) {
			$file_name = $directory[$x];
			echo "\t<input type='submit' name='btn$x' value='$file_name'> <br>\n";
		}
		echo "</form>";
	}

	$directory = scandir("./tournament/Tohkon_2022/");

	for ($x = 0; $x < count($directory); $x++) {
		$file_name = $directory[$x];
		if (isset($_POST["btn$x"])) {
			changesource($file_name, $dom);
			break;
		}
	}

	createButtons($directory);

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