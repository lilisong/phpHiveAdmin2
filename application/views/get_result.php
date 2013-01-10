<div class="span12">
<input type="button" class="btn btn-success" name=download value="<?php echo $common_download_result;?>" onclick="">

<br><br>

<table class="table table-striped table-hover table-bordered table-condensed">
	<tr class="info">
		<?php foreach ($sql_columns as $k => $v):?>
		<td>
			<?php echo $v;?>
		</td>
		<?php endforeach;?>
	</tr>
	<?php foreach ($data_matrix as $k => $v):?>
	<tr>
		<?php foreach($v as $kk => $vv):?>
		<td>
			<?php echo $vv;?>
		</td>
		<?php endforeach;?>
	</tr>
	<?php endforeach;?>
</table>
</div>