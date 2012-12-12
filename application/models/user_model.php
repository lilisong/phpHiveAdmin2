<?php
class User_model extends CI_Model
{
	 public function __construct()
	{ 
		parent::__construct();
	} 

	public function login_action()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		if(!empty($username) && !empty($password))
		{
			$sql="select username,password,onlydb,role from ehm_pha_user where username='".$username."' and password='".md5($password)."'";
			$query=$this->db->query($sql);
			if ($query->num_rows() > 0)
			{
				echo "success";
			}
			else
			{
				echo "failed";
			}
		}
	}
}    
?>