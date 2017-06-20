<?php

namespace App;

class Template
{
	private static $_config;
	private $m_html;

	public static function configure($config)
	{
		self::$_config = $config;
	}

	public function __construct()
	{
	}

	public function loadComponent($name, $variables)
	{
		$path = joinPath(path(self::$_config['component_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function loadFragment($name, $variables)
	{
		$path = joinPath(path(self::$_config['fragment_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function loadView($name, $variables)
	{
		$path = joinPath(path(self::$_config['view_directory']), "/$name.php");
		return $this->load($path, $variables);
	}

	public function load($path, $variables)
	{
		$variables['variables'] = $variables;
		ob_start();
		extract($variables);
		require $path;
		$this->m_html = ob_get_contents();
		ob_end_clean();
	}

	public function render()
	{
		echo $this->m_html;
	}

	public function html()
	{

	}
}