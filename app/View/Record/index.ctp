
<div class="row-fluid">
	<table class="table table-bordered" id="table_records">
		<thead>
			<tr>
				<th>ID</th>
				<th>NAME</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($records as $record):?>
			<tr>
				<td><?php echo $record['Record']['id']?></td>
				<td><?php echo $record['Record']['name']?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
</div>

<!-- Add Pagination Here -->
<nav>
	<ul class="paging pull-right">
		<?php
			echo $this->paginator->prev($title = '<< Previous ', $options = array(), $disabledTitle = null, $disabledOptions = array());
			echo $this->paginator->numbers(array('first' => 2, 'last' => 2));
			echo $this->paginator->next($title = ' Next >>', $options = array(), $disabledTitle = null, $disabledOptions = array());
			// if($paginator->hasPrev()){
			// 	echo $paginator->prev();
			// }
		?>
	</ul>
</nav>

<?php $this->start('script_own')?>
<script>
$(document).ready(function(){
	// Commented this to disable/hide jquery datatable
	// $("#table_records").dataTable({
	//
	// });
})
</script>
<?php $this->end()?>
