<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add Author</h3>
			</div>
		</div>
		<div>
			<?= form_open('/librarian/addauthoraction') ?>
				<div class="form-group">
					<label for="fname">First Name</label>
					<input type="text" name="fname" id="fname" class="form-control"
						value="<?= set_value('fname') ?>" required autofocus
						placeholder="First Name" maxlength="50" />
				</div>
				<div class="form-group">
					<label for="mname">Middle Name</label>
					<input type="text" name="mname" id="mname" class="form-control"
						value="<?= set_value('mname') ?>" placeholder="Middle Name"
						maxlength="50" />
				</div>
				<div class="form-group">
					<label for="lname">Last Name</label>
					<input type="text" name="lname" id="lname" class="form-control"
						value="<?= set_value('lname') ?>" required
						placeholder="Last Name" maxlength="50" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">
						<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;
						Add Author
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>