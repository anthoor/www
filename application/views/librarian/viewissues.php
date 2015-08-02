<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title">List of {toggle} Issues</h3>
	</div>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50">Sl No</th>
			<th>Book Title</th>
			<th>Leased By</th>
			<th>Leased On</th>
		</tr>
		</thead>
		<tbody>
		{issues}
			<tr>
				<td></td>
				<td>{title} [{copy_id}]</td>
				<td>{full_name}</td>
				<td>{date}</td>
			</tr>
		{/issues}
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
