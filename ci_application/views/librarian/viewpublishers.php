<div class="jumbotron">
	<div style="float:left"><img src="<?php echo base_url()."css/logo.png"; ?>" alt="csdl" height="150px" /></div>
	<h1>List of Publishers<br><small>CSE Department Library</small></h1>
</div>

<div class="">
	<table class="table table-bordered table-hover" id="tableid">
		<thead>
		<tr>
			<th width="50">Sl No</th>
			<th>Publisher</th>
			<th>No of Titles</th>
		</tr>
		</thead>
		<tbody>
		<?php $i = 1; ?>
		<?php foreach( $publishers as $pub ): ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $pub['name']; ?></td>
				<td><?php echo $pub['count']; ?></td>
			</tr>
			<?php $i++; ?>
		<?php endforeach ?>
		</tbody>
	</table>
	<div>&nbsp;</div>
</div>
<script>
$(document).ready(function(){
	$('#tableid').DataTable();
});
</script>
