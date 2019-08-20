<?php
	if (isset($_POST['submit_registration'])) {
		global $variables;
		
		if ($_POST['login'] == '') messageAdd("Необходимо указать логин.");
		
		if ($_POST['name'] == '') messageAdd("Необходимо указать имя.");
		
		$query = mysqli_query(DB::connect(),"SELECT COUNT(id) FROM users WHERE login='".mysqli_real_escape_string(DB::connect(), $_POST['login'])."'");
		if(mysqli_result($query, 0) > 0) messageAdd("На указанный логин уже зарегистрирован пользователь.");
		
		if (strlen($_POST['password']) < 4 or strlen($_POST['password']) > 32) messageAdd("Пароль должен быть не меньше 4-х символов и не больше 32.");
		
		if ($_POST['password'] != $_POST['password_confirm']) messageAdd("Пароль и подтверждение не совпадают.");
		
		if($variables['messages'] == "") {
			$password = md5(md5(mysqli_real_escape_string(DB::connect(),$_POST['password'])));
			
			mysqli_query(DB::connect(),"INSERT INTO `users` SET 
			`login`='".mysqli_real_escape_string(DB::connect(), trim($_POST['login']))."', 
			`name`='".mysqli_real_escape_string(DB::connect(), trim($_POST['name']))."', 
			`password`='$password', 
			`hash`='', 
			`update_at`=NOW()");
			
			header("Location: /");
		}
		
		//echo '***'.$variables['messages'].'***';
	}