<div class="jumbotron">
	<div style="float:left"><img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="150px" /></div>
	<h1>CSE Department Library <small>csdl.mitkannur.ac.in</small></h1>
</div>
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="">
			
			<?php echo form_open('login/verifylogin'); ?>
				<div class="form-group">
					<label for="username">Username</label> <input type="text"
						name="username" id="username" class="form-control"
						value="<?php echo set_value('username'); ?>"
						placeholder="Username" />
				</div>
				<div class="form-group">
					<label for="password">Password</label> <input type="password"
						name="password" id="password" class="form-control"
						value="<?php echo set_value('password'); ?>"
						placeholder="Password" />
				</div>
				<div style="color:#f00 !important; font-size:14px !important; font-weight:bold !important;">
					<?php echo validation_errors(); ?>
				</div>
				<button class="btn btn-success" style="width: 100%;">Login</button>
			</form>
		</div>
	</div>
	<div class="col-md-4"></div>
</div>