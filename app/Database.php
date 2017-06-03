<?php

namespace App;

class Database extends \PDO
{
	private static $_config;
	private static $_instance;

	public static function configure($config)
	{
		self::$_config = $config;
	}

	public static function instance()
	{
		if (self::$_instance == Null)
			self::$_instance = new Database(self::$_config);
		return self::$_instance;
	}

	public function __construct($config)
	{
		$c = self::$_config;
		$dns = "mysql:host={$c['host']};dbname={$c['database']}";

		parent::__construct($dns, $c['username'], $c['password']);
	}
}