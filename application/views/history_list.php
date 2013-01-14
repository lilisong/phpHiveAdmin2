<div class="span10">

	<table>
		<thead>
			<tr>
				<td><?php echo $common_file_name;?></td>
				<td><?php echo $common_file_content;?></td>
				<td><?php echo $common_file_size;?></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($results as $key => $history):?>
			<tr>
				<?php
				$this->load->model('utilities_model', 'utils');
				$filename = $this->utils->make_filename($history->fingerprint);
				?>
				<td><?php echo $filename['out'];?></td>
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

</div>