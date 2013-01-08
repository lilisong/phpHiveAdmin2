<?php

class Utilities_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function array_reindex($array = array())
	{
		if(count($array) != 0)
		{
			$i = 0;
			foreach($array as $value)
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
/*
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
*/
	
	public function make_finger_print()
	{
		$mtime = explode(" ",microtime());
		$date = date("Y-m-d-H-i-s",$mtime[1]);
		$mtime = (float)$mtime[1] + (float)$mtime[0];
		$sha1 = $date."_".sha1($mtime);
		return $sha1;
	}
	
	public function make_filename($finger_print = '')
	{
		$this->load->library('session');
		if($finger_print == "")
		{
			$finger_print = $this->make_finger_print();
		}
		
		$filename = array();
		$filename['log'] = $this->session->userdata('username') . "_" . $finger_print . ".log";
		$filename['out'] = 'hive_res.' . $finger_print . '.out';
		$filename['csv'] = 'hive_res.' . $finger_print . '.csv';
		$filename['run'] = 'hive_res.' . $finger_print . '.run';
		
		$filename['log_with_path'] = $this->config->item('log_path') . $filename['log'];
		$filename['out_with_path'] = $this->config->item('result_path') . $filename['out'];
		$filename['csv_with_path'] = $this->config->item('result_path') . $filename['csv'];
		$filename['run_with_path'] = $this->config->item('result_path') . $filename['run'];
		
		
		return $filename;
	}
	
	public function export_csv($finger_print)
	{
		$filename = $this->make_filename($finger_print);
		$filename1 = $filename['out_with_path'];
		$filename2 = $filename['csv_with_path'];
		$fp1 = @fopen($filename1,"r");
		$fp2 = @fopen($filename2,"w");
		while(!feof($fp1))
		{
			$str = str_replace($this->config->item('output_seperator'), ",", fgets($fp1));
			fputs($fp2,$str);
		}
		fclose($fp2);
		fclose($fp1);
		
		unlink($filename1);
	}
	
	public function quicksort_log_file($file_name_array)
	{
		if (count($file_name_array) <= 1)
		{
			return $file_name_array;
		}
		$key = explode("_",$file_name_array[0]);
		$key = $key[1];
		$left_arr = array();
		$right_arr = array();
		for ($i=1; $i<count($file_name_array); $i++)
		{
			$sort_key = explode("_",$file_name_array[$i]);
			if ( $sort_key[1] <= $key)
			{
				$left_arr[] = $file_name_array[$i];
			}
			else
			{
				$right_arr[] = $file_name_array[$i];
			}
		}
		$left_arr = $this->QuickSortForLogFile($left_arr);
		$right_arr = $this->QuickSortForLogFile($right_arr);

		return array_merge($right_arr, array($file_name_array[0]), $left_arr);
	}
	
	public function read_log_path()
	{
		$this->load->library('session');
		$dir = $this->config->item('log_path');
		$i = 0;
		$dh = $dh = opendir($dir);
		while (($file = readdir($dh)) !== false)
		{
			if(($file == '.') || ($file == '..'))
			{
				continue;
			}
			else
			{
				if(!is_dir($dir.$file))
				{
					if($this->session->userdata('role') == 'superadmin')
					{
						$file_array[$i] = $file;
					}
					else
					{
						if(preg_match('/'.$this->session->userdata('username').'/', $file))
						{
							$file_array[$i] = $file;
						}
					}
				}
			}
			$i++;
		}
		$file_array = $this->array_reindex($file_array);
		closedir($dh);

		return $file_array;
	}
	
	public function download_csv($file_name)
	{
		$this->load->helper('file');
		$full_file_name = $this->config->item('result_path').$file_name;
		$this->load->helper('download');
		$content = readfile($full_file_name);
		force_download($file_name, $content);
	}
	
}

?>