<section id="blog">
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-12 col-md-9 text-center">
				<?php foreach ($blogPosts as $post) { ?>
					<?php fragment('blog_card', ['blog' => $post]); ?>
				<?php } ?>
				<!-- <button class="btn btn-primary">Load More</button> -->
				<hr class="sidebar-divider">
			</div>
			<div class="col-12 col-md-3 sidebar-offcanvas" id="blog-sidebar">
				<?php component('blog_recent', ['recent' => $recent]); ?>
				<?php component('blog_categories', ['categories' => $categories]); ?>
				<?php component('blog_archives', ['archives' => $archives]); ?>
			</div>
		</div>
	</div>
</section>