<?php

namespace App;

class Template
{
	private static $_config;
	private $_html;

	public static function configure($config)
	{
		self::$_config = $config;
	}

	public function __construct()
	{
	}

	public function loadComponent(string $name, array $variables)
	{
		$path = joinPath(path(self::$_config['component_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function loadEmail(string $name, array $variables)
	{
		$path = joinPath(path(self::$_config['email_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function loadFragment(string $name, array $variables)
	{
		$path = joinPath(path(self::$_config['fragment_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function loadView(string $name, array $variables)
	{
		$path = joinPath(path(self::$_config['view_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function load(string $path, array $variables)
	{
		$variables['variables'] = $variables;
		ob_start();
		extract($variables);
		require $path;
		$this->_html = ob_get_contents();
		ob_end_clean();
	}

	public function render()
	{
		echo $this->_html;
	}

	public function html()
	{
		return $this->_html;
	}
}