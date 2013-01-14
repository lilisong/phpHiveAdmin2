<div class="span10">

	<table class="table table-bordered table-striped table-condensed">
		<thead>
			<tr class="info">
				<td><?php echo $common_file_property;?></td>
				<td><?php echo $common_file_user;?></td>
				<td><?php echo $common_file_group;?></td>
				<td><?php echo $common_file_size;?></td>
				<td><?php echo $common_file_time;?></td>
				<td><?php echo $common_file_name;?></td>
			</tr>
		</thead>
		<tbody>
			<?php for($i = 1; $i <= count($hdfs_matrix['file_name']); $i++):?>
			<tr>
				<td><?php echo $hdfs_matrix['file_property'][$i];?></td>
				<td><?php echo $hdfs_matrix['file_user'][$i];?></td>
				<td><?php echo $hdfs_matrix['file_group'][$i];?></td>
				<td><?php echo $hdfs_matrix['file_size'][$i];?></td>
				<td><?php echo $hdfs_matrix['file_time'][$i];?></td>
				<td><a href="<?php echo $this->config->base_url();?>index.php/hdfs/index/<?php echo base64_encode( $hdfs_matrix['file_name'][$i]);?>"><?php echo $hdfs_matrix['file_name'][$i];?></a></td>
			</tr>
			<?php endfor;?>
		</tbody>
	</table>

</div>