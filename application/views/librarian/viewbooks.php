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
			<th>Shelf/Row</th>
		</tr>
		</thead>
		<tbody>
		<?php while( $book = $books->unbuffered_row() ): ?>
			<tr>
				<td><?= $book->title." - Ed. ".$book->edition." [".$book->copyid."]" ?></td>
				<td><?= $authors[$book->id] ?></td>
				<td><?= $book->pub ?></td>
				<td><?= $book->shelf."/".$book->row ?></td>
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
