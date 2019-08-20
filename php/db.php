<?php
	class DB {
		private static $link = null;
		public static function connect()
		{
			if (self::$link === null) {
				self::$link = new mysqli("localhost", "root", "", "ardan");
				self::$link->set_charset('UTF8');
				if (self::$link->connect_errno) {
					echo "Не удалось подключиться к базе: " . self::$link->connect_error;
					
					echo '<br><hr><a href="http://ardan.loc/?precmd=migration&code=">ВЫПОЛНИТЬ МИГРАЦИЮ.<br>ВНИМАНИЕ, ВСЕ ИМЕЮЩИЕСЯ ДАННЫЕ В БД БУДУТ УДАЛЕНЫ!!!</a>';
					exit;
				}
			}

			return self::$link;
		}
	}

	function mysqli_result($res, $row, $field=0) {
		$res->data_seek($row);
		$datarow = $res->fetch_array();
		return $datarow[$field];
	}