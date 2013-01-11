<script>

function SqlQuery()
{
	$('#query_submit').addClass('disabled');
	$('#query_submit').attr('href','#');
	$.post('<?php echo $this->config->base_url();?>index.php/manage/sqlquery/' , {sql:$('#sql').val(), finger_print:$('#finger_print').val()}, function(html){
		html = html;
		$('#sql_query_status').html(html);
	});
}

function QueryStatus()
{
	$.post('<?php echo $this->config->base_url();?>index.php/manage/getquerystatus/', { finger_print:$('#finger_print').val() }, function(html){
		html = html;
		$('#sql_query_status').html('<small>' + html + '</small>');
	});
	
	/*$.getJSON('<?php echo $this->config->base_url();?>index.php/manage/getquerystatusjson/' + $('#finger_print').val(), { }, function(json){
		json = json;
		var map_per = json.map_percent;
		var reduce_per = json.reduce_percent;
		$('#sql_query_status').html('<small>' + html + '</small>');
	});*/
}

function RefreshStatus(ctrl)
{
	if(ctrl == true)
	{
		self.timer = setInterval(QueryStatus,2000);
	}
	else
	{
		clearInterval(self.timer);
	}
}

function GetResult()
{
	var finger_print = document.getElementById('finger_print').value;
	var href = '<?php echo $this->config->base_url();?>index.php/manage/getresult/' + finger_print;
	window.location = href;
}

function ConfirmClose()
{
	var confirm = window.confirm("请确认查询完成后离开本页");
	if(confirm)
	{
		GetResult();
	}
	else
	{
		return false;
	}
}

</script>

<div id="sql_query_status_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="RefreshStatus(false)">&times;</button>-->
		<h3 id="myModalLabel"><?php echo $var_db_name;?>.<?php echo $table_name;?></h3>
	</div>
	<div class="modal-body">

			<div id="sql_query_status">
			</div>
			<input type="hidden" id="finger_print" value="">

	</div>
	<div class="modal-footer">
		<a href="#" class="btn" onclick="ConfirmClose()"><?php echo $common_cli_done;?></a>
		<a href="javascript:SqlQuery();RefreshStatus(true);" id="query_submit" class="btn btn-primary"><?php echo $common_submit;?></a>
	</div>
</div>