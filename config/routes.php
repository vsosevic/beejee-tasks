<?php
return array(
		'tasks/done/([0-9]+)' => 'tasks/done/$1', //actionDone in TasksController
		'tasks/page/([0-9]+)' => 'tasks/page/$1', //actionPage in TasksController
		'tasks/add' => 'tasks/add', // actionAdd in TasksController
		'login' => 'login/login', // actionLogin in LoginController
		'logout' => 'login/logout', // actionLogout in LoginController
		'tasks' => 'tasks/list', //actionList in TasksController
		'/' => 'tasks/list', //actionList in TasksController
	);


