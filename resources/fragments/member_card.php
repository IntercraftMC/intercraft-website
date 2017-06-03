<div class="col-6 col-md-3 col-lg-3 text-center member-card">
	<a href="<?php echo "member?profile={$user->username()}"; ?>">
		<img src="<?php echo "assets/img/skin/{$user->uuid()}.png"; ?>" alt="" class="rounded" style="width: 120px;">
	</a>
	<a class="user-link" href="<?php echo "member?profile={$user->username()}"; ?>"><?php echo $user->username(); ?></a>
</div>