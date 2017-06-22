<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title; ?></title>
	<?php component("metadata"); ?>
</head>
<body>
	<div class="page">
		<?php component("navbar", ['active' => 2]); ?>
		<?php component("sub_header", [
				'heading' => $mainBlogPost->title(),
				'image' => $mainBlogPost->image(),
				'lead' => strip_tags($mainBlogPost->body()),
				'buttonText' => 'Read More',
				'buttonUrl' => 'blog_post?id='.$mainBlogPost->id()
			]); 
		?>
		<?php component("blog_posts", ['blogPosts' => $blogPosts, 
		                               'recent' => $recent, 
		                               'archives' => $archives,
		                               'categories' => $categories]); ?>
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