<?php
class Hive_model extends CI_Model
{
	public $hive_host = $this->config->item('hive_host');
	public $hive_port = $this->config->item('hive_port');
	public $transport;
	public $protocol;
	public $hive;
	public $metastore;
	
	public function __construct()
	{ 
		parent::__construct();
		$GLOBALS['THRIFT_ROOT'] = __DIR__ . "/../../libs/";
		include_once $GLOBALS['THRIFT_ROOT'] . 'packages/hive_service/ThriftHive.php';
		#include_once $GLOBALS['THRIFT_ROOT'] . 'packages/hive_metastore/ThriftHiveMetastore.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'transport/TSocket.php';
		include_once $GLOBALS['THRIFT_ROOT'] . 'protocol/TBinaryProtocol.php';
		
		$this->transport = new TSocket($this->hive_host, $this->hive_port);
		$this->protocol = new TBinaryProtocol($this->transport);
		$this->hive = new ThriftHiveClient($this->protocol);
	}

	public function show_databases()
	{
		try
		{
			$this->transport->open();
			$this->hive->execute('show databases');
			$db_array = $this->hive->fetchAll();        
			$this->transport->close();
			return $db_array;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function desc_formatted_table($db_name = 'default', $tbl_name = '', $key = '1')
	{
		try
		{
			$this->transport->open();
			$this->hive->execute('use ' . $db_name);
			$this->hive->execute('desc formatted ' . $tbl_name);
			$array_desc_table = $this->hive->fetchAll();
			#key=1 means columns detail, key=2 means table properties, key=3 means table sets key=4 means partitions
			foreach($array_desc_table as $k=>$v)
			{
				if(preg_match('/^	 	 /',$v))
				{
					$index[$k] = $k;
				}
			}

			$index = $this->array_reindex($index);
			if($key == "1")
			{
				$offset = 2;
				for ($i = $offset; $i < $index[1]; $i++)
				{
					$arr[$i] = trim($array_desc_table[$i]);
				}
			}
			elseif($key == "2")
			{
				foreach($array_desc_table as $k => $v)
				{
					if(preg_match('/^# Detailed/',$v))
					{
						$offset_start = $k+1;
					}
					if(preg_match('/^# Storage/',$v))
					{
						$offset_end = $k-1;
					}
				}
				for($i = $offset_start; $i < $offset_end; $i++)
				{
					$arr[$i] = trim($array_desc_table[$i]);
				}
			}
			elseif($key == "3")
			{
				foreach($array_desc_table as $k => $v)
				{
					if(preg_match('/^# Storage/',$v))
					{
						$offset_start = $k+1;
					}
				}
				$offset_end = count($array_desc_table);
				for($i = $offset_start; $i <= $offset_end; $i++)
				{
					$arr[$i] = trim($array_desc_table[$i]);
				}
			}
			elseif($key == "4")
			{
				foreach($array_desc_table as $k => $v)
				{
					if(preg_match('/^# Partition/',$v))
					{
						$offset_start = $k+3;
					}
					else
					{
						$offset_start = "";
					}
					if(preg_match('/^# Detailed/',$v))
					{
						$offset_end = $k-1;
					}
					else
					{
						$offset_end = "";
					}
				}
				if($offset_start == "")
				{
					$arr = array();
				}
				else
				{
					for($i = $offset_start; $i < $offset_end; $i++)
					{
						$arr[$i] = trim($array_desc_table[$i]);
					}
				}
			}
			else
			{
				$arr = array();
			}
			$arr = $this->array_reindex($arr);

			$this->transport->close();
			
			return $arr;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function get_example_data($db_name = 'default', $tbl_name = '', $limit = '2')
	{
		try
		{
			$this->transport->open();
			$this->hive->execute('use ' . $db_name);
			$this->hive->execute('select * from ' . $tbl_name . ' limit ' . $limit);
			$arr_tmp = $this->hive->fetchAll();
			$i = 0;
			foreach(@$arr_tmp as $k => $v)
			{
				$arr = explode('	',$v);
				foreach($arr as $key => $value)
				{
					#Replace html tags to special characters
					$value = str_replace('<','&lt;', trim($value));
					$value = str_replace('>','&gt;', trim($value));
					#data split into a matrix
					$array[$i][$key] = $value;
				}
				$i++;
			}
			$this->transport->close();
			return $array;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function desc_table_hiveudfs($db_name = 'default', $tbl_name = '')
	{
		$str = "";
		try
		{
			#Hql language defination file
			$file = __DIR__ . "/../../js/hiveudfs.txt";

			if($tbl_name == "" || !$tbl_name)
			{
				#Use default defination as an array if not set table name
				$array = file($file);
			}
			else
			{
				#insert Table name and column names into Hql language defination arrays
				$this->transport->open();
				$this->hive->execute('use ' . $db_name);
				$this->hive->execute('desc ' . $tbl_name);
				$array_desc_table = $this->hive->fetchAll();
				$transport->close();
				$i = 0;
				while ('' != @$array_desc_table[$i])
				{
					$array_desc = explode('	',$array_desc_table[$i]);
					$array_desc_desc[$i] = $array_desc[0];
					$i++;
				}
				$array_table = array($tbl_name);
				$array = file($file);
				$array = array_merge($array,$array_desc_desc);
				$array = array_merge($array,$array_table);
			}
			foreach ($array as $key => $value)
			{
				$str .= trim($value)."\n";
			}
			return $str;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function show_tables($db_name = 'default')
	{
		try
		{
			$this->transport->open();
			$this->hive->execute('use '.$db_name);
			$this->hive->execute('show tables');
			$tbl_array = $this->hive->fetchAll();
			$this->transport->close();
			return $tbl_array;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	public function get_cluster_status()
	{
		try
		{
			$this->transport->open();
			$status = $this->hive->getClusterStatus();
			$this->transport->close();
			$json = json_encode($status);
			return $json;
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	private function array_reindex($pArray)
	{
		if(count($pArray) != 0)
		{
			$i = 0;
			foreach(@$pArray as $value)
			{
				$arr[$i] = $value; 
				$i++;
			}
			return $arr;
		}
		else
		{
			return array();
		}
	}
	
	public function array_filters($pArray)
	{
		if(is_array($pArray) == FALSE)
		{
			return False;
		}
		$i = 0;
		foreach ($pArray as $key => $value)
		{
			if($value != "")
			{
				$arr[$i] = $value;
			}
			$i++;
		}
		$arr = $this->ArrayReindex($arr);
		return $arr;
	}
	
	public function make_finger_print()
	{
		$mtime = explode(" ",microtime());
		$date = date("Y-m-d-H-i-s",$mtime[1]);
		$mtime = (float)$mtime[1] + (float)$mtime[0];
		$sha1 = $date."_".sha1($mtime);
		return $sha1;
	}
	
	public function async_execute_hql($pCmd,$pTimestamp,$pFilename,$pType,&$pCode)
	{
		global $env;
		$descriptorspec = array(
			0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
			1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
			2 => array("pipe", "w") // stderr is a file to write to
		);

		$pipes= array();
		
		#$log = $env['logs_path'].$pTimestamp.".debug";
		#$this->LogAction($log,"w",$pCmd."\n");
		
		$process = proc_open($pCmd, $descriptorspec, $pipes);

		$output= "";

		if (!is_resource($process))
		{
			return false;
		}

		#close child's input imidiately
		fclose($pipes[0]);

		stream_set_blocking($pipes[1],0);
		stream_set_blocking($pipes[2],0);
		
		$todo= array($pipes[1],$pipes[2]);
	
		$fp = fopen($pFilename,"w");
		#fwrite($fp,$pTimestamp."\n\n");
		while( true )
		{
			$read= array(); 
			#if( !feof($pipes[1]) ) $read[]= $pipes[1];
			if( !feof($pipes[$pType]) )	$read[]= $pipes[$pType];// get system stderr on real time
			
			if (!$read)
			{
				break;
			}
	
			$ready= stream_select($read, $write=NULL, $ex= NULL, 2);
	
			if ($ready === false)
			{
				break; #should never happen - something died
			}
			
			foreach ($read as $r)
			{
				$s= fread($r,128);
				$output .= $s;
				fwrite($fp,$s);
			}
	
		}
	
		fclose($fp);

		fclose($pipes[1]);
		fclose($pipes[2]);

		$pCode= proc_close($process);

		return $output;
	}
	
	public function export_csv($pFingerPrint)
	{
		global $env;
		$filename1 = $env['output_path'].'/hive_res.'.$pFingerPrint.'.out';
		$filename2 = $env['output_path'].'/hive_res.'.$pFingerPrint.'.csv';
		$fp1 = @fopen($filename1,"r");
		$fp2 = @fopen($filename2,"w");
		while(!feof($fp1))
		{
			$str = str_replace($env['seperator'], ",", fgets($fp1));
			fputs($fp2,$str);
		}
		fclose($fp2);
		fclose($fp1);
		
		unlink($filename1);
	}
	
	public function quicksort_log_file($pArray)
	{
		if (count($pArray) <= 1)
		{
			return $pArray;
		}
		$key = explode("_",$pArray[0]);
		$key = $key[1];
		$left_arr = array();
		$right_arr = array();
		for ($i=1; $i<count($pArray); $i++)
		{
			$sort_key = explode("_",$pArray[$i]);
			if ( $sort_key[1] <= $key)
			{
				$left_arr[] = $pArray[$i];
			}
			else
			{
				$right_arr[] = $pArray[$i];
			}
		}
		$left_arr = $this->QuickSortForLogFile($left_arr);
		$right_arr = $this->QuickSortForLogFile($right_arr);

		return array_merge($right_arr, array($pArray[0]), $left_arr);
	}
}
?>
