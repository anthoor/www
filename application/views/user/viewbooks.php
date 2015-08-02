<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of {toggle} Books</h3>
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
