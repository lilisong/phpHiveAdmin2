<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller
{
	public function index()
	{
		#$this->load->view('index');
		$this->lang->load('commons', 'chinese');
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		
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

		$this->load->model('hive_model','hive');
		$data['db_list'] = $this->hive->show_databases();
		$this->load->view('db_list',$data);

		$this->load->view('div_end');
		$this->load->view('div_end');

		$this->load->view('footer');
	}
	
	public function login()
	{
		$this->lang->load('commons', 'chinese');
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);
		$this->load->view('login');
		$this->load->view('footer');
	}
	public function login_action()
	{
		$this->load->database();
		$this->load->model('user_model','user');
		$this->user->login_action(); 
	}
	public function show_databases()
	{ 
		$this->load->model('hive_model','hive');
		$this->hive->show_databases();
	}
}