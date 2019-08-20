<?php
	if (isset($_POST['submit_authorization'])) {
		# Вытаскиваем из БД запись, у которой email равняеться введенному
		$query = mysqli_query(DB::connect(), "SELECT id, password FROM users WHERE login='".mysqli_real_escape_string(DB::connect(), trim($_POST['login']))."' LIMIT 1");
		$data = mysqli_fetch_assoc($query);
		
		# Сравниваем пароли
		if ($data['password'] === md5(md5($_POST['password']))) {

			# Генерируем случайное число и шифруем его
			$hash = md5(generateCode(10));
			
			# Записываем в БД новый хеш авторизации и IP
			mysqli_query(DB::connect(), "UPDATE users SET hash='".$hash."' WHERE id='".$data['id']."'");

			SetCookie("id", $data['id'], time() + 60 * 60 * 24 * 7);
			SetCookie("hash", $hash, time() + 60 * 60 * 24 * 7);

			header("Location: /?page=catalog");
			exit();
		} else
			echo("Вы ввели неправильный адрес электронной почты или пароль.");
	}