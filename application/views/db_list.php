<div class="span2">
<table class="table table-hover">
<?php foreach ($db_list as $item):?>
	<tr>
		<td>
			<i class="icon-zoom-in"></i>
			<a href="/index.php/manage/show_table/">
				<?php echo $item;?>
			</a>
		</td>
	</tr>
<?php endforeach;?>
</table>
</div>