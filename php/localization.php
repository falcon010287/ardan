<?php
	$variables['localization'] = 'eng';
	
	if (isset($_GET['localization'])) {
		SetCookie("localization", $_GET['localization'], time() + 60 * 60 * 24 * 7);
		header('Location: '.$variables['page_current']);
	}
	
	if (isset($_COOKIE['localization'])) $variables['localization'] = $_COOKIE['localization'];
	
	$variables = array_merge ($variables, parse_ini_file("localization/".$variables['localization'].".ini"));
	
	
?>