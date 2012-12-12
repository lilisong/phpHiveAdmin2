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
		try
		{
			$transport->open();
			$client->execute('show databases');
			$db_array = $client->fetchAll();        
			$transport->close();
			return $db_array;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function show_tables($db_name = 'default')
	{
		$host=$this->config->item('hivehost');
		$port=$this->config->item('hiveport');
		$transport = new TSocket($host, $port);
		$protocol = new TBinaryProtocol($transport);
		$client = new ThriftHiveClient($protocol);
		//Create ThriftHive object

		try
		{
			$transport->open();
			$client->execute('use '.$db_name);
			$client->execute('show tables');
			$tbl_array = $client->fetchAll();        
			$transport->close();
			return $tbl_array;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function get_cluster_status()
	{
		$host=$this->config->item('hivehost');
		$port=$this->config->item('hiveport');
		$transport = new TSocket($host, $port);
		$protocol = new TBinaryProtocol($transport);
		$client = new ThriftHiveClient($protocol);
		//Create ThriftHive object
		
		try
		{
			$transport->open();
			$status = $client->getClusterStatus();
			$transport->close();
			$json = json_encode($status);
			return $json;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
}
?>