<header class="jumbotron jumbotron-fluid sub-header" style="background-image: url('<?php echo $image; ?>');">
	<div id="particles-header"></div>
	<div class="container h-100">
		<div class="row h-100">
			<div class="col-12 my-auto text-center">
				<h1 class="display-4 align-middle"><?php echo $heading; ?></h1>
				<p class="lead"><?php echo $lead; ?></p>
				<?php if (isset($buttonText)): ?>
				<a href="<?php echo $buttonUrl; ?>" class="pointer"><button class="btn btn-primary"><?php echo $buttonText; ?></button></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</header>