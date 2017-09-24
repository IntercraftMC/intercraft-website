<section id="join">
	@if(session('signup'))
		<div class="container alert alert-success">
			<div class="row">
				<div class="col-12 text-center">
					<strong>Application sent successfully!</strong><br>
					An email has been sent to your email address with the final application steps.
				</div>
			</div>
		</div>
	@else
		<form action="" method="post">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h3>General Rules and Guidelines</h3>
						<hr>
					</div>
				</div>
				<ul class="row">
					<li class="col-12 col-md-6">
						<p>Do not share the server's seed with anyone</p>
					</li>
					<li class="col-12 col-md-6">
						<p>Do not distribute any backups or copies of the server</p>
					</li>
					<li class="col-12 col-md-6">
						<p>Do not take anything from other players without permission</p>
					</li>
					<li class="col-12 col-md-6">
						<p>Do not harass other players</p>
					</li>
					<li class="col-12 col-md-6">
						<p>Images posted on the gallery must come from the InterCraft survival/creative server</p>
					</li>
				</ul>
				<div class="row">
					<div class="col-12">
						<h3>Apply to Join</h3>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 form-group{{ $errors->has('email') ? ' has-danger' : ''}}">
						<label class="form-control-label" for="email">Email address</label>
						<input class="form-control form-control-danger" type="text" name="email" required value="{{ old('email') }}">
						{!! error($errors->first('email')) !!}
					</div>
					<div class="col-12 col-md-6 form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="username">Minecraft Username</label>
						<input class="form-control form-control-danger" type="text" name="username" required maxlength="16" value="{{ old('username') }}" >
						{!! error($errors->first('username')) !!}
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-12 form-check{{ $errors->has('age') ? ' has-danger' : '' }}">
						<label class="form-check-label">
							<!-- <input type="checkbox" name="age" id="age" value="yes" class="form-check-input"> -->
							<input class="form-check-input" type="checkbox" name="age" value="yes">
							I am at least 15 years of age
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<h4>Optional Questionnaire</h4>
						<hr>
					</div>
				</div>
				<div class="row">
					@foreach ($questions as $question)
						@component("component.question", ["responses" => $question[1]])
							@slot('index') {{ $loop->index }} @endslot
							{{ $question[0] }}
						@endcomponent
					@endforeach
				</div>
				<div class="row">
					<div class="col-12">
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-12 form-group{{ $errors->has('g-recaptcha-response') ? ' has-danger' : ''}}">
						{!! captcha() !!}
						{!! error($errors->first('g-recaptcha-response')) !!}
					</div>
				</div>
				<div class="row">
					<div class="col-12 form-group">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	@endif
</section>