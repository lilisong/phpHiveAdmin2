<div class="span10">

	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class="success">
			<?php if($this->session->userdata('role') == "admin"):?>
				<td></td>
			<?php endif;?>
				<td><?php echo $common_file_name;?></td>
				<td><?php echo $common_file_content;?></td>
				<td><?php echo $common_file_size;?></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results as $item):?>
			<tr>
			<?php if($this->session->userdata('role') == "admin"):?>
				<td>
					<input type="chechbox" name="history_id[]" value="<?php echo $item->id;?>" />
				</td>
			<?php endif;?>
				<?php
				$filename['log_with_path'] = $this->config->item('log_path') . $item->username . "_" . $item->fingerprint . ".log";
				$filename['log'] = $item->username . "_" . $item->fingerprint . ".log";
				?>
				<td><a href="<?php echo $this->config->base_url();?>index.php/manage/getresult/<?php echo $item->fingerprint;?>" target="_blank"><?php echo $filename['log'];?></td>
				<?php
				$this->load->helper('file');
				try
				{
					$content = read_file($filename['log_with_path']);
				}
				catch (Exception $e)
				{
					echo 'Caught exception: '.  $e->getMessage(), "\n";
				}
				?>
				<td><?php echo $content;?></td>
				<td><?php $this->load->helper('number'); echo byte_format(filesize($filename['log_with_path']));?></td>
			</tr>
			<?php endforeach;?>
			<?php if($this->session->userdata('role') == "admin"):?>
			<tr>
				<td>
					<input type="chechbox" id="chkAll" />
				</td>
				<td></td>
				<td></td>
				<td><button><?php echo $common_delete;?></button></td>
			</tr>
			<?php endif;?>
		</tbody>
	</table>
	<div>
		<h3><?php echo $pagination;?></h3>
	</div>
</div>