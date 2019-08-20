<?php
	//Вывести массив на экран
	function ArrayShow($array, $st_tab, $st_symbol) {
		$result = "[";
		$st_tab .= $st_symbol;
		foreach($array as $key => $value) {
			$result .= "<br>";
			if (is_array($value))
				$result .= "$st_tab'$key' => ".ArrayShow($value, $st_tab, $st_symbol)."<br>";
			else
				$result .= "$st_tab'$key' => '$value', "; 
		}
		$result .= ']<br>';
		
		return $result;
	}
	
	// Записать сообщение в поток ошибок
	function StreemErrorMessageAdd($message) {
		$variables['errors'] .= "$message<br>";
	}
	
	// Выдать поток сообщений ошибок на экран
	function StreemErrorsMessageShow() {
		echo '<i>'.$variables['errors'].'</i>';
	}
	
	// Записать переменную в массив variables
	function VariablesSetValue($key, $value) {
		$variables[$key] = $value;
	}
	
	// Выдать обработанный шаблон
	function GetTpl($file) {
		global $variables;
		
		$content = file_get_contents($file);
		
		$it = 0;
		while ($it < 5 and preg_match("/\[[a-z0-1_]+\]/i", $content)) {
			foreach($variables as $key => $value)
				$content = str_replace("[".$key."]", $value, $content);
			
			$it++;
		}
		
		if ($it == 5) StreemErrorMessageAdd('function.php -> GetTpl -> while -> [$it = 5]');
		
		return $content;
	}
	
	// Обработать и показать шаблон
	function ProcessTpl($tpl) {
		global $variables;
		
		if (file_exists($tpl.'.php')) include($tpl.'.php');
		echo GetTpl($tpl.'.tpl');
	}
	
	//добавить сообщение в поток вывода сообщений на экран
	function messageAdd($mes) {
		global $variables;
		$variables['messages'] .= $mes."\\n";
	}
	
	//Функция для генерации случайной строки
	function generateCode($length=6) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;
		while (strlen($code) < $length) $code .= $chars[mt_rand(0,$clen)];
		
		return $code;
	}
	
	//проверка прав доступа к странице
	function PageIsRights($page, $rights) {
		$result = false;
		$ini = parse_ini_file("contents/rights.ini");
		
		if (isset($ini[$page]))
			for ($n = 0; $n < strlen($ini[$page]); $n++)
				if (($ini[$page][$n] == '-') OR ($ini[$page][$n] == $rights[$n])) $result = true;
		
		return $result;
	}
	
	//проверка прав доступа к команде
	function CommandIsRights($cmd, $rights) {
		$result = false;
		$ini = parse_ini_file("../php/exec_cmd/rights.ini");
		
		if (isset($ini[$cmd]))
			for ($n = 0; $n < strlen($ini[$cmd]); $n++)
				if (($ini[$cmd][$n] == '-') OR ($ini[$cmd][$n] == $rights[$n])) $result = true;
		
		return $result;
	}