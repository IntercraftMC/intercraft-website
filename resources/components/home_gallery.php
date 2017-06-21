<section id="gallery">
	<div class="container">
		<div class="row text-center">
			<div class="col-12 header">
				<h2>Gallery</h2>
			</div>
		</div>
		<div class="row" id="image-gallery">
			<?php for ($i = 0; $i < count($images); $i++): ?>
				<?php fragment('gallery_card', ['image' => $images[$i]]); ?>
			<?php endfor; ?>
		</div>
		<div class="row">
			<div class="col-12 text-center">
				<a href="gallery" class="btn btn-primary">View More</a>
			</div>
		</div>
	</div>
</section>