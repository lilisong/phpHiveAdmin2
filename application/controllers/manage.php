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

		#Generate Left Database list
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');

		$this->load->model('hive_model','hive');
		$data['db_list'] = $this->hive->show_databases();
		$this->load->view('db_list',$data);

		#Generate Right add database
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

		#Generate Left Database list
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');

		$this->load->model('hive_model','hive');
		$data['db_list'] = $this->hive->show_tables($db_name);
		$this->load->view('db_list',$data);

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

	
}