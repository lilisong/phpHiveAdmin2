<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role') != 'admin' || !$this->session->userdata('role'))
		{
			$this->load->helper('url');
			redirect($this->config->base_url() . 'index.php');
		}
	}
	
	public function Index()
	{
		$this->lang->load('commons');
		#Generate Header
		$this->lang->load('commons');
		$this->lang->load('errors');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$data['common_username'] = $this->lang->line('common_username');
		$data['common_password'] = $this->lang->line('common_password');
		$data['common_submit'] = $this->lang->line('common_submit');
		$this->load->view('header',$data);
		
		#Generate div container
		$this->load->view('div_fluid');
		$this->load->view('div_row_fluid');
		
		$data['common_user_list'] = $this->lang->line('common_user_list');
		$data['common_update_password'] = $this->lang->line('common_update_password');
		$data['common_password'] = $this->lang->line('common_password');
		$data['common_onlydb'] = $this->lang->line('common_onlydb');
		$data['common_role'] = $this->lang->line('common_role');
		$data['common_user'] = $this->lang->line('common_user');
		$data['common_admin'] = $this->lang->line('common_admin');
		$data['common_reduce'] = $this->lang->line('common_reduce');
		$data['common_description'] = $this->lang->line('common_description');
		$data['common_close'] = $this->lang->line('common_close');
		$data['common_submit'] = $this->lang->line('common_submit');
		$data['common_add_user'] = $this->lang->line('common_add_user');
		$this->load->view('user_nav_bar', $data);
		
		$this->load->view('user_list', $data);
		$this->load->view('create_user_modal', $data);
		
		#Generate div end
		$this->load->view('div_end');
		$this->load->view('div_end');
		
		#Generate Footer
		$this->load->view('footer');
	}
	
	public function Login()
	{
		$this->lang->load('commons');
		#Generate Header
		$this->lang->load('commons');
		$this->lang->load('errors');
		$data['common_lang_set'] = $this->lang->line('common_lang_set');
		$data['common_title'] = $this->lang->line('common_title');
		$data['common_username'] = $this->lang->line('common_username');
		$data['common_password'] = $this->lang->line('common_password');
		$data['common_submit'] = $this->lang->line('common_submit');
		$this->load->view('header',$data);
		
		$this->load->view('login_form', $data);
		
		#Generate Footer
		$this->load->view('footer');
	}
	
	public function LoginAction()
	{
		$this->load->model('user_model', 'user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->user->login_action($username, $password);
		$this->load->helper('url');
		redirect($this->config->base_url());
	}
	
	public function CreateUserAction()
	{
		$this->load->model('user_model', 'user');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$onlydb = $this->input->post('onlydb');
		$role = $this->input->post('role');
		$reduce = $this->input->post('reduce');
		$description = $this->input->post('description');
		
		$this->user->create_user($username, $password, $onlydb, $role, $reduce=0, $description);
		$this->load->helper('url');
		redirect($this->config->base_url() . 'index.php/user/index/', '0', "refresh");
	}
	
	public function DropUserAction()
	{
		$this->load->model('user_model', 'user');
		$user_id = $this->input->post('id');
		
		$this->user->drop_user($user_id);
		$this->load->helper('url');
		redirect($this->config->base_url() . 'index.php/user/index/', '0', "refresh");
	}
	
	public function UpdateUser()
	{
		
	}
	
	public function ListUser()
	{
		$this->load->model('user_model', 'user');
	}
	
	public function LogOut()
	{
		$this->load->model('user_model', 'user');
		$this->user->log_out();
		$this->load->helper('url');
		redirect($this->config->base_url(), "0", "refresh");
	}
}

?>