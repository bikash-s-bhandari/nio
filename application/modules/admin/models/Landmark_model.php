<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Landmark_model extends CI_Model
{

	public function getAll($table)
	{
		$query=$this->db->select('id,title,status')
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


}