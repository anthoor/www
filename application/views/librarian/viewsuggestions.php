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
		{suggestions}
			<tr>
				<td>{title} - Ed. {edition}</td>
				<td>{authors}</td>
				<td>{publisher}</td>
				<td>{name}</td>
			</tr>
		{/suggestions}
		</tbody>
	</table>
	<div style="height:50px;"> &nbsp; </div>
</div>
<script>
$(document).ready(function(){
	$('#tableid').DataTable();
});
</script>
