<?php

define("ROOT_DIR", __DIR__ . "/..");
define("CONFIG_DIR", ROOT_DIR . "/config");
define("RES_DIR", __DIR__ . "/../resources");

require ROOT_DIR . "/vendor/autoload.php";

$config = new App\Config(CONFIG_DIR);

define("HOST_NAME", $config['general']['hostname']);

App\Captcha::configure($config['captcha']);
App\Database::configure($config['database']);
App\Template::configure($config['template']);

