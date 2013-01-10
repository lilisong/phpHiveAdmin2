<script>

function QueryStatus()
{
	var filename = document.getElementById('run_file').value;
	$.post('<?php echo $this->config->base_url();?>index.php/manage/getquerystatus/', {run_file:filename}, function(html){
		html = html;
		$('#sql_query_status').html(html);
	});
}

function RefreshStatus()
{
	setInterval(QueryStatus,1000);
}

</script>

<div id="sql_query_status_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h3 id="myModalLabel"><?php echo $var_db_name;?></h3>
	</div>
	<div class="modal-body">

			<div id="sql_query_status">
			</div>
			<input type="hidden" id="run_file" value="">

	</div>
	<div class="modal-footer">
		<a href="" class="btn"><?php echo $common_cli_done;?></a>
		<a href="#" class="btn btn-primary" onclick="RefreshStatus()"><?php echo $common_submit;?></a>
	</div>
</div>