<?php
	// Выполнение предкоманды
	if (isset($_GET['precmd'])) {
		echo "Pre-operations<br>";
		
		include("../php/variables.php");
		include("../php/functions.php");
		
		if ($_GET['code'] == '123456') {
			$file_php = '../php/exec_cmd/' . $_GET['precmd'] . '.php';

			if (file_exists($file_php)) include($file_php);
		} else
			echo "Неправильный код.<br>";
		
		exit;
	}
	