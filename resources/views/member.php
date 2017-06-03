<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
</head>
<body>
	<?php component('navbar', ['active' => 4]); ?>
	<?php component('member', ['user' => $user]); ?>
	<?php component('footer') ?>

	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/tether.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/jquery.vide.min.js"></script>
	<script src="assets/js/particles.js"></script>
	<script src="assets/js/app.js"></script>
	<script>
		<?php if (!isMobile()) echo "initParticles();\n"; ?>
		$(document).ready(function() {
			navColor();
		});
	</script>
</body>
</html>