<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Return Book</h3>
			</div>
		</div>
		<div>
			<?= form_open('/librarian/returnbookaction') ?>
				<div class="form-group">
					<label for="issue">Issues</label>
					<select name="issue[]" id="issue" class="form-control" style="height:200px;" multiple required>
						<?php foreach( $issues as $issue ): ?>
							<option value="<?= $issue['id'] ?>">
								<?= $issue['title']." leased by ".$issue['full_name']." [".$issue['copy_id']."]" ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">
						<span class="glyphicon glyphicon-share-alt"></span>&nbsp;
						Return Book
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>