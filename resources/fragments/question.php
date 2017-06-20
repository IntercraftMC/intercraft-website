<div class="col-12 col-md-6 form-group">
	<label><?php echo $question; ?><br></label>
	<select name="<?php echo "question-$index"; ?>" id="" class="custom-select form-control">
		<option value="-1" selected>N/A</option>
		<?php for ($i = 0; $i < count($responses); $i++): ?>
			<option value="<?php echo $responses[$i]; ?>"><?php echo $responses[$i]; ?></option>
		<?php endfor; ?>
	</select>
</div>