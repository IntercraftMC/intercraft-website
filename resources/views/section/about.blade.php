<section id="about">
	<div class="container">
		@isset($brief)
			<div class="row text-center">
				<div class="col-12 header">
					<h2>About InterCraft</h2>
				</div>
			</div>
		@endisset
		<div class="row">
			<div class="col-12 text-justify">
				<p>InterCraft is a lightly modded Minecraft survival server created and run by software developers. The primary goal is to utilize the central mod, OpenComputers, to build computers, servers, custom software and custom operating systems to form a giant computer network that will essentially become a complete in-game internet.</p>
				@unless(isset($brief))
					<p>InterCraft was founded by college students in the field of Computer Science, each with years of programming and system administration experience.</p>
				@endunless
			</div>
		</div>
		@isset($brief)
			<div class="row">
				<div class="col-12 text-center">
					<a href="about" class="btn btn-primary">Read More</a>
				</div>
			</div>
		@endisset
	</div>
</section>