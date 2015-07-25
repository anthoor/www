<div class="jumbotron">
	<div style="float:left"><img src="<?= base_url()."css/logo.png" ?>" alt="csdl" height="100px" /></div>
	<h2>Login<br><small> CSE Department Library</small></h2>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="">
			
			<?= form_open('login/verifylogin') ?>
				<div class="form-group">
					<label for="username">Username</label> <input type="text"
						name="username" id="username" class="form-control"
						value="<?= set_value('username') ?>"
						placeholder="Username" maxlength="50" required autofocus />
				</div>
				<div class="form-group">
					<label for="password">Password</label> <input type="password"
						name="password" id="password" class="form-control"
						value="<?= set_value('password') ?>"
						placeholder="Password" maxlength="32" required />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?= validation_errors() ?>
				</div>
				<button class="btn btn-success" style="width: 100%;">Login</button>
			</form>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>