<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Suggest A Book</h3>
			</div>
		</div>
		<div>
			<?= form_open('user/suggestaction') ?>
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" id="title" max-length="200" class="form-control"
				value="<?= set_value('title') ?>" placeholder="Book Title" required autofocus />
			</div>
			<div class="form-group">
				<label for="author">Authors</label>
				<input type="text" name="author" id="author" class="form-control"
				value="<?= set_value('author') ?>" placeholder="Comma separated list of authors" required />
			</div>
			<div class="form-group">
				<label for="publisher">Publisher</label>
				<input type="text" name="publisher" id="publisher" max-length="200" class="form-control"
				value="<?= set_value('publisher') ?>" placeholder="Publisher Name" required />
			</div>
			<div class="form-group">
				<label for="edition">Edition</label>
				<input type="number" name="edition" id="edition" min="1" max="999" class="form-control"
				value="<?= set_value('edition') ?>" placeholder="Edition" required />
			</div>
			<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
				<?= validation_errors() ?>
			</div>
			<div align="center">
				<button class="btn btn-success" style="width: 30%;">
					<span class="glyphicon glyphicon-send"></span>&nbsp;
					Suggest Book
				</button>
			</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>