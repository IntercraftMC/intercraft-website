<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
	<link rel="stylesheet" href="assets/css/lightgallery.css">
	<link rel="stylesheet" href="assets/css/lg-transitions.min.css">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "<?php echo $adsenseId; ?>",
			enable_page_level_ads: true
		});
	</script>
</head>
<body>
	<div class="page">
		<?php component("header"); ?>
		<?php component("home_about"); ?>
		<?php component("features"); ?>
		<?php component("home_gallery", ['images' => $images]); ?>
	</div>
	<?php component('footer'); ?>
	
	<script src="assets/js/jquery-2.2.3.min.js"></script>
	<script src="assets/js/lightgallery.js"></script>
	<script src="assets/js/lg-fullscreen.min.js"></script>
	<script src="assets/js/lg-hash.js"></script>
	<script src="assets/js/lg-pager.min.js"></script>
	<script src="assets/js/lg-share.min.js"></script>
	<script src="assets/js/lg-thumbnail.min.js"></script>
	<script src="assets/js/lg-video.min.js"></script>
	<script src="assets/js/lg-zoom.min.js"></script>
	<script src="assets/js/tether.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/jquery.vide.min.js"></script>
	<script src="assets/js/particles.js"></script>
	<script src="assets/js/app.js"></script>
	<script>
		<?php if (!isMobile()) echo "initParticles();\n"; ?>
		
		$(document).ready(function() {
			if ($('#image-gallery'))
				$('#image-gallery').lightGallery({
					galleryId: 0	
				});
		});
	</script>
</body>
</html>