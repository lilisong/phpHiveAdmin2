<div class="container">
	<h2>phpHiveAdmin 0.10 beta 1 - BlackWingLair</h2>
	<form class="form-horizontal" method="post" action="<?php echo $this->config->base_url();?>index.php/user/loginaction/">
		<div class="control-group">
			<label class="control-label"><?php echo $common_username;?></label>
			<div class="controls">
				<input type="text" name="username" placeholder="<?php echo $common_username;?>">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label"><?php echo $common_password;?></label>
			<div class="controls">
				<input type="password" name="password" placeholder="<?php echo $common_password;?>">
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn"><?php echo $common_submit;?></button>
			</div>
		</div>
		<input type="hidden" name="referer" value="<?php echo $this->agent->referrer();?>" />
	</form>
</div>