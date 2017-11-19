<?php
class Page_model extends CI_Model
{
	public function getAll()
	{
		$query=$this->db->select('p.id,p.title,p.slug,pn.title as category_name')
		->from('pages as p')
		->join('page_navigation as pn','pn.id=p.nav_id','left')
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

	function getPageById($id)
	{
		$this->db->where('id',$id);
		$this->db->order_by('id','DESC');
		$query=$this->db->get('pages');
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();

		
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
		$query=$this->db->select('pn.id,pn.title,ng.title as nav_group,pn.priority,pn.status,')
		->from('page_navigation as pn')
		->join('navigation_groups as ng','ng.id=pn.nav_group_id','left')
		->order_by('priority','DESC')
		->get();
		$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();
	}

	public function getCatById($id)
	{
		$query=$this->db->select('*')
		->from('page_navigation')
		->where('id',$id)
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();

	}



	public function getNavigationGroup()
	{
		$query=$this->db->select('id,title,abbrev,priority,status')
		->from('navigation_groups')
		->order_by('priority','DESC')
		->get();
		$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();

	}



	public function getNavGroupById($id)
	{
		$query=$this->db->select('*')
		->from('navigation_groups')
		->where('id',$id)
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();

	}
	
}