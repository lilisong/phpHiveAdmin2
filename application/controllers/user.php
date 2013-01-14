<?php

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function LoginForm()
	{
		
	}
	
	public function LoginAction()
	{
		
	}
	
	public function CreateUser()
	{
		
	}
	
	public function DropUser()
	{
		
	}
	
	public function UpdateUser()
	{
		
	}
	
	public function ListUser()
	{
		
	}
	
	public function LogOut()
	{
		$this->load->model('user_mode', 'user');
		$this->user->log_out();
		$this->load->helper('url');
		redirect($this->config->base_url());
	}
}

?>