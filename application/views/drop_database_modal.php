<div id="drop_database" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel">删除数据库</h3>
	</div>
	<div class="modal-body">

			是否确认删除数据库 <?php echo $var_db_name;?>？

	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">Close</button>
		<a class="btn btn-danger" href="<?php echo $this->config->base_url() . "index.php/hive/dropdatabase/" . $var_db_name;?>"><?php echo $common_submit;?></a>
	</div>
</div>