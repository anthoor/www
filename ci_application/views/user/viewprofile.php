<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Profile</h3>
	</div>
</div>

<table class="table table-bordered">
	<tr>
		<td width="10%" rowspan="3"><img src="<?php if($profile['dpfile'] == null){$profile['dpfile'] = "ci.png";} echo base_url()."uploads/".$profile['dpfile']; ?>" style="max-width:200px; max-height:200px;" /></td>
		<td width="90%" colspan="2"><strong>Full Name: </strong><?= $profile['full_name'] ?></td>
	</tr>
	<tr>
		<td width="45%"><strong>User Name: </strong><?= $profile['name'] ?></td>
		<td width="45%"><strong>E Mail: </strong><?= $profile['email'] ?></td>
	</tr>
	<tr>
		<td><strong>Profile Type: </strong><?=$profile['type'] ?></td>
		<td><strong>Mobile: </strong><?= $profile['phone'] ?></td>
	</tr>
</table>