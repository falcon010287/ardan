<?php
	// Текущая структура БД
	$migration = [
		'db_name' => 'ardan', 
		'db_user' => 'ardan_admin', 
		'db_user_password' => 'password',
		'db_tables' => [
			'users' => [
				'fields' => [
					1 => ['name' => 'id', 'type' => 'int', 'size' => 11, 'default' => '', 'attributes' => 'ai'],
					2 => ['name' => 'login', 'type' => 'varchar', 'size' => 32, 'default' => '', 'attributes' => ''],
					3 => ['name' => 'password', 'type' => 'varchar', 'size' => 32, 'default' => '', 'attributes' => ''],
					4 => ['name' => 'hash', 'type' => 'varchar', 'size' => 256, 'default' => '', 'attributes' => ''],
					5 => ['name' => 'state', 'type' => 'varchar', 'size' => 32, 'default' => '', 'attributes' => ''],
					6 => ['name' => 'name', 'type' => 'varchar', 'size' => 128, 'default' => '', 'attributes' => ''],
					7 => ['name' => 'create_at', 'type' => 'timestamp', 'size' => 32, 'default' => 'CURRENT_TIMESTAMP', 'attributes' => ''],
					8 => ['name' => 'update_at', 'type' => 'timestamp', 'size' => 32, 'default' => '', 'attributes' => '']
				]
			],
			'projects' => [
				'fields' => [
					1 => ['name' => 'id', 'type' => 'int', 'size' => 11, 'default' => '', 'attributes' => 'ai'],
					2 => ['name' => 'file_tprt', 'type' => 'varchar', 'size' => 256, 'default' => '', 'attributes' => '']
				]
			],
			'projects_data' => [
				'fields' => [
					1 => ['name' => 'project_id', 'type' => 'int', 'size' => 11, 'default' => '', 'attributes' => 'ai'],
					2 => ['name' => 'tprt_index', 'type' => 'varchar', 'size' => 16, 'default' => '', 'attributes' => ''],
					3 => ['name' => 'tprt_caption', 'type' => 'varchar', 'size' => 256, 'default' => '', 'attributes' => ''],
					4 => ['name' => 'tprt_value', 'type' => 'varchar', 'size' => 256, 'default' => '', 'attributes' => '']
				]
			]
		]
	];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db_name = "ardan";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Ошибка подключения: " . $conn->connect_error);
		exit;
	} 
	
	$conn->query("DROP DATABASE IF EXISTS $db_name");
	
	// Create database
	$sql = "CREATE DATABASE $db_name";
	if ($conn->query($sql) === TRUE) {
		echo "База данных создана успешно.";
		include("../php/db.php");
		
		// Проверка существования базы данных
		$link = mysqli_connect($servername, $username, $password, $db_name);

		if (!$link) {
			echo "Ошибка: Невозможно установить соединение с MySQL.".'<br>';
			echo "Код ошибки errno: ".mysqli_connect_errno().'<br>';
			echo "Текст ошибки error: ".mysqli_connect_error().'<br>';
			exit;
		}

		echo "Соединение с MySQL установлено!".'<br>';
		echo "Информация о сервере: ".mysqli_get_host_info($link).'<br><br>';
		
		$db_name = 'users';
		$query = mysqli_query(DB::connect(), "SHOW TABLES LIKE '$db_name'");
		if (mysqli_fetch_assoc($query)) echo "Таблица '$db_name' существует<br>";
		else {
			mysqli_query(DB::connect(), "CREATE TABLE `$db_name` (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				login VARCHAR(32) NOT NULL, 
				password VARCHAR(255) NOT NULL, 
				hash VARCHAR(255) NOT NULL, 
				state VARCHAR(32) DEFAULT 'new', 
				name VARCHAR(128) NOT NULL, 
				create_at TIMESTAMP DEFAULT NOW(), 
				update_at TIMESTAMP NOT NULL)");
				
				$query = mysqli_query(DB::connect(), "SHOW TABLES LIKE '$db_name'");
				if (mysqli_fetch_assoc($query)) echo "Таблица '$db_name' создана<br>";
		}
		
		$db_name = 'projects';
		$query = mysqli_query(DB::connect(), "SHOW TABLES LIKE '$db_name'");
		if (mysqli_fetch_assoc($query)) echo "Таблица '$db_name' существует<br>";
		else {
			mysqli_query(DB::connect(), "CREATE TABLE `$db_name` (
				id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				file_tprt VARCHAR(255) NOT NULL)");
				
				$query = mysqli_query(DB::connect(), "SHOW TABLES LIKE '$db_name'");
				if (mysqli_fetch_assoc($query)) echo "Таблица '$db_name' создана<br>";
		}
		
		$db_name = 'projects_data';
		$query = mysqli_query(DB::connect(), "SHOW TABLES LIKE '$db_name'");
		if (mysqli_fetch_assoc($query)) echo "Таблица '$db_name' существует<br>";
		else {
			mysqli_query(DB::connect(), "CREATE TABLE `$db_name` (
				project_id INT(11) NOT NULL, 
				prt_index VARCHAR(16) NOT NULL, 
				prt_caption VARCHAR(255) NOT NULL, 
				prt_value VARCHAR(255) NOT NULL)");
				
				$query = mysqli_query(DB::connect(), "SHOW TABLES LIKE '$db_name'");
				if (mysqli_fetch_assoc($query)) echo "Таблица '$db_name' создана<br>";
		}
		
		
		mysqli_close($link);

		// Проверка существования таблиц
		
		// Проверка структуры таблиц
		
		// Проверка наличия данных в таблицах
		
		// Выгрузка данных в файл
		
		// Создание базы данных, если она отсутствует
		
		// Создание таблиц, если они отсутствуют, либо несоответсвует структура
		
		// Загрузка данных из фалйла
		
		// Вывод отчёта о совершённых операциях
		//echo 'Current DB struct<br>';
		//echo '$migration = '.ArrayShow($migration, "", "&emsp;");
		
	} else {
		echo "Ошибка создания базы данных: " . $conn->error;
	}
	
	$conn->close();
	
	// Вывод ссылки для возврата на главную страницу сайта
	echo '<br><br><b>Migration is over.</b><br><br><a href="/">Home</a>';
	exit;