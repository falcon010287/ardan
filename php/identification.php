<?php
	$variables['user_auth'] = 'none';
	$variables['user_name'] = '';
	$variables['user_pageRights'] = '0';
	
	if ($_COOKIE['id'] != "" and $_COOKIE['hash'] != "") {
		$query = mysqli_query(DB::connect(),"SELECT * FROM `users` WHERE `id` = '".intval($_COOKIE['id'])."' LIMIT 1");
		$userdata = mysqli_fetch_assoc($query);
		
		if ($userdata['hash'] == $_COOKIE['hash'] AND $userdata['id'] == $_COOKIE['id']) {
			$variables['user_auth'] = 'auth';
			$variables['user_name'] = $userdata['name'];
			$variables['user_pageRights'] = '1';
		}
	}