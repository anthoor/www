<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of Publishers</h3>
	</div>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50">Sl No</th>
			<th>Publisher</th>
			<th>No of Titles</th>
		</tr>
		</thead>
		<tbody>
		<?php $i = 1; ?>
		<?php foreach( $publishers as $pub ): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $pub['name']; ?></td>
				<td><?php echo $pub['count']; ?></td>
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
