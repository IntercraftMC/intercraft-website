<section id="gallery">
	<div class="container">
		@isset($brief)
			<div class="row text-center">
				<div class="col-12 header">
					<h2>Gallery</h2>
				</div>
			</div>
		@endisset
		<div class="row" id="image-gallery">
			@foreach($images as $image)
				@component("component.gallery_image")
					@slot("image") {{ $image->image }} @endslot
					{{ $image->description }}
				@endcomponent
			@endforeach
		</div>
		@if(isset($brief))
			<div class="row">
				<div class="col-12 text-center">
					<a href="{{ route("gallery") }}" class="btn btn-primary">View More</a>
				</div>
			</div>
		@else
			<!-- <div class="row">
				<div class="col-12 text-center">
					<hr>
					<button class="btn btn-primary">Load More</button>
				</div>
			</div> -->
		@endif
	</div>
</section>