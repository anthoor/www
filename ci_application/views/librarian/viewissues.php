<div class="jumbotron">
	<div style="float:left"><img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="150px" /></div>
	<h1>List of Issues<small> (<?= $toggle ?>)<br><small>CSE Department Library</small></h1>
</div>

<div class="">
	<table class="table table-bordered table-hover">
		<tr>
			<th width="50">Sl No</th>
			<th>Book Title</th>
			<th>Leased By</th>
			<th>Leased On</th>
		</tr>
		<?php $i = 1; ?>
		<?php foreach( $issues as $iss ): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $iss['title']." [".$iss['copy_id']."]"; ?></td>
				<td><?= $iss['full_name'] ?></td>
				<td><?= $iss['date'] ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach ?>
	</table>
	<div>&nbsp;</div>
</div>