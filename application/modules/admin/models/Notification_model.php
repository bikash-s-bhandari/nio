<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Notification_model extends CI_Model
{


	public function getAll($table)
	{
		$query=$this->db->select('id,title,created_at')
		        ->from($table)
		        ->get();
		$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();
	}


	public function get($table,$id)
	{
		$query=$this->db->select('*')
		->from($table)
		->where('id',$id)
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();

	}



	public function get_device_token()
	{
		$query=$this->db->select('device_key')
		->from('devices')
		->get();
		$result=$query->result_array();
		$my_array = array_column($result, 'device_key');

		
		return (isset($my_array) && !empty($my_array))? $my_array:array();

	}

}