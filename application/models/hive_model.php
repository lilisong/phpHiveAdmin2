<?php
class Hive_model extends CI_Model
{
	public function __construct()
	{ 
		parent::__construct();
		$GLOBALS['THRIFT_ROOT'] = __DIR__."/../../libs/";
		include_once $GLOBALS['THRIFT_ROOT'] . 'packages/hive_service/ThriftHive.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'packages/hive_metastore/ThriftHiveMetastore.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'transport/TSocket.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
    }

	public function show_databases()
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
		while('' != @$db_array[$i])
		{
			echo $db_array[$i]."<br>";
			$i++;
		}
		$transport->close();
    }

	public function show_tables($db_name)
	{
		$host=$this->config->item('hivehost');
		$port=$this->config->item('hiveport');
		$transport = new TSocket($host, $port);
		$protocol = new TBinaryProtocol($transport);
		$client = new ThriftHiveClient($protocol);
        //Create ThriftHive object
        
		$transport->open();
		$client->execute('use '.$db_name);
		$client->execute('show tables');
		$db_array = $client->fetchAll();        
		$i = 0;
		while('' != @$db_array[$i])
		{
			echo $db_array[$i]."<br>";
			$i++;
		}
		$transport->close();
	}
}
?>