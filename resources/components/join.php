<section id="join">
	<?php if($signUp): ?>
		<div class="container alert alert-success">
			<div class="row">
				<div class="col-12 text-center">
					<strong>Application sent successfully!</strong>
				</div>
			</div>
		</div>
	<?php else: ?>
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
					<div class="col-12 col-md-6 form-group <?php echo hasError('email') ? 'has-danger' : ''; ?>">
						<label class="form-control-label" for="email">Email address</label>
						<?php input('email', 'email'); ?>
						<?php echo error('email'); ?>
					</div>
					<div class="col-12 col-md-6 form-group <?php echo hasError('username') ? 'has-danger' : ''; ?>">
						<label class="form-control-label" for="username">Minecraft Username</label>
						<?php input('username', 'username'); ?>
						<?php echo error('username'); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-12 form-check <?php echo hasError('age') ? 'has-danger' : ''; ?>">
						<label class="form-check-label">
							<!-- <input type="checkbox" name="age" id="age" value="yes" class="form-check-input"> -->
							<?php checkBox('age', 'age', 'yes'); ?>
							I am at least 13 years of age
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
					<?php 
					for ($i = 0; $i < count($questions); $i++) {
						$question = $questions[$i];
						$question['index'] = $i;
						fragment('question', $question);
					}
					?>
				</div>
				<div class="row">
					<div class="col-12">
						<hr>
					</div>
				</div>
				<div class="row">
					<div class="col-12 form-group">
						<?php captcha(); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-12 form-group">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</div>
			</div>
		</form>
	<?php endif; ?>
</section>