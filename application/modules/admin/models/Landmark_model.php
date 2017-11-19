<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Landmark_model extends CI_Model
{

	public function getAll($table)
	{
		$query=$this->db->select('lm.id,lm.title,lc.cat_title,lm.status')
		->from('landmarks as lm')
		->join('landmark_category as lc','lc.id=lm.cat_id','left')
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


	public function getCategory()
	{
		$query=$this->db->select('id,cat_title,slug,priority,status')
		->from('landmark_category')
		->get();
		$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();

	}

	public function getCatById($id)
	{
		$query=$this->db->select('*')
		->from('landmark_category')
		->where('id',$id)
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();

	}


}