<div class="card">
	<div class="card-header">
		<h5>Categories</h5>
	</div>
	<div class="card-block">
		<?php $i = 0; ?>
		<?php foreach ($categories as $category): ?>
			<div>
				<?php echo $i++ ? '<hr>' : ''; ?>
				<a href="blog?category=<?php echo $category['category'] ?>">
					<?php echo $category['category'] . ' (' . $category['total'] . ')'; ?>		
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>