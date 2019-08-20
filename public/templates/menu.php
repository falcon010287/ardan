<?php
	if ($variables['user_auth'] == 'auth')
		$variables['menubar'] = '
<div id="menu">
	<ul>
		<li><a href="/?page=project_new">[langProjectNew]</a></li>
		<li><a href="/?page=test_new">[langRoutineTestNew]</a></li>
		<li><a href="/?page=order_new">[langOrderNew]</a></li>
		<li><a href="/?page=projects">[langProjects]</a></li>
		<li><a href="/?page=orders">[langOrders]</a></li>
		<li><a href="/?page=tests">[langRoutineTests]</a></li>
	</ul>
</div>';
	else
		$variables['menubar'] = '';