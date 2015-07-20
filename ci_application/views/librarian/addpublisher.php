<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add Publisher</h3>
			</div>
		</div>
		<div class="">
			<?= form_open('/librarian/addpublisheraction') ?>
				<div class="form-group">
					<label for="pname">Publisher Name</label>
					<input type="text" name="pname" id="pname" class="form-control"
						value="<?= set_value('pname') ?>" required autofocus
						placeholder="Publisher Name" maxlength="200" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">Add Publisher</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>