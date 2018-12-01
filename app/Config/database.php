<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'db',
		'login' => 'app',
		'password' => 'app',
		'database' => 'app',
		'encoding' => 'utf8'
	);

    public $test = [
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'db',
        'login' => 'app',
        'password' => 'app',
        'database' => 'test_app',
        'encoding' => 'utf8'
    ];
}
