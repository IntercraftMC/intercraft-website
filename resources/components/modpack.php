<section id="section-modpack">
	<div class="container">	
		<div class="row text-center">
			<div class="col-12">
				<h3>The InterCraft Modpack</h3>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php foreach ($mods as $mod): ?>
				<div class="col-md-4 text-center">
					<p>
						<a href="<?php echo $mod['url']; ?>"><?php echo $mod['name']; ?></a>
					</p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>