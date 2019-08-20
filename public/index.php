<?php
	include("../php/preoperations.php");
	include("../php/db.php");
	include("../php/variables.php");
	include("../php/localization.php");
	include("../php/functions.php");
	include("../php/identification.php");
	include("../php/content.php");
	include("../php/operations.php");
?>

<html>
<head>
	<title>ARDAN</title>
	<link href="css/main.css" type="text/css" rel="stylesheet">
</head>
<body>
	<div id="wrapper">
		<?php 
			ProcessTpl('templates/userbar');
			ProcessTpl('templates/menu');
			ProcessTpl('templates/content');
		?>
	</div>
</body>
</html>