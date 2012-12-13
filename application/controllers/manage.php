<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function Index()
	{
		#Generate Header
		$this->lang->load('commons', 'chinese');
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
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

		#Generate Database list on left area
		$this->load->model('hive_model','hive');
		$data['db_list'] = $this->hive->show_databases();
		$this->load->view('db_list',$data);

		#Generate add database on right area
		$data['common_add_database'] = $this->lang->line('common_add_database');
		$data['common_add_schema'] = $this->lang->line('common_add_schema');
		$data['common_comment'] = $this->lang->line('common_comment');
		$data['common_submit'] = $this->lang->line('common_submit');
		$this->load->view('create_database',$data);

		#Generate Gauge meters
		$json = json_decode($this->hive->get_cluster_status());
		$data['maxMapTasks'] = $json->maxMapTasks;
		$data['maxReduceTasks'] = $json->maxReduceTasks;
		$data['mapTasks'] = $json->mapTasks;
		$data['reduceTasks'] = $json->reduceTasks;
		$data['common_mr_slots_used'] = $this->lang->line('common_mr_slots_used');
		$data['common_map_slots'] = $this->lang->line('common_map_slots');
		$data['common_reduce_slots'] = $this->lang->line('common_reduce_slots');
		$data['common_using'] = $this->lang->line('common_using');
		$data['common_value'] = $this->lang->line('common_value');
		$this->load->view('mapred_slot_realtime', $data);
		
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
	
	public function GetClusterStatus($key = 'state')
	{
		$this->load->model('hive_model','hive');
		$json = $this->hive->get_cluster_status();
		echo $json;
	}
	
	public function ShowTables($db_name = 'default')
	{
		#Generate Header
		$this->lang->load('commons', 'chinese');
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
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
		$this->load->view('table_detail_list',$data);

		#Generate div end
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
	
	public function Login()
	{
		$this->lang->load('commons', 'chinese');
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function LoginAction()
	{
		$this->load->database();
		$this->load->model('user_model','user');
		$this->user->login_action(); 
	}

	public function SqlQuery($db_name = 'default', $table_name = '')
	{
		#Generate Header
		$this->lang->load('commons', 'chinese');
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
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

		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');

		#Generate left table list on left area
		$this->load->model('hive_model','hive');
		$data['var_db_name'] = $db_name;
		$data['table_list'] = $this->hive->show_tables($db_name);
		$this->load->view('table_list',$data);
		
		#generate query strict on right area
		$data['common_table_name'] = $this->lang->line('common_table_name');
		$data['common_alter_table'] = $this->lang->line('common_alter_table');
		$data['common_load_data'] = $this->lang->line('common_load_data');
		$data['common_clone_table'] = $this->lang->line('common_clone_table');
		$data['common_table_detail'] = $this->lang->line('common_table_detail');
		$data['common_drop_table'] = $this->lang->line('common_drop_table');
		$data['table_name'] = $table_name;
		#Get table detail describe;
		$array_desc_table_1 = $this->hive->desc_formatted_table($db_name, $table_name, "1");
		$array_desc_table_4 = $this->hive->desc_formatted_table($db_name, $table_name, "4");
		if(count($array_desc_table_4) != 0)
		{
			$array_desc_desc = array_merge($array_desc_table_1,$array_desc_table_4);
		}
		else
		{
			$array_desc_desc = $array_desc_table_1;
		}
		$i = 0;
		while ('' != @$array_desc_desc[$i])
		{
			$array_desc = explode('	',$array_desc_desc[$i]);
			$array_desc_desc_col['name'][$i] = trim($array_desc[0]);
			$array_desc_desc_col['type'][$i] = trim($array_desc[1]);
			@$array_desc_desc_col['comment'][$i] = trim($array_desc[2]);
			$i++;
		}
		$data['column_name'] = $array_desc_desc_col['name'];
		$data['column_type'] = $array_desc_desc_col['type'];
		$data['column_comment'] = $array_desc_desc_col['comment'];
		$data['example_data'] = $this->hive->get_example_data($db_name, $table_name, 2);
		$data['common_hql_validator'] = $this->lang->line('common_hql_validator');
		$data['common_submit'] = $this->lang->line('common_submit');
		$this->load->view('sql_query',$data);

		$this->load->view('div_end');
		$this->load->view('div_end');
		
		#Generate Footer
		$this->load->view('footer');
	}
	
	public function GetHiveUdfs($db_name = 'default', $table_name = '')
	{
		$this->load->model('hive_model','hive');
		$htmlstr = $this->hive->desc_table_hiveudfs($db_name, $table_name);
		echo $htmlstr;
	}
}