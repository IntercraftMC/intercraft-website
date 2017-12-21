<section id="members">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h4>Administrators</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			@foreach($admins as $user)
				@component('component.member')
					@slot('uuid') {{ $user->profile->primaryUuid() }} @endslot
					{{ $user->profile->mc_username }}
				@endcomponent
			@endforeach
		</div>
		<div class="row">
			<div class="col-12">
				<h4>VIPs</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			@foreach($vips as $user)
				@component('component.member')
					@slot('uuid') {{ $user->profile->primaryUuid() }} @endslot
					{{ $user->profile->mc_username }}
				@endcomponent
			@endforeach
		</div>
		<div class="row">
			<div class="col-12">
				<h4>Citizens</h4>
				<hr>
			</div>
		</div>
		<div class="row">
			@foreach($citizens as $user)
				@component('component.member')
					@slot('uuid') {{ $user->profile->primaryUuid() }} @endslot
					{{ $user->profile->mc_username }}
				@endcomponent
			@endforeach
		</div>
	</div>
</section>
