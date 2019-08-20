<?php
	if (isset($_GET['page'])) {
		if (PageIsRights($_GET['page'], $variables['user_pageRights'])) {
			if (file_exists('contents/'.$_GET['page'].'.php')) include('contents/'.$_GET['page'].'.php');
			if (file_exists('contents/'.$_GET['page'].'.tpl')) 
				$variables['templates_content'] = GetTpl('contents/'.$_GET['page'].'.tpl'); 
			else
				$variables['templates_content'] = GetTpl('contents/index.tpl');
		} else
			$variables['templates_content'] = $variables['errors_pages_rights'];
	} else
		$variables['templates_content'] = GetTpl('contents/index.tpl');