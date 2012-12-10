<?php
class UserModel extends CI_Model{

	function __construct()
	{
		parent::__construct();
	}
    
    function loginaction()
    {
        
        $username=$_POST["username"];
        $pass=$_POST["password"];
        if(!empty($username) && !empty($pass)){
            $sql="select username,password,onlydb,role from ehm_pha_user where username='".$username."' and password='".md5($pass)."'";
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