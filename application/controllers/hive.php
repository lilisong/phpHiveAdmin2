<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HiveDatabase extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function DropDatabase($db_name)
	{
		$this->load->model('hive_model','hive');
		$ret = $this->hive->drop_database($db_name);
		echo $ret;
	}
}

?>