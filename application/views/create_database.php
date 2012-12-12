<div class="span4">
<img src="/img/phphiveadmin.jpg" />
<br>
<br>
<form method=post action=<?php echo $this->config->base_url();?>index.php/manage/add_database>
	<table class="table-bordered table-striped table-hover">
		<tr>
			<td>
				<?php echo $common_add_database;?>
			</td>
			<td>
				<input type=text name=newdbname>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $common_comment;?>
			</td>
			<td>
				<input type=text name=newdbcomment>
			</td>
		</tr>
</table><br>
<input type=submit name=submit class="btn btn-primary btn-small" value=<?php echo $common_submit;?>>
</form>
<br><br>
<form method=post action=<?php echo $this->config->base_url();?>index.php/manage/add_database>
	<table class="table-bordered table-striped table-hover">
		<tr>
			<td>
				<?php echo $common_add_schema;?>
			</td>
			<td>
				<input type=text name=newschemaname>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $common_comment;?>
			</td>
			<td>
				<input type=text name=newschemacomment>
			</td>
		</tr>
</table><br>
<input type=submit name=submit class="btn btn-primary btn-small" value=<?php echo $common_submit;?>>
</form>
</div>