<div class="jumbotron">
	<div style="float:left"><img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="150px" /></div>
	<h1>List of Books<small> (Available)</small><br><small>CSE Department Library</small></h1>
</div>
<div class="">
	<table class="table table-bordered table-striped" id="tableid">
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
	<div> &nbsp; </div>
</div>
<script>
$(document).ready( function() {
	$('#tableid').DataTable();
});
</script>