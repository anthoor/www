<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of <?= $toggle ?> Issues</h3>
	</div>
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
				<td><?= $i ?></td>
				<td><?= $iss['title']." [".$iss['copy_id']."]" ?></td>
				<td><?= $iss['full_name'] ?></td>
				<td><?= explode(" ", $iss['date'])[0] ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach ?>
		</tbody>
	</table>
	<div style="height:50px;"> &nbsp; </div>
</div>
<script>
$(document).ready(function(){
	$('#tableid').DataTable();
});
</script>
