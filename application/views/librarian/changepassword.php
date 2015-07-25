<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Change Password</h3>
	</div>
</div>
<?= form_open('/librarian/changepasswordaction') ?>
<table class="table table-bordered">
	<tr>
		<td rowspan="3" style="vertical-align:middle !important;" width="20%">
			<img src="<?php if($profile['dpfile'] == null){$profile['dpfile'] = "ci.png";} echo base_url()."uploads/".$profile['dpfile']; ?>" style="max-width:200px; max-height:200px;" />
		</td>
		<td colspan="2" style="vertical-align:middle !important;">
			<div class="form-group">
				<label for="opassword">Current Password</label>
				<input type="password" name="opassword" id="opassword" class="form-control" required maxlength="32" />
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="form-group">
				<label for="npassword">New Password</label>
				<input type="password" name="npassword" id="npassword" class="form-control" required maxlength="32" />
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div class="form-group">
				<label for="cpassword">Confirm Password</label>
				<input type="password" name="cpassword" id="cpassword" class="form-control" required maxlength="32" />
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
				<?= validation_errors() ?>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
			<button class="btn btn-warning" style="width: 30%;">Change Password</button>
		</td>
	</tr>
</table>
</form>