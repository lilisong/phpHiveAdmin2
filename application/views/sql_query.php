<div class="span10">
<?php echo $var_db_name;?>
<i class=icon-backward></i>  <a href="<?php echo $this->config->base_url();?>index.php/table/index/<?php echo $var_db_name;?>">返回</a>
<br><br>

<div class="btn-group">
<!--<a class="btn" href="sqlQuery.php?database=active&table=active_20121213">
<i class="icon-zoom-in"></i>
SQL查询-->
<!--<td>
<a href="getFilelist.php?database=active&table=active_20121213">
文件列表</a>
</td>
<a class="btn" href="<?php echo $this->config->base_url();?>index.php/manage/LoadData/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-chevron-right></i>
<?php echo $common_load_data;?></a>
<a class="btn" href="<?php echo $this->config->base_url();?>index.php/manage/CloneTable/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-random></i>
<?php echo $common_clone_table;?></a>
<a class="btn" href="<?php echo $this->config->base_url();?>index.php/manage/TableDetail/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-zoom-in></i>
<?php echo $common_table_detail;?></a>
<a class="btn btn-warning" href="<?php echo $this->config->base_url();?>index.php/manage/AlterTable/<?php echo $var_db_name;?>/<?php echo $table_name;?>">
<i class=icon-pencil></i>
<?php echo $common_alter_table;?></a>
<a class="btn btn-danger" href="#">
<i class=icon-remove></i>
<?php echo $common_drop_table;?></a>-->
</div>
<br>
<table class="table table-bordered table-striped table-condensed">
	<tr class="info">
		<?php foreach($column_name as $cname): ?>
			<td><?php echo $cname;?></td>
		<?php endforeach;?>
	</tr>
	<tr class="success">
		<?php foreach($column_type as $ctype): ?>
			<td><?php echo $ctype;?></td>
		<?php endforeach;?>
	</tr>
	<tr class="success">
		<?php foreach($column_comment as $ccomment): ?>
			<td><?php echo $ccomment;?></td>
		<?php endforeach;?>
	</tr>
	<?php foreach($example_data as $key => $value):?>
	<tr>
		<?php foreach($value as $ek => $ev): ?>
		<td><?php echo $ev;?></td>
		<?php endforeach;?>
	</tr>
	<?php endforeach;?>
</table>
<br>


<style type="text/css">    
	ul.auto-list {
	display: none;
	position: absolute;
	top: 0px;
	left: 0px;
	border: 2px solid white;
	background-color: #F5F5F5F5;
	padding: 2;
	margin: 2;
	list-style: none;
	}
	ul.auto-list > li:hover, ul.auto-list > li[data-selected=true] {
	background-color: #01AAD0;
	}
	ul.auto-list > li {
	border: 2px solid #9F9F9F;
	cursor: default;
	padding: 3px;
	font-size: 14px
	}
	{
	font-weight: bold;
	}
	#ta {
	width: 300px;
	height: 100px;
	font-size: 12px;
	font-family: "Helvetica Neue", Arial, sans-serif;
	white-space: pre;
	}
	#sql {width: 500px}
</style>

<script src="<?php echo $this->config->base_url();?>js/auto.js" type="text/javascript"></script>
	<script type="text/javascript">
		var hiveudfs = [];
		function initHiveudfsTextarea() {
			$.ajax("<?php echo $this->config->base_url();?>index.php/manage/GetHiveUdfs/<?php echo $var_db_name;?>/<?php echo $table_name;?>", {
			//$.ajax("js/hiveudfs.txt", {
				success : function(data, textStatus, jqXHR) {
					hiveudfs = data.replace(/\r/g, "").split("\n");
					$("#hiveudf textarea").autocomplete({
						wordCount : 1,
						on : {
							query : function(text, cb) {
								var words = [];
								for (var i = 0; i < hiveudfs.length; i++) {
									if (hiveudfs[i].toLowerCase().indexOf(text.toLowerCase()) == 0)
										words.push(hiveudfs[i]);
									if (words.length > 5)
										break;
								}
								cb(words);
							}
						}
					});
				}
			});
		}
		$(document).ready(function() {
			initHiveudfsTextarea();
		});
		
	function SqlQuery()
	{
		var hsql = document.getElementById('sql').value;
	
		$.post('<?php echo $this->config->base_url();?>index.php/manage/sqlquery/' , {sql:hsql}, function(html){
			html = html;
			$('#run_file').val(html);
			$('#sql_query_status').html(html);
		});
	}
		
	</script>

<form method="post" name="form">
<div id="hiveudf">
<textarea cols="300" rows="9" name="sql" id="sql">select * from <?php echo $var_db_name;?>.<?php echo $table_name;?> limit 30</textarea>
</div>
<br>

<a href="#get_query_plan" data-toggle="modal" class="btn btn-primary" onclick="GetQueryPlan()"><i class=icon-ok></i> <?php echo $common_hql_validator;?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="#sql_query_status_modal" data-toggle="modal" class="btn" onclick="SqlQuery()"><i class="icon-refresh"></i> <?php echo $common_submit;?></a>

</form>

</div>