<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends CI_Controller
{

	public function index()
	{
		$this->load->view('index');
	}
	
	public function login()
	{
		$this->lang->load('common_lang', 'chinese');
		
		$data['lang'] = $this->lang->line('common_lang_set');
		$data['title'] = $this->lang->line('common_title');
		
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('footer');
	}
}