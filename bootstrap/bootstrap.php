<?php

define("ROOT_DIR", __DIR__ . "/..");
define("CONFIG_LOCATION", ROOT_DIR . "/config.json");

require ROOT_DIR . "/vendor/autoload.php";
$config = new App\Config(CONFIG_LOCATION);

define("HOST_NAME", $config['general']['hostname']);

App\Captcha::configure($config['captcha']);
App\Database::configure($config['database']);
App\Template::configure($config['template']);

