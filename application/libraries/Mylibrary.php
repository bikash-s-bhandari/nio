<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mylibrary 
{
//constructor
	function Mylibrary()
	{
		 $this->CI = & get_instance();

	}


	function get_post_array($not)
	{
		$array=array();
		foreach($_POST as $key=>$value)
		{
			$match=false;
			foreach ($not as $value) 
			{
				if($key==$value)
				{
					$match=true;
				}
				
			}

			if($match==false)
			{
				$array[$key]=$this->CI->input->post($key);
			}


		}

		return $array;

	}


}