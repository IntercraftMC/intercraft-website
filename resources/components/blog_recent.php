<div class="card">
	<div class="card-header">
		<h5>Recent</h5>
	</div>
	<div class="card-block">
		<?php $i = 0; ?>
		<?php foreach ($recent as $post): ?>
			<?php echo $i ? '<hr>' : ''; ?>
			<div class="blog-title">
				<a href="blog_post?id=<?php echo $post->id(); ?>">
					<?php echo $post->title(); ?>		
				</a>
			</div>
			<div class="blog-info text-muted">
				<i class="fa fa-calendar"></i> <?php echo $post->dateReadable(); ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>