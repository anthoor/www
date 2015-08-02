<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Renew Book</h3>
			</div>
		</div>
		<div>
			<?= form_open('/librarian/renewbookaction') ?>
				<div class="form-group">
					<label for="issue">Issues</label>
					<select name="issue[]" id="issue" class="form-control" style="height:200px;" multiple required>
						{issues}
							<option value="{id}">
								{title} leased by {full_name} [{copy_id}]
							</option>
						{/issues}
					</select>
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">
						<span class="glyphicon glyphicon-repeat"></span>&nbsp;
						Renew Book
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>