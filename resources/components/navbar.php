<nav class="navbar navbar-toggleable-md navbar-inverse navbar-color">
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="#">
		<img src="assets/img/navbar_brand_30.png" class="d-inline-block align-top">
		InterCraft
	</a>
	<?php fragment('navbar_content', ['active' => $active]); ?>
</nav>