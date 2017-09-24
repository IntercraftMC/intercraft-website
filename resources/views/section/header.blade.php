<header class="jumbotron jumbotron-fluid sub-header" style="background-image: url('{{ $image  }}');">
	<div id="particles-header"></div>
	<div class="container h-100">
		<div class="row h-100">
			<div class="col-12 my-auto text-center">
				<h1 class="display-4 align-middle">{{ $heading }}</h1>
				<p class="lead">{{ $slot }}</p>
				@isset($buttonLabel)
					<a href="{{ $buttonUrl }}" class="pointer"><button class="btn btn-primary">{{ $buttonLabel }}</button></a>
				@endisset
			</div>
		</div>
	</div>
</header>