<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of Suggested Books</h3>
	</div>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th>Book</th>
			<th>Authors</th>
			<th>Publisher</th>
			<th>Suggested By</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach( $suggestions as $suggestion ): ?>
			<tr>
				<td><?= $suggestion['title']." - Ed. ".$suggestion['edition'] ?></td>
				<td><?= $suggestion['authors'] ?></td>
				<td><?= $suggestion['publisher'] ?></td>
				<td><?= $suggestion['name'] ?></td>
			</tr>
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
