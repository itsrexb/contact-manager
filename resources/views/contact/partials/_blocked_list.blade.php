<h5>Blocked List</h5>
<div class="form-group input-group">
	<div class="input-group-prepend">
		<label for="block" class="input-group-text">
			<select class="block-type" name="block[type]" id="block-type">
				<option value="email">Email</option>
				<option value="mobile">Mobile</option>
				<option value="tel">Tel</option>
			</select>
		</label>
	</div>
	<input type="text" id="block-content" name="block[content]" class="form-control">
	<div class="input-group-append">
	    <button class="input-group-text" id="btn-add-blocked">ADD</button>
	</div>
</div>
<ul class="list-group" id="block-list"></ul>