<?php $i = 0; ?>
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