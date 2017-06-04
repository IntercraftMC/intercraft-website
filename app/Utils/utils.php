<?php

// Use the required classes
use App\Captcha;
use App\Config;
use App\Database;
use App\Template;
use Detection\MobileDetect;

/**
 * Print the given values
 * @param  anything
 * @return void
 */
function d(...$stuff)
{
	foreach ($stuff as $thing) {
		echo '<pre>';
		var_dump($thing);
		echo '</pre>';
	}
}

/**
 * Print the given values and kill the page
 * @param  anything
 * @return void
 */
function dd(...$stuff)
{
	d($stuff);
	exit();
}

/**
 * Determine if the user is on a mobile device
 * @return bool
 */
function isMobile()
{
	$detect = new MobileDetect;
	return $detect->isMobile();
}

/**
 * Get the current config
 * @return App\Config
 */
function config()
{
	return Config::instance();
}

/**
 * Get the current database instance
 * @return App\Database
 */
function db()
{
	return Database::instance();
}

/**
 * Check if some keys exists in an array
 * @param  array
 * @param  anything
 * @return bool
 */
function fieldsExist(array $array, ...$values)
{
	foreach ($values as $value)
		if (!isset($array[$value]))
			return False;
	return True;
}

/**
 * Check if a key exists in an array
 * @param  array
 * @param  anything
 * @param  anything
 * @return anything
 */
function field(array $array, $value, $defaultValue = Null)
{
	if (isset($array[$value]))
		return $array[$value];
	return $defaultValue;
}

/**
 * Check if a key exists in an array, and return the result as an int
 * @param  array
 * @param  anything
 * @param  anything
 * @return anything
 */
function fieldInt($array, $value, $defaultValue = Null)
{
	if (isset($array[$value]))
		return (int) $array[$value];
	return $defaultValue;
}

/**
 * Get a field from the GET request
 * @param  array
 * @param  anything
 * @return anything
 */
function get($field, $defaultValue = Null)
{
	return isset($_GET[$field]) ? $_GET[$field] : $defaultValue;
}

/**
 * Get a field from the POST request
 * @param  array
 * @param  anything
 * @return anything
 */
function post($field, $defaultValue = Null)
{
	return isset($_POST[$field]) ? $_POST[$field] : $defaultValue;
}

/**
 * Generate a random alphanumeric string
 * @param  int
 * @return string
 */
function randomString(int $len = 16)
{
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_0123456789';
	$string = '';
	for ($i = 0; $i < $len; $i++)
		$string .= $chars[mt_rand(0, strlen($chars)-1)];
	return $string;
}

/**
 * Generate a random UUID
 * @return string
 */
function randomUuid()
{
	$chars = 'abcdef0123456789';
	$string = '';
	for ($i = 0; $i < 32; $i++)
		$string .= $chars[mt_rand(0, strlen($chars)-1)];
	return $string;
}

/**
 * Generate the HTML for a captcha
 * @return void
 */
function captcha()
{
	echo Captcha::html();
}

/**
 * Render a component
 * @param  string
 * @param  array
 * @return void
 */
function component(string $name, array $variables = [])
{
	$template = new Template($name, $variables);
	$template->loadComponent($name, $variables);
	$template->render();
}

/**
 * Render a fragment
 * @param  string
 * @param  array
 * @return void
 */
function fragment(string $name, array $variables = [])
{
	$template = new Template($name, $variables);
	$template->loadFragment($name, $variables);
	$template->render();
}

/**
 * Render a view
 * @param  string
 * @param  array
 * @return void
 */
function view(string $name, array $variables = [])
{
	$template = new Template($name, $variables);
	$template->loadView($name, $variables);
	$template->render();
}

/**
 * Redirect to the giver URI
 * @param  [string]
 * @return void
 */
function redirect(string $uri)
{
	header("Location: $uri");
	exit();
}