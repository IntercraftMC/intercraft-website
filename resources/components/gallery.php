<section id="gallery">
	<div class="container">
		<div class="row">
			<?php for ($i = 0; $i < count($images); $i++): ?>
				<?php if ($i < 2): ?>
					<?php fragment('gallery_featured_card', ['image' => $images[$i]]); ?>
				<?php else: ?>
					<?php fragment('gallery_card', ['image' => $images[$i]]); ?>
				<?php endif; ?>
			<?php endfor; ?>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<button class="btn btn-primary">Load More</button>
			</div>
		</div>
	</div>
</section>