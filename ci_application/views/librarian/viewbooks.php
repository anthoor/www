<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of <?= $toggle ?> Books</h3>
	</div>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th>Book</th>
			<th>Authors</th>
			<th>Publisher</th>
			<th>Count</th>
		</tr>
		</thead>
		<tbody>
		<?php while( $book = $books->unbuffered_row() ): ?>
			<tr>
				<td><?php echo $book->title." - Ed. ".$book->edition." (".$book->year.")"; ?></td>
				<td><?php echo $authors[$book->id]; ?></td>
				<td><?php echo $book->pub; ?></td>
				<td align="center"><?php echo $book->count; ?></td>
			</tr>
		<?php endwhile ?>
		</tbody>
	</table>
	<div style="height:50px;"> &nbsp; </div>
</div>
<script>
$(document).ready(function(){
	$('#tableid').DataTable();
});
</script>
