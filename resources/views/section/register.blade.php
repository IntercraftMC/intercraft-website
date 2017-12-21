<section id="join">
	@if(session('registered'))
		<div class="container alert alert-success">
			<div class="row">
				<div class="col-12 text-center">
					<strong>Registration Successful!</strong><br>
					Your InterCraft membership is now complete!
				</div>
			</div>
		</div>
	@else
		<form action="" method="post">
			<div class="container">
				<div class="row">
					<p>Now that you are a member, it is time to complete your registration. To do this, you will need to finish setting up your InterCraft account by filling out the form below.</p>
				</div>
				<div class="row">
					<div class="col-12">
						<h3>Registration Requirements</h3>
						<hr>
					</div>
				</div>
				<ul class="row">
					<li class="col-12 col-md-6">
						<p>Username must be between 3 and 16 characters (inclusive)</p>
					</li>
					<li class="col-12 col-md-6">
						<p>Username may only contain lower case letters a-z, underscores, dashes and numbers</p>
					</li>
					<li class="col-12 col-md-6">
						<p>Password must be at least 8 characters long</p>
					</li>
				</ul>
				<div class="row">
					<div class="col-12">
						<h3>Account Registration</h3>
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="email">Email Address</label>
						<input class="form-control form-control-danger" type="email" name="email" required value="{{ old('email') }}" >
						{!! error($errors->first('email')) !!}
					</div>
					<div class="col-12 col-md-6 form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="username">InterCraft Username</label>
						<input class="form-control form-control-danger" type="text" name="username" required maxlength="16" value="{{ old('username') }}" >
						{!! error($errors->first('username')) !!}
					</div>
					<div class="col-12 col-md-6 form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="password">Password</label>
						<input class="form-control form-control-danger" type="password" name="password" required>
						{!! error($errors->first('password')) !!}
					</div>
					<div class="col-12 col-md-6 form-group{{ $errors->has('repassword') ? ' has-danger' : '' }}">
						<label class="form-control-label" for="repassword">Repeat Password</label>
						<input class="form-control form-control-danger" type="password" name="repassword" required>
						{!! error($errors->first('repassword')) !!}
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<hr>
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
