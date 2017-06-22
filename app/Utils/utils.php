<?php

// Use the required classes
use App\Captcha;
use App\Config;
use App\Database;
use App\FormBuilder;
use App\Template;
use App\Validation\ScoutEnv;
use Detection\MobileDetect;
use Scout\Scout;
use Scout\ScoutResult;

$m_scoutResult = Null;

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
		if (!array_key_exists($value, $array))
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
	if (array_key_exists($value, $array))
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
	if (array_key_exists($value, $array))
		return (int) $array[$value];
	return $defaultValue;
}

/**
 * Check if a key exists in an array, and return the result as JSON
 * @param  array
 * @param  anything
 * @param  anything
 * @return anything
 */
function fieldJson($array, $value, $defaultValue = [])
{
	if (array_key_exists($value, $array))
		return json_decode($array[$value], True);
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
	return array_key_exists($field, $_GET) ? $_GET[$field] : $defaultValue;
}

/**
 * Get a field from the POST request
 * @param  array
 * @param  anything
 * @return anything
 */
function post($field, $defaultValue = Null)
{
	return array_key_exists($field, $_POST) ? $_POST[$field] : $defaultValue;
}

/**
 * Get a random header image path from the list
 * @return string path to an image
 */
function randomHeaderImage()
{
	$images = config()['template']['header_images'];
	return 'assets/img/' . $images[rand(0, count($images) - 1)];
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
 * Generate a path starting from the project's root directory
 * @param  string $path
 * @return [type]       [description]
 */
function path(string $path)
{
	return ROOT_DIR . '/' . ltrim($path, '/');
}

/**
 * Join a path
 * @param  string $currentPath [description]
 * @param  string $to          [description]
 * @return string
 */
function joinPath(string $currentPath, string $to)
{
	return rtrim($currentPath, '/') . '/' . ltrim($to, '/');
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
 * [email description]
 * @param  string|Null $name       
 * @param  string|Null $id         
 * @param  string|Null $value      
 * @param  string|Null $placeHolder
 * @return void            
 */
function email($name, $id = Null, $value = Null, $placeHolder = Null)
{
	if ($value === Null)
		$value = ($name !== Null && isset($_POST[$name])) ? $_POST[$name] : Null;

	echo FormBuilder::email('form-control form-control-danger', $name, $id, $value, $placeHolder);
}

/**
 * [email description]
 * @param  string|Null $name       
 * @param  string|Null $id         
 * @param  string|Null $value      
 * @param  string|Null $placeHolder
 * @return void            
 */
function input($name, $id = Null, $value = Null, $placeHolder = Null)
{
	if ($value === Null)
		$value = ($name !== Null && isset($_POST[$name])) ? $_POST[$name] : Null;
	echo FormBuilder::input('form-control form-control-danger', $name, $id, $value, $placeHolder);
}

/**
 * [email description]
 * @param  string|Null $name       
 * @param  string|Null $id         
 * @param  string|Null $value      
 * @param  string|Null $placeHolder
 * @return void            
 */
function checkBox($name, $id = Null, $value = Null, $checked = Null)
{
	if ($checked === Null)
		$checked = ($name !== Null && isset($_POST[$name])) ? True : False;
	echo FormBuilder::checkBox('form-check-input', $name, $id, $value, $checked);
}

/**
 * Get the current scout instance
 * @return Scout\Scout
 */
function scout()
{
	static $_scout;
	static $_scoutEnv;
	if ($_scout === Null) {
		$_scoutEnv = new ScoutEnv(RES_DIR . '/locale/en/scout.php', db());
		$_scout = new Scout($_scoutEnv);
	}
	return $_scout;
}

/**
 * Get the result from the last Scout validation
 * @param  Scout\ScoutResult $result (Optional), assign a new result
 * @return Scout\ScoutResult
 */
function scoutResult(ScoutResult $result = Null)
{
	static $scoutResult;
	if ($result !== Null)
		$scoutResult = $result;
	return $scoutResult;
}

/**
 * Validate a form of values
 * @param  array  $form       name, rule string, custom messages
 * @return Scout\ScoutResult
 */
function validate(array $form)
{
	$fields = [];
	foreach ($form as $field) {
		$name = $field[0];
		$rules = $field[1];
		$messages = (count($field) > 2) ? $field[2] : [];
		$fields[$name] = [post($name), $rules, $messages];
	}
	return scoutResult(scout()->validate($fields));
}

/**
 * Check if an error exists for the given field
 * @param  string  $name
 * @return boolean
 */
function hasError(string $name)
{
	if (scoutResult() === Null)
		return false;
	return scoutResult()->has($name);
}

/**
 * Generate the feedback if the error exists for the given field
 * @param  string name
 * @return string
 */
function error(string $name)
{
	if (scoutResult() === Null)
		return Null;
	return '<div class="form-control-feedback">' . scoutResult()->first($name) . '</div>';
}

/**
 * Redirect to the giver URI
 * @param  string url
 * @return void
 */
function redirect(string $uri)
{
	header("Location: $uri");
	exit();
}

/**
 * Get the url to the website
 * @return string
 */
function url()
{
	return config()['general']['protocol'] . '//' . config()['general']['hostname'] . '/';
}