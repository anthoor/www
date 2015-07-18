
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Mark Copy as Damaged</h3>
			</div>
		</div>
		<div class="">
			<?php echo form_open('/librarian/damagecopyaction'); ?>
				<div class="form-group">
					<label for="copyid">Copy ID</label>
					<input type="number" name="copyid" id="copyid" class="form-control"
						value="<?= set_value('copyid') ?>" required
						placeholder="Copy ID Printed on the Book" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?php echo validation_errors(); ?>
				</div>
				<div align="center">
					<button class="btn btn-danger" style="width: 30%;">Mark Damaged</button>
					<button class="btn btn-default" style="width: 30%;">Clear</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>