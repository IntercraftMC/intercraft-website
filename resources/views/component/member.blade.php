<div class="col-6 col-md-3 col-lg-3 text-center member-card">
	<a href="{{ route('members_member', ['username' => $slot]) }}">
		<img src="uploads/skins/{{ $uuid }}_face.png" alt="" class="rounded" style="width: 120px;">
	</a>
	<a class="user-link" href="{{ route('members_member', ['username' => $slot]) }}">
		{{ $slot }}
	</a>
</div>