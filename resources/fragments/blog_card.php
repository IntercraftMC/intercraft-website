<div class="card blog-card">
	<a href="<?php echo "blog_post?id=$id"; ?>"><img src="<?php echo $img; ?>" alt="" class="card-img-top"></a>
	<div class="card-block">
		<a href="<?php echo "blog_post?id=$id"; ?>" class="blog-heading-link"><h4 class="blog-heading"><?php echo $title; ?></h4></a>
		<p><?php echo $desc; ?></p>
		<div class="info">
			<small class="text-muted">
				<span class="info-left">
					<span>
						<i class="fa fa-user"></i>
						<a href="<?php echo "member?profile=$author"; ?>"><?php echo $author; ?></a>
					</span>
					<span class="separated">
						<i class="fa fa-calendar"></i>
						<?php echo $date; ?>
					</span>
				</span><!-- 
			 --><span class="info-right">
					<span class="right">
						<i class="fa fa-eye"></i>
						<?php echo $views; ?>
					</span>
					<span class="separated right">
						<i class="fa fa-comment"></i>
						<?php echo count($comments); ?>
					</span>
				</span>
			</small>
		</div>
	</div>
</div>
<hr>