<?php

if (isset($_POST['password'])) {
	echo password_hash($_POST['password'], PASSWORD_BCRYPT);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create a password</title>
</head>
<body>
	<form action="" method="post">
		<input type="password" name="password" placeholder="Password">
		<button type="submit">Submit</button>
	</form>
</body>
</html>