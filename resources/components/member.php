<section id="member">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2 class="member-heading"><?php echo $user->username(); ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<div>
					<img src="<?php echo "assets/skins/{$user->uuid()}_face.png"; ?>" alt="" class="rounded" style="width: 100%;">
				</div>
			</div>
			<div class="col-sm-10">
				<ul class="nav nav-pills" role="tablist">
					<li class="nav-item">
						<a href="#member-about" class="nav-link active" data-toggle="pill" role="tab"><i class="fa fa-user"></i> About</a>
					</li>
					<li class="nav-item">
						<a href="#member-gallery" class="nav-link" data-toggle="pill" role="tab"><i class="fa fa-picture-o"></i> Gallery</a>
					</li>
					<li class="nav-item">
						<a href="#member-stats" class="nav-link" data-toggle="pill" role="tab"><i class="fa fa-bar-chart"></i> Statistics</a>
					</li>
				</ul>
				<hr>
				<div class="row tab-content">
					<div class="tab-pane fade show active" id="member-about">
						<div class="col-12">
							<p><?php echo $user->profile()->description(); ?></p>
						</div>
					</div>
					<div class="tab-pane fade" id="member-gallery">
						<div class="col-12">
							<p><?php echo $user->username() . ' has not posted any images.' ?></p>
						</div>
					</div>
					<div class="tab-pane fade" id="member-stats">
						<div class="col-12">
							<p>(User statistics coming soon!)</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>