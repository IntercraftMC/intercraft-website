<section id="section-modpack">
	<div class="container">	
		<div class="row text-center">
			<div class="col-12">
				<h3>The InterCraft Modpack</h3>
				<hr>
			</div>
		</div>
		<div class="row">
			@foreach($mods as $mod)
				<div class="col-md-4 text-center">
					<p>
						<a href="{{ $mod[1] }}">{{ $mod[0] }}</a>
					</p>
				</div>
			@endforeach
		</div>
	</div>
</section>