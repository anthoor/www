
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add Book Copies</h3>
			</div>
		</div>
		<div class="">
			<?php echo form_open('/librarian/addcopyaction'); ?>
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
						value="<?php echo set_value('copies'); ?>" required
						min="1" placeholder="Number of New Copies" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?php echo validation_errors(); ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">Add Copies</button>
					<button class="btn btn-danger" style="width: 30%;">Clear</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>