<?php
	// выполнение команды
	if (isset($_GET['cmd'])) {
		if (CommandIsRights($_GET['cmd'], $variables['user_pageRights'])) {
			$file_php = '../php/exec_cmd/' . $_GET['cmd'] . '.php';

			if (file_exists($file_php)) include($file_php);
		} else
			$variables['templates_content'] = $variables['errors_commands_rights'];
	}