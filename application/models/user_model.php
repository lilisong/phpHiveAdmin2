<?php
class User_model extends CI_Model
{
	public function __construct()
	{ 
		parent::__construct();
	} 

	public function login_action($username, $password)
	{
		if(!empty($username) && !empty($password))
		{
			$sql="select * from ehm_pha_user where username='".$username."' and password='".md5($password)."'";
			$query = $this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				$result = $query->result();
				$login = TRUE;
				$onlydb = explode(',', $result[0]->onlydb);
				$session_array = array(	'id' => $result[0]->id,
										'username' => $result[0]->username,
										'password' => $result[0]->password,
										'login' => $login,
										'onlydb' => $onlydb,
										'role' => $result[0]->role,
										'reduce' => $result[0]->reduce);
				$this->session->set_userdata($session_array);
			}
			else
			{
				$login = FALSE;
				$this->load->helper('url');
				redirect($this->config->base_url().'index.php/user/login/');
			}
		}
	}
	
	public function create_user($username, $password, $onlydb, $role = "user", $reduce = '2', $description)
	{
		#role must be user | admin
		$sql = "insert ehm_pha_user set username = '" . $username . "', password = '" . $password . "', onlydb = '" . $onlydb . "', role = '" . $role . "', reduce = '" . $reduce . "', description = '" . $description . "'";
		if($this->db->simple_query($sql))
		{
			return '{"status":"success"}';
		}
		else
		{
			return '{"status":"fail"}';
		}
	}
	
	public function update_user($id, $username, $password, $onlydb, $role, $reduce="0", $description)
	{
		$sql = "update ehm_pha_user set username = '" . $username . "', password = '" . $password . "', onlydb = '" . $onlydb . "', role = '" . $role . "', reduce = '" . $reduce . "', description = '" . $description . "' where id = '" . $id . "'";
		if($this->db->simple_query($sql))
		{
			return '{"status":"success"}';
		}
		else
		{
			return '{"status":"fail"}';
		}
	}
	
	public function drop_user($id)
	{
		$sql = "delete from ehm_pha_user where id = '" . $id . "'";
		if($this->db->simple_query($sql))
		{
			return '{"status":"success"}';
		}
		else
		{
			return '{"status":"fail"}';
		}
	}
	
	public function log_out()
	{
		$this->session->sess_destroy();
	}
	
	public function get_user($id)
	{
		$sql = "select * from ehm_pha_user where id = '" . $id . "'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;//object
	}
	
	public function get_user_list()
	{
		$sql = "select * from ehm_pha_user where username != 'admin'";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;// object array need foreach to fetch it
	}
	
}
?>
