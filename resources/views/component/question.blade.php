<div class="col-12 col-md-6 form-group">
	<label>{{ $slot }}<br></label>
	<select name="question-{{ $index }}" id="" class="custom-select form-control">
		<option value="-1" selected>N/A</option>
		@foreach ($responses as $response)
			<option value="{{ $response }}"{{ old('question-'.$index) == $response ? ' selected' : '' }}>{{ $response }}</option>
		@endforeach
	</select>
</div>