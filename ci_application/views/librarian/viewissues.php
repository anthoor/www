<div class="jumbotron">
	<div style="float:left"><img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="150px" /></div>
	<h1>List of Issues<small> (<?= $toggle ?>)</small><br><small>CSE Department Library</small></h1>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50">Sl No</th>
			<th>Book Title</th>
			<th>Leased By</th>
			<th>Leased On</th>
		</tr>
		</thead>
		<?php $i = 1; ?>
		<tbody>
		<?php foreach( $issues as $iss ): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $iss['title']." [".$iss['copy_id']."]"; ?></td>
				<td><?= $iss['full_name'] ?></td>
				<td><?= explode(" ", $iss['date'])[0] ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach ?>
		</tbody>
	</table>
	<div>&nbsp;</div>
</div>
<script>
$(document).ready(function(){
	$('#tableid').DataTable();
});
</script>
