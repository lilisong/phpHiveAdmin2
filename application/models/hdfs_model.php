<?php

class Hdfs_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}
	
	public function read_hdfs($path)
	{
		$this->load->model('hive_model', 'hive');
		$sql = 'dfs -ls '.$path;
		
		$LANG = " export LANG=" . $this->config->item('lang_set') . "; ";
		$JAVA_HOME = " export JAVA_HOME=" . $this->config->item('java_home') . "; ";
		$HADOOP_HOME = " export HADOOP_HOME=" . $this->config->item('hadoop_home') . "; ";
		$HIVE_HOME = " export HIVE_HOME=" . $this->config->item('hive_home'). "; ";
		
		$time = time();
		$filename = $this->config->item('result_path') . 'dfs.' . $time . '.out';
		
		$cmd = $LANG . $JAVA_HOME . $HADOOP_HOME . $HIVE_HOME . $this->config->item('hive_home') . '/bin/hive -e "' . $sql .'"';
		$this->hive->async_execute_hql($cmd, $filename, 1, $code);
		
		$this->load->model('utilities_model', 'utils');
		$list_arr = @file($filename);
		$i = 0;
		foreach($list_arr as $k => $line)
		{
			if(!preg_match("/Found/i", $line))
			{
				$cols = explode(" ", $line);
				$cols = $this->utils->array_filter($cols);
				$arr['file_property'][$i] = $cols[0];
				$arr['file_user'][$i] = $cols[2];
				$arr['file_group'][$i] = $cols[3];
				$arr['file_size'][$i] = $cols[4];
				$arr['file_time'][$i] = $cols[5] . " " . $cols[6];
				$arr['file_name'][$i] = $cols[7];
			}
			$i++;
		}
		
		unlink($filename);
		
		return $arr;
	}

}

?>