<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of Publishers</h3>
	</div>
</div>

<div>
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50px">Sl No</th>
			<th>Publisher</th>
			<th>No of Titles</th>
		</tr>
		</thead>
		<tbody>
		{publishers}
			<tr>
				<td></td>
				<td>{name}</td>
				<td>{count}</td>
			</tr>
		{/publishers}
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
