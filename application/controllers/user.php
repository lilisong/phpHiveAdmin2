<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		if(!$this->session->userdata('login') || $this->session->userdata('login') == FALSE)
		{
			redirect($this->config->base_url() . 'index.php/user/login/');
		}
		else
		{
			if($this->session->userdata('role') != "admin")
			{
				redirect($this->config->base_url() . 'index.php/manage/index/');
			}
		}
	}
	
	public function Index()
	{
		echo "Index";
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
		$onlydb = implode(",",$this->input->post('onlydb'));
		$role = $this->input->post('role');
		$reduce = $this->input->post('reduce');
		$description = $this->input->post('description');
		
		$this->user->create_user($username, $password, $onlydb, $role, $reduce, $description);
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