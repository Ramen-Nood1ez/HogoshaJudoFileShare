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
		$directory = scandir("./tournament/Tohkon 2022/");
		foreach	($directory as $item) {
			echo "$item <br>";
		}
	?>

	<br>

	<video controls>
		<source src="./tournament/Tohkon 2022/Aimana Daniyar vs. Peyton Lang.MOV" type="video/mov">
	</video>
</body>
</html>
