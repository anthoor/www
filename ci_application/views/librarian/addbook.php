<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="">
			<?php echo form_open('/librarian/addbookaction'); ?>
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control"
						value="<?php echo set_value('title'); ?>"
						placeholder="Book Title" />
				</div>
				<div class="form-group">
					<label for="publisher">Publisher</label>
					<input type="text" name="publisher" id="publisher" class="form-control"
						value="<?php echo set_value('publisher'); ?>"
						placeholder="Publisher" />
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