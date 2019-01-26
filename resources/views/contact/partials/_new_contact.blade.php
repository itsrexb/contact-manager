<h5>New Contact</h5>

<form id="new-contact-form" method="post" action="">
	@csrf
	<div class="form-group">
		<label for="first-name">First Name</label>
		<input type="text" id="first-name" name="first_name" class="form-control">
	</div>	
	<div class="form-group">
		<label for="last-name">Last Name</label>
		<input type="text" id="last-name" name="last_name" class="form-control">
	</div>
	<div class="info-holder">
		<div class="form-group">
			<label for="info">
				<select class="info-type" name="info[0][type]">
					<option value="email">Email</option>
					<option value="mobile">Mobile</option>
					<option value="tel">Tel</option>
					<option value="fax">Fax</option>
					<option value="work">Work</option>
					<option value="address">Address</option>
					<option value="other">Other</option>
				</select>
				<input type="text" class="custom-info hidden" name="info[0][custom]" placeholder="custom"></span>
			</label>
			<input type="text" id="info" name="info[0][value]" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<button class="new-info btn btn-success btn-sm float-right">+</button>
	</div>
	<div class="form-group">
		<button class="btn btn-primary">SAVE</button>
	</div>
</form>