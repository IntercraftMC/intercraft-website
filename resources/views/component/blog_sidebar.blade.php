<div class="col-12 col-md-3 sidebar-offcanvas" id="blog-sidebar">

	<!-- Recent Posts -->

	<div class="card">
		<div class="card-header">
			<h5>Recent</h5>
		</div>
		<div class="card-block">
			@foreach ($recent as $post)
				{!! $loop->index ? '<hr>' : '' !!}
				<div class="blog-title">
					<a href="blog_post?id={{ $post->id }}">
						{{ $post->title }}		
					</a>
				</div>
				<div class="blog-info text-muted">
					<i class="fa fa-calendar"></i> {{ $post->dateReadable() }}
				</div>
			@endforeach
		</div>
	</div>

	<!-- Categories -->

	<div class="card">
		<div class="card-header">
			<h5>Categories</h5>
		</div>
		<div class="card-block">
			@foreach ($categories as $category)
				<div>
					{!! $loop->index ? '<hr>' : '' !!}
					<a href="blog?category={{ $category['name'] }}">
						{{ $category['name'] . ' (' . $category['count'] . ')' }}
					</a>
				</div>
			@endforeach
		</div>
	</div>

	<!-- Archives -->

	<div class="card">
		<div class="card-header">
			<h5>Archives</h5>
		</div>
		<div class="card-block">
			@foreach ($archives as $archive=>$total)
				<div>
					{!! $loop->index ? '<hr>' : '' !!}
					<a href="blog?archive={{ $archive }}">
						{{ $archive . ' (' . $total . ')' }}
					</a>
				</div>
			@endforeach
		</div>
	</div>
</div>