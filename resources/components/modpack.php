<section id="section-modpack">
	<div class="container">	
		<div class="row">
			<div class="col-12">
				<h3>The Modpack</h3>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php for ($i = 0; $i < ceil(count($mods)/2); $i++): ?>
				<div class="col-6">
					<ul>
						<li><?php echo $mods[$i]; ?></li>
					</ul>
				</div>
			<?php endfor; ?>
			<?php for ($i; $i < count($mods); $i++): ?>
				<div class="col-6">
					<ul>
						<li><?php echo $mods[$i]; ?></li>
					</ul>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</section>