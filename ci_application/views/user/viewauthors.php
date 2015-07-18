<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of Authors</h3>
	</div>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50">Sl No</th>
			<th>Author</th>
			<th>No of Titles</th>
		</tr>
		</thead>
		<tbody>
		<?php $i = 1; ?>
		<?php foreach( $bauthors as $author ): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $author['first_name']." ".$author['middle_name']." ".$author['last_name']; ?></td>
				<td><?php echo $author['count']; ?></td>
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
