<?php
class Page_model extends CI_Model
{
	public function getAll()
	{
		$query=$this->db->select('p.id,p.title,p.slug, nl.url')
		->from('pages as p')
		->join('navigation_link as nl','p.id=nl.page_id','left')
		->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return FALSE;
		}
	} 

	function get_page_by_id($id)
	{
		$query=$this->db->select('p.*,nl.nav_group_id as navigation_group_id')
		->from('pages as p')
		->join('navigation_link as nl','nl.id=p.navigation_link_id','left')
		->where('p.id',$id)
		->get();

		return $query->row();
	}

//getting page by filter
	function get_all_sorted_page($id)
	{
		$query=$this->db->select('p.id,p.title,p.slug,nl.url')
		->from('pages as p')
		->join('navigation_link as nl','p.id=nl.page_id')
		->join('navigation_groups as ng','ng.id=nl.nav_group_id')
		->where('ng.id',$id)
		->get();
		if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
	}


	public function getCategory()
	{
		$query=$this->db->select('id,cat_title,priority,status')
		->from('page_category')
		->order_by('priority','DESC')
		->get();
		$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();
	}

	public function getCatById($id)
	{
		$query=$this->db->select('*')
		->from('page_category')
		->where('id',$id)
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();

	}
	
}