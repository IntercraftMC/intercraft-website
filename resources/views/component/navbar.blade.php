<nav class="navbar {{ isset($home) ? "navbar-home" : "" }} navbar-toggleable-md navbar-inverse navbar-color">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="">
		<img src="assets/img/navbar_brand_30.png" class="d-inline-block align-top">
		InterCraft
	</a>
	<?php $name = Route::currentRouteName(); ?>
	<div class="collapse navbar-collapse justify-content-end" id="navbar">
		<ul class="navbar-nav mt-2 mt-sm-0">
			<li class="nav-item {{ ($name == 'home') ? 'active': '' }}">
				<a class="nav-link" href="{{ route('home') }}">Home</a>
			</li>
			<li class="nav-item {{ ($name == 'about') ? 'active': '' }}">
				<a class="nav-link" href="{{ route('about') }}">About</a>
			</li>
			<li class="nav-item {{ (0 === strpos($name, 'blog')) ? 'active': '' }}">
				<a class="nav-link" href="{{ route('blog') }}">Blog</a>
			</li>
			<li class="nav-item {{ ($name == 'gallery') ? 'active': '' }}">
				<a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
			</li>
			<li class="nav-item {{ (0 === strpos($name, 'members')) ? 'active': '' }}">
				<a class="nav-link" href="{{ route('members') }}">Members</a>
			</li>
			<li class="nav-item {{ ($name == 'map') ? 'active': '' }}">
				<a class="nav-link" href="{{ route('map') }}">Live Map</a>
			</li>
			<li class="nav-item {{ ($name == 'join') ? 'active': '' }}">
				<a class="nav-link" href="{{ route('join') }}">Sign Up</a>
			</li>
		</ul>
	</div>
</nav>