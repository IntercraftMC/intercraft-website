<div class="card blog-card">
	<a href="<?php echo "blog_post?id=" . $blog->id(); ?>"><img src="<?php echo $blog->image(); ?>" alt="" class="card-img-top"></a>
	<div class="card-block">
		<a href="<?php echo "blog_post?id=" . $blog->id(); ?>" class="blog-heading-link"><h4 class="blog-heading"><?php echo $blog->title(); ?></h4></a>
		<?php echo $blog->brief(); ?>
		<div class="info">
			<small class="text-muted">
				<span class="info-left">
					<span>
						<i class="fa fa-user"></i>
						<a href="<?php echo "member?profile=" . $blog->user()->username(); ?>"><?php echo $blog->user()->username(); ?></a>
					</span>
					<span class="separated">
						<i class="fa fa-calendar"></i>
						<?php echo $blog->date(); ?>
					</span>
				</span><!-- 
			 --><span class="info-right">
					<span class="right">
						<i class="fa fa-eye"></i>
						<?php echo $blog->views(); ?>
					</span>
					<span class="separated right">
						<i class="fa fa-comment"></i>
						<?php echo count($blog->comments()); ?>
					</span>
				</span>
			</small>
		</div>
	</div>
</div>
<hr>