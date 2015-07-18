<div class="row" style="margin-top:-9px;">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add Book</h3>
			</div>
		</div>
		<div class="">
			<?php echo form_open('/librarian/addbookaction'); ?>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control"
						value="<?php echo set_value('title'); ?>" required autofocus
						placeholder="Book Title" />
				</div>
				<div class="form-group">
					<label for="authors">Authors</label>
					<select name="authors[]" id="authors" class="form-control" multiple required>
						<?php foreach( $bauthors as $author ) : ?>
							<option value="<?= $author['id'] ?>">
								<?= $author['first_name']." ".$author['middle_name']." ".$author['last_name'] ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="edition">Edition</label>
					<input type="number" name="edition" id="edition" class="form-control"
						value="<?php echo set_value('edition'); ?>" required
						min="1" placeholder="Book Edition" />
				</div>
				<div class="form-group">
					<label for="year">Year</label>
					<input type="number" name="year" id="year" class="form-control"
						value="<?php echo set_value('year'); ?>" required
						min="1000" placeholder="Year of Publication" />
				</div>
				<div class="form-group">
					<label for="publisher">Publisher</label>
					<select name="publisher" id="publisher" class="form-control">
						<?php foreach( $publishers as $publisher ) : ?>
							<option value="<?= $publisher['id'] ?>"><?= $publisher['name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?php echo validation_errors(); ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">Add Book</button>
					<button class="btn btn-danger" style="width: 30%;">Clear</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>