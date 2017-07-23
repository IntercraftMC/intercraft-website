<section id="blog">
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-12 col-md-9 text-center">
				<div class="card blog-card">
					<a href="<?php echo "blog_post?id=" . $post->id(); ?>"><img src="<?php echo $post->image(); ?>" alt="" class="card-img-top"></a>
					<div class="card-block">
						<a href="<?php echo "blog_post?id=" . $post->id(); ?>" class="blog-heading-link"><h4 class="blog-heading"><?php echo $post->title(); ?></h4></a>
						<?php echo $post->body(); ?>
						<div class="info">
							<small class="text-muted">
								<span class="info-left">
									<span>
										<i class="fa fa-user"></i>
										<a href="<?php echo "member?profile=" . $post->user()->username(); ?>"><?php echo $post->user()->username(); ?></a>
									</span>
									<span class="separated">
										<i class="fa fa-calendar"></i>
										<?php echo $post->date(); ?>
									</span>
								</span><!-- 
							 --><span class="info-right">
									<span class="right">
										<i class="fa fa-eye"></i>
										<?php echo $post->views(); ?>
									</span>
									<span class="separated right">
										<i class="fa fa-comment"></i>
										<?php echo count($post->comments()); ?>
									</span>
								</span>
							</small>
						</div>
					</div>
				</div>
				<hr>
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