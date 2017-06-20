<?php

require '../bootstrap/bootstrap.php';

use App\Mojang\Mojang;

$uuid = Mojang::uuidFromUsername('SirDavidLudwig');
$profile = Mojang::profile($uuid);

echo $profile->uuid();
echo $profile->username();