<div class="span10">

	<a href="#create_user" class="btn btn-primary" data-toggle="modal"><?php echo $common_add_user;?></a>
	<br>
	<table>
		<?php foreach($user_list as $row):?>
		<tr>
			<td><?php echo $row->username;?></td>
			<td><?php echo $row->role;?></td>
			<td><?php echo $row->description;?></td>
			<td><?php echo $row->role;?></td>
			<td><a href="#update_user_<?php echo $row->id;?>" class="btn"><?php echo $common_update_user;?></a></td>
			<td><a href="<?php echo $this->config->base_url();?>index.php/user/dropuseraction/<?php echo $row->id;?>"><?php echo $common_drop_user;?></a></td>
		</tr>
		<?php endforeach;?>
	</table>

</div>