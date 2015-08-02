<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of Authors</h3>
	</div>
</div>

<div>
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50">Sl No</th>
			<th>Author</th>
			<th>No of Titles</th>
		</tr>
		</thead>
		<tbody>
		{bauthors}
			<tr>
				<td></td>
				<td>{first_name} {middle_name} {last_name}</td>
				<td>{count}</td>
			</tr>
		{/bauthors}
		</tbody>
	</table>
	<div style="height:50px;"> &nbsp; </div>
</div>
<script>
$(document).ready(function() {
    var t = $('#tableid').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
        } ],
        "order": [[ 1, 'asc' ]]
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
} );
</script>
