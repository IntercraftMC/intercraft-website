<div class="card blog-card">
	<a href="{{ route("blog_entry", ["slug" => $slug]) }}"><img src="uploads/blog/{{ $image }}.png" alt="" class="card-img-top"></a>
	<div class="card-block">
		<a href="{{ route("blog_entry", ["slug" => $slug]) }}" class="blog-heading-link"><h4 class="blog-heading">{{ $title }}</h4></a>
		{{ $slot }}
		<div class="info">
			<small class="text-muted">
				<span class="info-left">
					<span>
						<i class="fa fa-user"></i>
						<a href="{{ route("members_member", ["username" => $author]) }}">{{ $author }}</a>
					</span>
					<span class="separated">
						<i class="fa fa-calendar"></i>
						{{ $date }}
					</span>
				</span><!-- 
			 --><span class="info-right">
					<span class="right">
						<i class="fa fa-eye"></i>
						{{ $views }}
					</span>
				</span>
			</small>
		</div>
	</div>
</div>
<hr>