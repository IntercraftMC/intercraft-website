<section id="blog">
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-12 col-md-9 text-center">
				<?php foreach ($blogPosts as $post) { ?>
					<?php fragment('blog_card', $post); ?>
				<?php } ?>
				<button class="btn btn-primary">Load More</button>
				<hr class="sidebar-divider">
			</div>
			<div class="col-12 col-md-3 sidebar-offcanvas" id="blog-sidebar">
				<?php component('blog_recent', ['blogPosts' => $blogPosts]); ?>
				<?php component('blog_categories'); ?>
				<?php component('blog_archives'); ?>
			</div>
		</div>
	</div>
</section>