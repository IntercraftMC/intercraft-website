<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
</head>
<body>
	<?php component("navbar", ['active' => 3]); ?>
	<?php component("sub_header", [
									'image' => 'https://placekitten.com/1920/931',
									'heading' => 'The InterCraft Gallery',
									'lead' => 'The gallery is comprised of the various builds that members have put together on the InterCraft server.'
								]); ?>
	<?php component("gallery", ['images' => $images]); ?>
	<?php component("footer"); ?>
	
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