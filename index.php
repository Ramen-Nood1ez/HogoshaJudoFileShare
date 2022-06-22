<?php
	$dom = new DOMDocument();
	init();
	$path = "/tournament/Tohkon_2022/";

	function changesource($newsource) {
		global $dom, $path;
		$dom = new DOMDocument();
		$dom->loadHTMLFile("./default.html");

		echo $newsource . "<br>";
		$selected = $path . $newsource;

		echo "<video width='320' height='240' controls>\n";
		echo "\t <source src=" . $selected . " type='video/mp4'>\n";
		echo "</video> <br>";
	}

	function createButtons($directory) {
		echo "<form method='post'>\n";

		for	($x = 2; $x < count($directory); $x++) {
			$file_name = $directory[$x];
			echo "\t<input type='submit' name='btn$x' value='$file_name'> <br>\n";
		}
		echo "</form>";
	}

	function init() {
		global $dom;
		$dom = new DOMDocument();
		$dom->loadHTMLFile("./default.html");
	}

	function finish() {
		echo "\n</body>\n</html>";
	}

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
	}

	finish();

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