<?php

use App\Captcha;
use App\Config;
use App\Database;
use App\Template;
use Detection\MobileDetect;

function d(...$stuff)
{
	foreach ($stuff as $thing) {
		echo '<pre>';
		var_dump($thing);
		echo '</pre>';
	}
}

function dd(...$stuff)
{
	d($stuff);
	exit();
}

function isMobile()
{
	$detect = new MobileDetect;
	return $detect->isMobile();
}

function config()
{
	return Config::instance();
}

function db()
{
	return Database::instance();
}

function field($array, $value, $defaultValue = Null)
{
	if (isset($array[$value]))
		return $array[$value];
	return $defaultValue;
}

function fieldInt($array, $value, $defaultValue = Null)
{
	if (isset($array[$value]))
		return (int) $array[$value];
	return $defaultValue;
}

function get($field, $defaultValue = Null)
{
	return isset($_GET[$field]) ? $_GET[$field] : $defaultValue;
}

function post($field, $defaultValue = Null)
{
	return isset($_POST[$field]) ? $_POST[$field] : $defaultValue;
}

function randomString(int $len = 16)
{
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_0123456789';
	$string = '';
	for ($i = 0; $i < $len; $i++)
		$string .= $chars[mt_rand(0, strlen($chars)-1)];
	return $string;
}

function randomUuid()
{
	$chars = 'abcdef0123456789';
	$string = '';
	for ($i = 0; $i < 32; $i++)
		$string .= $chars[mt_rand(0, strlen($chars)-1)];
	return $string;
}

function captcha()
{
	echo Captcha::html();
}

function component($name, $variables = [])
{
	$template = new Template($name, $variables);
	$template->loadComponent($name, $variables);
	$template->render();
}

function fragment($name, $variables = [])
{
	$template = new Template($name, $variables);
	$template->loadFragment($name, $variables);
	$template->render();
}

function view($name, $variables = [])
{
	$template = new Template($name, $variables);
	$template->loadView($name, $variables);
	$template->render();
}

function redirect($location)
{
	header("Location: $location");
	exit();
}