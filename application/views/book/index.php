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
		{books}
			<tr>
				<td>{btitle} - Ed. {edition} [{copyid}]</td>
				<td>{authors}</td>
				<td>{pub}</td>
				<td>{shelf}/{row}</td>
			</tr>
		{/books}
		</tbody>
	</table>
	<div style="height:50px;"> &nbsp; </div>
</div>
<script>
$(document).ready(function(){
	$('#tableid').DataTable();
});
</script>