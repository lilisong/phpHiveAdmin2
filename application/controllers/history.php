<?php

class History extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function Index()
	{
		#Generate Header
		$this->lang->load('commons');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$this->load->view('header',$data);

		#Generate Navigation top bar
		$data['common_hql_query'] = $this->lang->line('common_hql_query');
		$data['common_etl'] = $this->lang->line('common_etl');
		$data['common_hdfs_browser'] = $this->lang->line('common_hdfs_browser');
		$data['common_history'] = $this->lang->line('common_history');
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$data['common_user_admin'] = $this->lang->line('common_user_admin');
		$this->load->view('nav_bar',$data);

		#Generate div container
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');
		
		$this->load->view('history_menu', $data);
		
		$this->load->model('history_model', 'history');
		$this->load->library('pagination');
		$config['base_url'] = $this->config->base_url() . 'index.php/history/index/';
		$config['total_rows'] = $this->history->count_history();
		$config['per_page'] = 30;
		$offset = $this->uri->segment(3,0);
		if($offset == 0):
			$offset = 0;
		else:
			$offset = ($offset / $config['per_page']) * $config['per_page'];
		endif;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$data['common_log_out'] = $this->lang->line('common_log_out');
		$data['results'] = $this->history->get_history($config['per_page'], $offset);
		
		$this->load->view('div_end');
		$this->load->view('div_end');

		#Generate Footer
		$this->load->view('footer');
	}
}

?>