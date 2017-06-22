<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
</head>
<body>
	<div class="page">
		<?php component("navbar", ['active' => 1]); ?>
		<?php component("sub_header", [
										'image' => randomHeaderImage(),
										'heading' => 'About InterCraft',
										'lead' => 'InterCraft is a lightly modded Minecraft survival server...'
									]); ?>
		<?php component("about"); ?>
		<?php component("features"); ?>
		<?php component("modpack", ['mods' => $mods]); ?>
	</div>
	<?php component('footer'); ?>

	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/tether.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/jquery.vide.min.js"></script>
	<script src="assets/js/particles.js"></script>
	<script src="assets/js/app.js"></script>
	<script>
		<?php if (!isMobile()) echo "initParticles();\n"; ?>
	</script>
</body>
</html>