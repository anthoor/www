<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Update Profile</h3>
	</div>
</div>
<?= form_open('/librarian/editprofileaction') ?>
<table class="table table-bordered">
	<tr>
		<td width="10%" rowspan="3" style="vertical-align:middle !important;"><img src="<?= base_url()."css/ci.png"?>" width="200px" /></td>
		<td width="90%" style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="name">Full Name</label>
				<input type="text" name="name" id="name" value="<?= $profile['full_name'] ?>" class="form-control" required autofocus/>
			</div>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="email">E Mail</label>
				<input type="email" name="email" id="email" value="<?= $profile['email'] ?>" class="form-control" required />
			</div>
		</td>
	</tr>
	<tr>
		<td style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="mobile">Mobile</label>
				<input type="text" name="mobile" id="mobile" value="<?= $profile['phone'] ?>" class="form-control" required />
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