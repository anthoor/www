<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Remove User</h3>
			</div>
		</div>
		<div>
			<?php if( $users ) { ?>
			<?= form_open('/librarian/removeuseraction') ?>
				<div class="form-group">
					<label for="user">User</label>
					<select name="user" id="user" class="form-control">
						<?php foreach( $users as $user ) : ?>
							<option value="<?= $user['id'] ?>"><?= $user['full_name']." (".$user['name'].")" ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<div align="center">
					<button class="btn btn-danger" style="width: 30%;">Remove User</button>
				</div>
			</form>
			<?php } else { ?>
				<div align="center"><h4> No Active Users! </h4></div>
			<?php } ?>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<div style="height:50px;"> &nbsp; </div>