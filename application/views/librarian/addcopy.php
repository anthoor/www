
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add Book Copies</h3>
			</div>
		</div>
		<div>
			<?= form_open('/librarian/addcopyaction') ?>
				<div class="form-group">
					<label for="title">Title</label>
					<select name="title" id="title" class="form-control">
						<?php $bbooks = $books->result_array(); ?>
						<?php foreach( $bbooks as $book ) : ?>
							<option value="<?= $book['id'] ?>" title="<?= $authors[$book['id']] ?>">
								<?= $book['title']." [".$book['pub'].", Ed. ".$book['edition'].", ".$book['year']."]" ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="copies">Number of Copies</label>
					<input type="number" name="copies" id="copies" class="form-control"
						value="<?= set_value('copies') ?>" required
						min="1" max="20" maxlength="2" placeholder="Number of New Copies" />
				</div>
				<div class="form-group">
					<label for="shelf">Shelf Name</label>
					<input type="text" name="shelf" id="shelf" class="form-control"
						value="<?= set_value('shelf') ?>" required
						maxlength="1" placeholder="Shelf in which copies are placed" />
				</div>
				<div class="form-group">
					<label for="row">Row ID</label>
					<input type="number" name="row" id="row" class="form-control"
						value="<?= set_value('row') ?>" required
						min="1" max="9" maxlength="1" placeholder="Row in which copies are placed" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">Add Copies</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>