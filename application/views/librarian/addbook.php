<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add Book</h3>
			</div>
		</div>
		<div>
			<?= form_open('/librarian/addbookaction') ?>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control"
						value="<?= set_value('title') ?>" required autofocus
						placeholder="Book Title" maxlength="200" />
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
						value="<?= set_value('edition') ?>" required
						min="1" placeholder="Book Edition" max="100" />
				</div>
				<div class="form-group">
					<label for="year">Year</label>
					<input type="number" name="year" id="year" class="form-control"
						value="<?= set_value('year') ?>" required
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
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">Add Book</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<div style="height:50px;"> &nbsp; </div>
<script>
$(document).ready(function(){$("#year").attr({max:(new Date).getFullYear()})});
</script>