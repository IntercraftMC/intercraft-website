<header class="video-header" data-vide-bg="video/IronTitan" data-vide-options="posterType: png, loop: true, muted: true, position: 50% 50%, resizing: true">
	@include("component.navbar", ["active" => 0, "home" => True])
	<div id="particles-header"></div>
	<div class="video-overlay container-fluid">
		<div class="row h-100">
			<div class="col-md-12 my-auto text-center">
				<h1 class="display-1 align-middle header-brand">INTERCRAFT</h1>
				<p class="header-motto">Minecraft Survival Server</p>
				<a href="{{ route('join') }}" class="pointer"><button class="btn btn-primary btn-lg">Join InterCraft</button></a>
			</div>
		</div>
	</div>
</header>