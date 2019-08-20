<?php
	if ($variables['user_auth'] == 'none') {
		$variables['userbar_links'] = '
		<div id="user">
			<a href="/?page=authorization">[langAuthorization]</a>
			<a href="/?page=registration">[langRegistration]</a>
		</div>';
	} else {
		$variables['userbar_links'] = '
		<div id="menu">
			<ul>
				<li><a href="/?page=index">[langHome]</a></li>
				<li><a href="/?page=catalog">[langAllCatalog]</a></li>	
				<li><a href="/?page=standarts">[langElectricalStandards]</a></li>
				<li><a href="/?page=price">[langMaterialPriceList]</a></li>
				<li><a href="/?page=db_materials">[langMaterialDataBases]</a></li>
				<li><a href="/?page=settings">[langSettings]</a></li>
				<li><a href="/?page=parameters">[langParameters]</a></li>
			</ul>
		</div>
		<div id="lang">
			<a href="/?localization=eng&back=[page_current]">Eng</a>|
			<a href="/?localization=rus&back=[page_current]">Рус</a>
		</div>
		<div id="user">
			<a href="/?page=cabinet">[user_name]</a>
			<a href="/?cmd=logout">[langLogout]</a>
		</div>';
	}