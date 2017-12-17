<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Event_model extends CI_Model
{


	public function getAll($table)
	{
		$query=$this->db->select('id,name,start_date,end_date,status')
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
	

	// public function getCategory()
	// {
	// 	$query=$this->db->select('id,cat_title,slug,priority,status')
	// 	->from('counselor_category')
	// 	->get();
	// 	$result=$query->result();
	// 	return (isset($result) && !empty($result))? $result:array();

	// }


	// public function getCatById($id)
	// {
	// 	$query=$this->db->select('*')
	// 	->from('counselor_category')
	// 	->where('id',$id)
	// 	->get();
	// 	$result=$query->row();
	// 	return (isset($result) && !empty($result))? $result:array();

	// }



}