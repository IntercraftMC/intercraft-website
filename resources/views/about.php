<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
</head>
<body>
	<?php component("navbar", ['active' => 1]); ?>
	<?php component("sub_header", [
									'image' => 'https://placekitten.com/1920/931',
									'heading' => 'About InterCraft',
									'lead' => 'InterCraft is a lightly modded Minecraft survival server'
								]); ?>
	<?php component("about"); ?>
	<?php component('footer'); ?>
	<script src="assets/js/app.js"></script>
	<script>
		<?php if (!isMobile()) echo "initParticles();\n"; ?>
		$(document).ready(function() {
			navColor();
		});
	</script>
</body>
</html>