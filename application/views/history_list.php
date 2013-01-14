<div class="span10">

	<table class="table table-bordered table-striped table-hover">
		<thead>
			<tr class="success">
				<td><?php echo $common_file_name;?></td>
				<td><?php echo $common_file_content;?></td>
				<td><?php echo $common_file_size;?></td>
			</tr>
		</thead>
		<tbody>
			<?php $this->load->model('utilities_model', 'utils');?>
			<?php foreach($results as $item):?>
			<tr>
				<?php
				//$filename['log_with_path'] = $this->config->item('log_path') . $this->session->userdata('username') . "_" . $item->fingerprint . ".log";
				//$filename['log'] = $this->session->userdata('username') . "_" . $item->fingerprint . ".log";
				
				
				$filename = $this->utils->make_filename($item->fingerprint);
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
				<td><?php echo filesize($filename['log_with_path']);?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
	<div>
		<h3><?php echo $pagination;?></h3>
	</div>
</div>