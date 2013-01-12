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
			$result = $query->result();
			if ($query->num_rows() > 0)
			{
				$login = TRUE;
				$session_array = array(	'id' => $result->id,
										'username' => $result->username,
										'password' => $result->password,
										'login' => $login;
										'onlydb' => explode(",", $result->onlydb),
										'role' => $result->role),
										'reduce' => $result->reduce,
				$this->session->set_userdata($session_array);
				$this->load->helper('url');
				redirect($this->config->base_url());
			}
			else
			{
				$this->load->helper('url');
				redirect($this->config->base_url().'index.php/user/login/');
			}
		}
	}
	
	public function create_user($username, $password, $onlydb, $role = "user", $reduce = '1', $description)
	{
		#role must be user | admin
		$sql = "insert ehm_pha_user set username = '" . $username . "', password = '" . $password . "', onlydb = '" . $onlydb . "', role = '" . $role . "', reduce = '" . $reduce . "', description = '" . $description . "'";
		if(this->db->simple_query($sql))
		{
			return '{"status":"success"}';
		}
		else
		{
			return '{"status":"fail"}';
		}
	}
	
	public function update_user($id, $username, $password, $onlydb, $role, $reduce, $description)
	{
		$sql = "update ehm_pha_user set username = '" . $username . "', password = '" . $password . "', onlydb = '" . $onlydb . "', role = '" . $role . "', reduce = '" . $reduce . "', description = '" . $description . "' where id = '" . $id . "'";
		if(this->db->simple_query($sql))
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
		if(this->db->simple_query($sql))
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
	
	public function get_users()
	{
		$sql = "select * from ehm_pha_user";
		$query = $this->db->query($sql);
		$result = $query->result();
		return $result;// object array need foreach to fetch it
	}
	
}
?>
