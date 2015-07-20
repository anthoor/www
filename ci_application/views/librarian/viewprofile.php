<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">Profile</h3>
	</div>
</div>

<table class="table table-bordered">
	<tr>
		<td width="10%" rowspan="3"><img src="<?= base_url()."css/ci.png"?>" width="200px" /></td>
		<td width="90%" colspan="2" style="vertical-align:middle !important;"><strong>Full Name: </strong><?= $profile['full_name'] ?></td>
	</tr>
	<tr>
		<td width="45%" style="vertical-align:middle !important;"><strong>User Name: </strong><?= $profile['name'] ?></td>
		<td width="45%" style="vertical-align:middle !important;"><strong>E Mail: </strong><?= $profile['email'] ?></td>
	</tr>
	<tr>
		<td style="vertical-align:middle !important;"><strong>Profile Type: </strong><?=$profile['type'] ?></td>
		<td style="vertical-align:middle !important;"><strong>Mobile: </strong><?= $profile['phone'] ?></td>
	</tr>
</table>