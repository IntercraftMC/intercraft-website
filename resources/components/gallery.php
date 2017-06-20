<section id="gallery">
	<div class="container">
		<div class="row">
			<?php for ($i = 0; $i < count($images); $i++): ?>
				<?php fragment('gallery_card', ['image' => $images[$i]]); ?>
			<?php endfor; ?>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<hr>
				<button class="btn btn-primary">Load More</button>
			</div>
		</div>
	</div>
</section>