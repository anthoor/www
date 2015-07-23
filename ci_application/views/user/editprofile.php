<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Update Profile</h3>
	</div>
</div>
<?= form_open_multipart('/user/editprofileaction') ?>
<table class="table table-bordered">
	<tr>
		<td width="10%" rowspan="3" style="vertical-align:middle !important;">
			<div class="fileinput fileinput-new" data-provides="fileinput">
				<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 200px;">
					Click Here to Change Picture
				</div>
				<div>
					<span class="btn btn-default btn-file fileinput-exists">
						<span class="fileinput-new">Select image</span>
						<span class="fileinput-exists">Change</span>
						<input type="file" name="dp" accept="image/jpeg,image/png,image/gif" />
					</span>
					<a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
				</div>
			</div>
		</td>
		<td width="90%" style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="name">Full Name</label>
				<input type="text" name="name" id="name" value="<?= $profile['full_name'] ?>"
					class="form-control" required autofocus maxlength="200" />
			</div>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="email">E Mail</label>
				<input type="email" name="email" id="email" value="<?= $profile['email'] ?>"
					class="form-control" required maxlength="200" />
			</div>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="number" name="mobile" id="mobile" value="<?= $profile['phone'] ?>"
					class="form-control" required max="999999999999999" />
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
				<?= validation_errors() ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<button class="btn btn-success" style="width: 30%;">Update Profile</button>
		</td>
	</tr>
</table>
</form>