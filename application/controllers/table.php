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
		$data['common_drop_database'] = $this->lang->line('common_drop_database');
		$data['common_table_name'] = $this->lang->line('common_table_name');
		$data['common_alter_table'] = $this->lang->line('common_alter_table');
		$data['common_load_data'] = $this->lang->line('common_load_data');
		$data['common_clone_table'] = $this->lang->line('common_clone_table');
		$data['common_table_detail'] = $this->lang->line('common_table_detail');
		$data['common_drop_table'] = $this->lang->line('common_drop_table');
		$data['common_submit'] = $this->lang->line('common_submit');
		$this->load->view('table_detail_list',$data);
		$this->load->view('drop_database_modal', $data);

		#Generate div end
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
}

?>