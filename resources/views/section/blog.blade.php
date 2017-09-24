<section id="blog">
	<div class="container">
		<div class="row row-offcanvas row-offcanvas-right">
			<div class="col-12 col-md-9 text-center">
				@foreach ($posts as $post)
					@component("component.blog_card")
						@slot("slug") {{ $post->id }} @endslot
						@slot("title") {{ $post->title }} @endslot
						@slot("image") {{ $post->image }} @endslot
						@slot("author") {{ $post->user->username }} @endslot
						@slot("date") {{ $post->dateReadable() }} @endslot
						@slot("views") {{ $post->views }} @endslot
						{!! $post->brief !!}
					@endcomponent
				@endforeach
				<!-- <button class="btn btn-primary">Load More</button> -->
				<hr class="sidebar-divider">
			</div>
			@include("component.blog_sidebar", [
				"archives" => $archives,
				"categories" => $categories,
				"recent" => $recent
			])
		</div>
	</div>
</section>