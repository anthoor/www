<div class="jumbotron">
	<div style="float:left"><img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="150px" /></div>
	<h1>List of Books<small> (Available)</small><br><small>CSE Department Library</small></h1>
</div>

<div class="">
	<table class="table table-bordered table-hover">
		<tr>
			<th>Book</th>
			<th>Authors</th>
			<th>Publisher</th>
			<th>Count</th>
		</tr>
		<?php while( $book = $books->unbuffered_row() ): ?>
			<tr>
				<td><?php echo $book->title." - Ed. ".$book->edition." (".$book->year.")"; ?></td>
				<td><?php echo $authors[$book->id]; ?></td>
				<td><?php echo $book->pub; ?></td>
				<td align="center"><?php echo $book->count; ?></td>
			</tr>
		<?php endwhile ?>
	</table>
</div>