<?php

require('../../bootstrap/bootstrap.php');

echo count($_POST), "<br>";
echo count($_FILES), "<br>";

foreach ($_POST as $post)
	echo "$post<br>";

echo "Done";