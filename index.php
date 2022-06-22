<?php
	$dom = new DOMDocument();
	$dom->loadHTMLFile("/default.html");

	function changesource($newsource, $dom) {
		$dom = new DOMDocument();
		$dom->loadHTMLFile("/default.html");

		echo "<video width='320' height='240' controls>\n";
		echo "\t <source src=$newsource type='video/mp4'>\n";
		echo "</video> <br>";
	}

	$directory = scandir("./tournament/Tohkon_2022/");
	foreach	($directory as $item) {
		echo "$item <br>";
	}

	$selected = "/tournament/Tohkon_2022/Aimana_Daniyar_vs_Peyton_Lang.MOV";

	echo "<video width='320' height='240' controls>\n";
	echo "\t <source src=$selected type='video/mp4'>\n";
	echo "</video> <br>";
?>