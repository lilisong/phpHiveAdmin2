<div class="span10">
	<?php if(count($table_list) != 0):?>

	<a class="btn disabled"><i class=icon-remove></i><?php echo $common_drop_database;?></a>

	<?php else:?>

	<a class="btn btn-danger" href="#drop_database" data-toggle="modal"><i class=icon-remove></i><?php echo $common_drop_database;?></a>

	<?php endif;?>

<br><br>
	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class="info">
				<td>
				<?php echo $common_table_name;?>
				</td>
				<td>
				<?php echo $common_alter_table;?>
				</td>
				<td>
				<?php echo $common_load_data;?>
				</td>
				<td>
				<?php echo $common_clone_table;?>
				</td>
				<td>
				<?php echo $common_table_detail;?>
				</td>
				<td>
				<?php echo $common_drop_table;?>
				</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($table_list as $item):?>
			<tr>
				<td>
				<i class="icon-th-list"></i><a href="<?php echo $this->config->base_url();?>index.php/manage/query/<?php echo $var_db_name;?>/<?php echo $item;?>"><?php echo $item;?></a>
				</td>
				<td>
				<i class="icon-pencil"></i><a href="<?php echo $this->config->base_url();?>index.php/manage/altertable/<?php echo $var_db_name;?>/<?php echo $item;?>"><?php echo $common_alter_table;?></a>
				</td>
				<td>
				<i class="icon-chevron-right"></i><a href="<?php echo $this->config->base_url();?>index.php/manage/loaddata/<?php echo $var_db_name;?>/<?php echo $item;?>"><?php echo $common_load_data;?></a>
				</td>
				<td>
				<i class="icon-random"></i><a href="<?php echo $this->config->base_url();?>index.php/manage/clonetable/<?php echo $var_db_name;?>/<?php echo $item;?>"><?php echo $common_clone_table;?></a>
				</td>
				<td>
				<i class="icon-zoom-in"></i><a href="<?php echo $this->config->base_url();?>index.php/manage/tabledetail/<?php echo $var_db_name;?>/<?php echo $item;?>"><?php echo $common_table_detail;?></a>
				</td>
				<td>
				<i class="icon-remove"></i><a href="<?php echo $this->config->base_url();?>index.php/manage/droptable/<?php echo $var_db_name;?>/<?php echo $item;?>"><?php echo $common_drop_table;?></a>
				</td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>