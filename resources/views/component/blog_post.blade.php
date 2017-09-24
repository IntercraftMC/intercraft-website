<div class="card blog-card">
	<img src="/uploads/blog/{{ $image }}.png" alt="" class="card-img-top">
	<div class="card-block">
		<h4 class="blog-heading">{{ $title }}</h4>
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