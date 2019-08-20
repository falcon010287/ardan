<?php
	$variables['import_table'] = '';
	
	$variables['project_new_form'] = '
<form enctype="multipart/form-data" method="post" style="text-align: center;">
	<input type="hidden" name="MAX_FILE_SIZE" value="10485760">
	<input name="userfile" type="file" required="">
	
	<input type="submit" name="submitPublitionAdd" value="Загрузить TRP" class="button">
</form>';
	
	if(isset($_POST['submitPublitionAdd'])) {
		$errors = '';
		
		$blacklist = array(".php", ".phtml", ".php3", ".php4", ".html", ".htm");
		$path = $_SERVER['DOCUMENT_ROOT']."/uploads/";
		$file = 'tprt_'.strval(time()).'.txt';
		
		if ($errors == "" and $_FILES['userfile']['name'] == "")
			$errors = $errors."Необходимо указать файл.\\n";
		
		if ($errors == "")
			foreach ($blacklist as $item)
				if(preg_match("/$item\$/i", $_FILES['userfile']['name'])) 
					$errors = $errors."Недопустимый формат файла.\\n";
			
		if ($errors == "")
			if ($_FILES['userfile']['size'] > 10485760)
				$errors = $errors."Размер файла не должен превышать 10 мегабайт.\\n";
		
		if ($errors == "") {
			if (!file_exists($path)) {
				$errors = $errors."Директория не существует.\\n";
				if (!mkdir($path, 0777, true)) {
					$errors = $errors."Не удалось создать директории...\\n";
				}
			}
			
			if (!move_uploaded_file($_FILES['userfile']['tmp_name'], $path.$file)) {
				echo "Возможная атака с помощью файловой загрузки!\n";
			}
			
			if ($errors == "") {
				$text = file_get_contents($path.$file);
				
				mysqli_query(DB::connect(),"DELETE FROM `projects_data` WHERE `project_id`='-1'");
				$caption = parse_ini_file("contents/ardan/settings.ini");
				
				$table = '';
				while (strlen($text) > 0) {
					$pos = strripos($text, '|');
					if ($pos) {
						$item = trim(substr($text, $pos + 1, strlen($text) - $pos - 1));
						$item1 = trim(substr($item, 0, strpos($item, ':')));
						$item = substr($item, strpos($item, ':') + 1, strlen($item) - strpos($item, ':') - 1); 
						$item2 = trim(substr($item, 0, strpos($item, ':')));
						$item3 = trim(substr($item, strpos($item, ':') + 1, strlen($item) - strpos($item, ':') - 1)); 
						
						if (isset($caption[$item2])) {
							$table = "<tr><td>".$caption[$item2]."</td><td>$item3</td></tr>".$table;
						
							mysqli_query(DB::connect(),"INSERT INTO `projects_data` SET 
							`project_id`='-1', 
							`prt_index`='$item2', 
							`prt_caption`='".$caption[$item2]."', 
							`prt_value`='$item3'");
						}
						
						$text = substr($text, 0, $pos);
					} else $text = '';
				}
				
				$variables['import_table'] = "
				<table border='1' align='center' cellpadding='3' cellspacing='0'>
					<tr>
						<td>Параметр</td>
						<td>Значение</td>
					</tr>
					$table
				</table>";
			}
		}
	}
?>