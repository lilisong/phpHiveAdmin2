<?php

class Table extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Index($db_name = 'default')
	{
		#Generate Header
		$this->lang->load('commons', 'chinese');
		$this->lang->load('errors', 'chinese');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		
		#Generate Navigation top bar
		$data['common_hql_query'] = $this->lang->line('common_hql_query');
		$data['common_etl'] = $this->lang->line('common_etl');
		$data['common_cluster_status'] = $this->lang->line('common_cluster_status');
		$data['common_hdfs_browser'] = $this->lang->line('common_hdfs_browser');
		$data['common_meta_summury'] = $this->lang->line('common_meta_summury');
		$data['common_history'] = $this->lang->line('common_history');
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$this->load->view('nav_bar',$data);

		#Generate div container
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');

		#Generate left table list on left area
		$this->load->model('hive_model','hive');
		$data['db_list'] = $this->hive->show_databases();
		$data['table_list'] = array_reverse($this->hive->show_tables($db_name));
		$data['var_db_name'] = $db_name;
		$this->load->view('db_list',$data);
		
		#Generate table detail list on right area
		$data['common_drop_database_confirm'] = $this->lang->line('common_drop_database_confirm');
		$data['common_close'] = $this->lang->line('common_close');
		$data['common_drop_database'] = $this->lang->line('common_drop_database');
		$data['common_table_name'] = $this->lang->line('common_table_name');
		$data['common_alter_table'] = $this->lang->line('common_alter_table');
		$data['common_load_data'] = $this->lang->line('common_load_data');
		$data['common_clone_table'] = $this->lang->line('common_clone_table');
		$data['common_table_detail'] = $this->lang->line('common_table_detail');
		$data['common_drop_table'] = $this->lang->line('common_drop_table');
		$data['common_submit'] = $this->lang->line('common_submit');
		$data['common_add_table'] = $this->lang->line('common_add_table');
		$data['common_field_numbers'] = $this->lang->line('common_field_numbers');
		$data['common_table_comment'] = $this->lang->line('common_table_comment');
		$data['common_partition_numbers'] = $this->lang->line('common_partition_numbers');
		$data['common_blank_for_no_partition'] = $this->lang->line('common_blank_for_no_partition');
		$data['common_table_type'] = $this->lang->line('common_table_type');
		$data['common_external'] = $this->lang->line('common_external');
		$data['common_managed'] = $this->lang->line('common_managed');
		$data['common_index_table'] = $this->lang->line('common_index_table');
		$data['common_virtual_view'] = $this->lang->line('common_virtual_view');
		$data['type'] = array('string'=>'String','tinyint'=>'Tiny int(3)','smallint'=>'Small int(5)','int'=>'Int(10)','bigint'=>'Big int(19)','double'=>'Double',
						'map'=>'Map','structs'=>'Structs','arrays'=>'Arrays',
						'float'=>'Float','boolean'=>'Boolean');
		
		$this->load->view('table_detail_list',$data);
		$this->load->view('drop_database_modal', $data);
		
		$data['error_invalid_column_numbers'] = $this->lang->line('error_invalid_column_numbers');
		$data['error_invalid_partition_numbers'] = $this->lang->line('error_invalid_partition_numbers');
		$this->load->view('create_table_modal', $data);

		#Generate div end
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
	
	public function CreateTable()
	{
		#Generate Header
		$this->lang->load('commons', 'chinese');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		
		#Generate Navigation top bar
		$data['common_hql_query'] = $this->lang->line('common_hql_query');
		$data['common_etl'] = $this->lang->line('common_etl');
		$data['common_cluster_status'] = $this->lang->line('common_cluster_status');
		$data['common_hdfs_browser'] = $this->lang->line('common_hdfs_browser');
		$data['common_meta_summury'] = $this->lang->line('common_meta_summury');
		$data['common_history'] = $this->lang->line('common_history');
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$this->load->view('nav_bar',$data);

		#Generate div container
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');

		#Generate left table list on left area
		$this->load->model('hive_model','hive');
		$data['db_list'] = $this->hive->show_databases();
		
		$this->load->view('db_list',$data);
		
		$data['var_db_name'] = $this->input->post('db_name');
		$data['table_name'] = $this->input->post('table_name');
		$data['cols_num'] = $this->input->post('cols_num');
		$data['table_comment'] = $this->input->post('table_comment');
		$data['partitions_num'] = $this->input->post('partitions_num');
		$data['external'] = $this->input->post('external');
		
		$data['common_submit'] = $this->lang->line('common_submit');
		$data['common_cancel'] = $this->lang->line('common_cancel');
		$data['common_column_name'] = $this->lang->line('common_column_name');
		$data['common_column_type'] = $this->lang->line('common_column_type');
		$data['common_partition_name'] = $this->lang->line('common_partition_name');
		$data['common_partition_type'] = $this->lang->line('common_partition_type');
		$data['common_comment'] = $this->lang->line('common_comment');
		$data['common_add_table'] = $this->lang->line('common_add_table');
		$data['type'] = array('string'=>'String','tinyint'=>'Tiny int(3)','smallint'=>'Small int(5)','int'=>'Int(10)','bigint'=>'Big int(19)','double'=>'Double',
						'map'=>'Map','structs'=>'Structs','arrays'=>'Arrays',
						'float'=>'Float','boolean'=>'Boolean');
		$data['common_if_external_path'] = $this->lang->line('common_if_external_path');
		$data['common_column_terminator'] = $this->lang->line('common_column_terminator');
		$data['common_line_terminator'] = $this->lang->line('common_line_terminator');
		$data['data_format'] = array('text'=>'Text', 'lzo' => 'Lzo', 'gzip'=> 'Gzip', 'bzip2' => 'Bzip2', 'sequence' => 'Sequence', 'rcfile' => 'RCFile');
		$data['common_data_format'] = $this->lang->line('common_data_format');
		
		$this->load->view('create_table_form', $data);
		
		#Generate div end
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
	
	public function CreateTableAction()
	{
		$this->load->model('hive_model', 'hive');
		
		$db_name = $this->input->post('db_name');
		$tbl_name = $this->input->post('tbl_name');
		$tbl_comment = $this->input->post('tbl_comment');
		
		$cols_name = $this->input->post('cols_name');
		$cols_type = $this->input->post('cols_type');
		$cols_comment = $this->input->post('cols_comment');
		
		$part_name = $this->input->post('part_name');
		$part_type = $this->input->post('part_type');
		$part_comment = $this->input->post('part_comment');
		
		$location = $this->input->post('location');
		$cols_term = addslashes($this->input->post('cols_term'));
		$line_term = addslashes($this->input->post('line_term'));
		$data_format = $this->input->post('data_format');
		$external = $this->input->post('external');
		
		$data = $this->input->post(null, FALSE);
		//var_dump($data);
		echo $this->hive->create_table($db_name, $tbl_name, $tbl_comment, $cols_name, $cols_type, $cols_comment, 
								$part_name, $part_type, $part_comment,
								$external, $data_format, $line_term, $cols_term,
								$location);
								
		$this->load->helper('url');
		redirect($this->config->base_url() . "index.php/table/index/".$db_name, "3", "refresh");
	}
	
	public function DropTable($db_name, $tbl_name)
	{
		$this->load->model('hive_model', 'hive');
		echo "Drop: " . $db_name . " . " . $tbl_name;
		echo $this->hive->drop_table($db_name, $tbl_name);
		$this->load->helper('url');
		redirect($this->config->base_url() . "index.php/table/index/".$db_name, "3", "refresh");
	}
	
	public function TableDetailInfo($db_name, $tbl_name)
	{
		$this->load->model('hive_model', 'hive');
		
		#Generate Header
		$this->lang->load('commons', 'chinese');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		
		#Generate Navigation top bar
		$data['common_hql_query'] = $this->lang->line('common_hql_query');
		$data['common_etl'] = $this->lang->line('common_etl');
		$data['common_cluster_status'] = $this->lang->line('common_cluster_status');
		$data['common_hdfs_browser'] = $this->lang->line('common_hdfs_browser');
		$data['common_meta_summury'] = $this->lang->line('common_meta_summury');
		$data['common_history'] = $this->lang->line('common_history');
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$this->load->view('nav_bar',$data);

		#Generate div container
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');

		#Generate left table list on left area
		$data['db_list'] = $this->hive->show_databases();
		
		$this->load->view('db_list',$data);
		
		$data['var_db_name'] = $db_name;
		$data['table_name'] = $tbl_name;
		
		$data['cols'] = $this->hive->get_table_detail($db_name, $tbl_name, 'cols');
		$data['partitionKeys'] =  $this->hive->get_table_detail($db_name, $tbl_name, 'partitionKeys');
		#$data['bucketCols'] = $this->hive->get_table_detail($db_name, $tbl_name, 'bucketCols');
		#$data['sortCols'] = $this->hive->get_table_detail($db_name, $tbl_name, 'sortCols');
		$data['properties'] = $this->hive->get_table_detail($db_name, $tbl_name, 'properties');
		
		$data['common_column_name'] = $this->lang->line('common_column_name');
		$data['common_column_type'] = $this->lang->line('common_column_type');
		$data['common_partition_name'] = $this->lang->line('common_partition_name');
		$data['common_partition_type'] = $this->lang->line('common_partition_type');
		$data['common_comment'] = $this->lang->line('common_comment');
		$data['common_detailed_name'] = $this->lang->line('common_detailed_name');
		$data['common_detailed_type'] = $this->lang->line('common_detailed_type');
		$data['common_back'] = $this->lang->line('common_back');
		
		$this->load->view('table_detail_info', $data);
		
		#Generate div end
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
	
	public function CloneTable()
	{
		$db_name = $this->input->post('db_name');
		$tbl_name = $this->input->post('tbl_name');
		$new_tbl_name = $this->input->post('new_tbl_name');
		$external = $this->input->post('external');
		if($external == "EXTERNAL_TABLE")
		{
			$external = TRUE;
		}
		else
		{
			$external = FALSE;
		}
		
		$this->load->model('hive_model', 'hive');
		
		echo $this->hive->clone_table($db_name, $new_tbl_name, $tbl_name, $external);
		$this->load->helper('url');
		redirect($this->config->base_url() . "index.php/table/index/".$db_name, "3", "refresh");
	}
}

?>