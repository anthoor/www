<div class="jumbotron">
	<div style="float:left"><img src="<?= base_url()."css/logo.png" ?>" alt="csdl" height="100px" /></div>
	<h2>List of Books<small> (Available)</small><br><small>CSE Department Library</small></h2>
</div>
<div>
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