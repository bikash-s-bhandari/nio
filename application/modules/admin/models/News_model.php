<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class News_model extends CI_Model
{

    public $parent_cat;
	public function getAll($table)
	{
		$query=$this->db->select('id,title,author,publish_date,status')
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


	public function getCategory()
	{
		$query=$this->db->select('id,cat_title,parent_cat_id,priority,status')
		->from('news_category')
		->get();
		$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();
		
	}


	public function getCategoryById($id)
	{
		$query=$this->db->select('*')
		->from('news_category')
		->where('id',$id)
		->get();
		$result=$query->row_array();
		return (isset($result) && !empty($result))? $result:array();


	}

	public function getParentCatName($parent_id)
	{

		$query=$this->db->select('cat_title')
		->from('news_category')
		->where('id',$parent_id)
		->get();
		$result=$query->row_array();
		
		return (isset($result) && !empty($result))? $result:array();

	}


	public function getCat($id)
	{
		$query=$this->db->select('*')
		->from('news_category')
		->where('id',$id)
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();
	}


	public function custom_query($mysql_query) 
	 {
		$query = $this->db->query($mysql_query);
		return $query;
	 }

	 public function getParentId($id)
	 {
	 	return $this->db->select('parent_cat_id')
	 	->from('news_category')
	 	->where('id',$id)
	 	->get()->row()->parent_cat_id;
	 }


}