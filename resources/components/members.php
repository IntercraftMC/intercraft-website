<section id="members">
	<div class="container">	
		<div class="row">
			<div class="col-12">
				<h4>Administrators</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php
				foreach ($users as $user) {
					if ($user->isAdmin()) {
						fragment('member_card', ['user' => $user]);
					}
				}
			?>
		</div>
		<div class="row">
			<div class="col-12">
				<h4>VIPs</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php
				foreach ($users as $user) {
					if ($user->isModerator()) {
						fragment('member_card', ['user' => $user]);
					}
				}
			?>
		</div>
		<div class="row">
			<div class="col-12">
				<h4>Citizens</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			<?php
				foreach ($users as $user) {
					if ($user->isNormal()) {
						fragment('member_card', ['user' => $user]);
					}
				}
			?>
		</div>
	</div>
</section>