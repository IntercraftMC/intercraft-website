<?php

use App\Support\Captcha;
use ICanBoogie\Inflector;
use Jenssegers\Agent\Agent;

/**
 * Determine if the user is on a mobile device
 * @return boolean
 */
function isMobile() : bool
{
	static $agent;
	if (!$agent) $agent = new Agent();
	return $agent->isMobile() || $agent->isTablet();
}

/**
 * Get a random header image
 * @return string
 */
function headerImage() : string
{
	$images = config('view.header_images');
	return 'images/' . $images[rand(0, count($images)-1)] . '.png';
}

/**
 * Get the current Inflector instance
 * @return ICanBoogie\Inflector
 */
function inflector() : Inflector
{
	static $inflector;
	return $inflector ?: $inflector = Inflector::get('en');
}

/**
 * Get the pluralization of a word
 * @param  string $word
 * @return string
 */
function plural(string $word) : string
{
	return inflector()->pluralize($word);
}
/**
 * Get the singularization of a word
 * @param  string $word
 * @return string
 */
function singular(string $word) : string
{
	return inflector()->singularize($word);
}

/**
 * Generate an HTML error message
 * @param  string $message
 * @return string
 */
function error($message)
{
	if ($message)
		return "<div class='form-control-feedback'>$message</div>";
	return Null;
}

/**
 * Generate the HTML for a captcha
 * @return string
 */
function captcha()
{
	return Captcha::html();
}

/**
 * Generate a random hexadecimal string
 * @param  $length
 * @return String
 */
function randomHexString(int $length)
{
	$chars = "0123456789abcdef";
	$result = "";
	for ($i = 0; $i < $length; $i++)
		$result .= $chars[random_int(0, strlen($chars)-1)];
	return $result;
}

/**
 * Generate a random string
 * @param  $length
 * @return String
 */
function randomString(int $length)
{
	$chars = "0123456789abcdefghijklmnopqrstuvwxyz-_";
	$result = "";
	for ($i = 0; $i < $length; $i++)
		$result .= $chars[random_int(0, strlen($chars)-1)];
	return $result;
}

/**
 * Create a Json response
 * @return Response
 */
function jsonResponse($data, int $statusCode = 200)
{
	return response($data, $statusCode)->header("Content-Type", "application/json");
}