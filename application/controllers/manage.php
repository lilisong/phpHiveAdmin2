<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller
{

	public function index()
	{
		$this->load->view('index');
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
       $this->load->model('usermodel','userlogin');
	   $this->userlogin->loginaction(); 
    }
}