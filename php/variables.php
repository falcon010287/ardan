<?php
	$variables = parse_ini_file("config/variables.ini");
	
	if (isset($_GET['page'])) $variables['page_current'] = '/?page='.$_GET['page'];
	else $variables['page_current'] = '/';