<?php $i = 0; ?>
<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
	<span class="navbar-toggler-icon"></span>
</button>
<a class="navbar-brand" href="#">
	<img src="assets/img/navbar_brand.png" class="d-inline-block align-top">
	InterCraft
</a>
<div class="collapse navbar-collapse justify-content-end" id="navbar">
	<ul class="navbar-nav mt-2 mt-sm-0">
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="index">Home</a>
		</li>
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="about">About</a>
		</li>
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="blog">Blog</a>
		</li>
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="gallery">Gallery</a>
		</li>
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="members">Members</a>
		</li>
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="map">Live Map</a>
		</li>
		<li class="nav-item <?php echo ($i++ == $active) ? 'active': ''; ?>">
			<a class="nav-link" href="join">Sign Up</a>
		</li>
	</ul>
</div>