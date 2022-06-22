<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		ini_set("include_path", '/home/hogoshaj/php:' . ini_get("include_path") );
		echo "test!<br>";
		$directory = scandir("./tournament/Tohkon_2022/");
		foreach	($directory as $item) {
			echo "$item <br>";
		}

		echo "<video width='320' height='240' controls>\n";
		echo "\t <source"
	?>

	<br>

	<video controls>
		<source 
		src="/tournament/Tohkon_2022/Aimana_Daniyar_vs_Peyton_Lang.MOV" 
		type="video/mp4">
	</video>
</body>
</html>
