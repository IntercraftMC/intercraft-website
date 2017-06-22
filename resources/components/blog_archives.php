<div class="card">
	<div class="card-header">
		<h5>Archives</h5>
	</div>
	<div class="card-block">
		<?php $i = 0; ?>
		<?php foreach ($archives as $archive): ?>
			<div>
				<?php echo $i++ ? '<hr>' : '' ?>
				<a href="blog?archive=<?php echo $archive['date'] ?>">
					<?php echo $archive['date'] . ' (' . $archive['total'] . ')'; ?>	
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>