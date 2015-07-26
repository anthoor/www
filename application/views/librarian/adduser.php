<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title">Add User</h3>
			</div>
		</div>
		<div>
			<?= form_open('/librarian/adduseraction') ?>
				<div class="form-group">
					<label for="name">Name</label>
					<input type="text" name="name" id="name" class="form-control"
						value="<?= set_value('name') ?>" required autofocus
						placeholder="Full Name" maxlength="200" />
				</div>
				<div class="form-group">
					<label for="uname">User Name</label>
					<input type="text" name="uname" id="uname" class="form-control"
						value="<?= set_value('uname') ?>" required autocomplete="off"
						placeholder="User Name" maxlength="50" />
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control"
						value="<?= set_value('password') ?>" required autocomplete="off"
						placeholder="Password" maxlength="32" />
				</div>
				<div class="form-group">
					<label for="type">User Type</label>
					<select name="type" id="type" class="form-control">
						<?php foreach( $types as $type ) : ?>
							<option value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label for="email">E Mail</label>
					<input type="email" name="email" id="email" class="form-control"
						value="<?= set_value('email') ?>" required
						placeholder="user@mitkannur.ac.in" maxlength="200" />
				</div>
				<div class="form-group">
					<label for="mobile">Mobile Number</label>
					<input type="number" name="mobile" id="mobile" class="form-control"
						value="<?= set_value('mobile') ?>" required
						max="999999999999999" placeholder="9876543210" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?php echo validation_errors(); ?>
				</div>
				<div align="center">
					<button class="btn btn-success" style="width: 30%;">
						<span class="glyphicon glyphicon-plus-sign"></span>&nbsp;
						Add User
					</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-md-2"></div>
</div>
<div style="height:50px;"> &nbsp; </div>