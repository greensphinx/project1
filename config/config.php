<?php

	Config::set('site_name', 'EShop');

	Config::set('routes', [
		'default' => '',
		'admin' => 'admin_',
        'login' => 'pages/login'
	]);

	Config::set('default_route', 'default');
	Config::set('default_controller', 'pages');
	Config::set('default_action', 'index');

	Config::set('db.host', 'mysql.hostinger.com.ua');
	Config::set('db.user', 'u141287854_green');
	Config::set('db.password', '123456789');
	Config::set('db.db_name', 'u141287854_shopp');

    Config::set('salt' , 'eriu35356y23yiuio3445');
