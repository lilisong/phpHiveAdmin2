<?php

class History_model extends CI_Model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_histroy()
	{
		$sql = "select * from ehm_pha_history_job order by access_time desc";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;// object array need foreach to fetch it
	}
	
	public function get_history_by_user($username)
	{
		$sql = "select * from ehm_pha_history_job where username = '". $username ."' order by access_time desc";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;// object array need foreach to fetch it
	}
	
	public function drop_history($id = array())
	{
		if(count($id) > 0)
		{
			$ids = implode(",", $id);
			$sql = "select finger_print from ehm_pha_history_job where id in (".$ids.")";
			$query = $this->db->query($sql);
			$result = $query->result();
			
			$this->load->model('utilities_model', 'utils');
			foreach($result as $row)
			{
				$filename = $this->utils->make_filename($row->finger_print);
				try
				{
					unlink($filename['log_with_path']);
					unlink($filename['csv_with_path']);
					unlink($filename['run_with_path']);
				}
				catch (Exception $e)
				{
					echo 'Caught exception: ',  $e->getMessage(), "\n";
				}
			}
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
}

?>