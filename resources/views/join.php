<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<?php component('navbar', ['active' => 6]); ?>
	<?php component("sub_header", [
									'image' => 'https://placekitten.com/1920/931',
									'heading' => 'Become a Member',
									'lead' => 'While InterCraft is a private whitelisted server, we do accept applications to join!'
								]); ?>
	<?php component('join', ['questions' => $questions]); ?>
	<?php component('footer'); ?>

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