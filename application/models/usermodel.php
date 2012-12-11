<?php
class UserModel extends CI_Model{

	 public function __construct() { 
        parent::__construct();
         $GLOBALS['THRIFT_ROOT'] = __DIR__."/../../libs/";
        include_once $GLOBALS['THRIFT_ROOT'] . 'packages/hive_service/ThriftHive.php';
        include_once $GLOBALS['THRIFT_ROOT'] . 'packages/hive_metastore/ThriftHiveMetastore.php';
        include_once $GLOBALS['THRIFT_ROOT'] . 'transport/TSocket.php';
        include_once $GLOBALS['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
         
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
    function hivedatabase()
    {
        $host=$this->config->item('hivehost');
        $port=$this->config->item('hiveport');
        $transport = new TSocket($host, $port);
        $protocol = new TBinaryProtocol($transport);
        $client = new ThriftHiveClient($protocol);
        //Create ThriftHive object
        
        $transport->open();
        $client->execute('show databases');
        $db_array = $client->fetchAll();        
        $i = 0;
        while('' != @$db_array[$i]) {
                        echo $db_array[$i]."<br>";
                        $i++;
        }
        
        $transport->close();
        
    }
    
    
    
    
    
    
    
    
    
}    
?>