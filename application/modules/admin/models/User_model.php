<?php
class User_model extends CI_Model
{

	public function getAll($id)
	{

		$query=$this->db->select('admin.id,admin.fname,admin.lname,roles.role,admin.status')
		->from('admin')
		->join('roles','roles.id=admin.role_id','left')
		->where('admin.id!=',$id)
		->order_by('created_at','DESC')
		->get();
        $result=$query->result();
		return (isset($result) && !empty($result))? $result:array();
	}


	public function get($id)
	{
		$this->db->where('id',$id);
		$query=$this->db->get('admin');
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();


	}

	public function getAllUsers()
	{
		$query=$this->db->select('id,full_name,email,address,status')
		->from('users')
		->order_by('created_at','DESC')
		->get();
        $result=$query->result();
		return (isset($result) && !empty($result))? $result:array();

	}


	public function getUserDetails($u_id)
	{
		$query=$this->db->select('*')
		->from('users')
		->where('id',$u_id)
		->get();
        $result=$query->row_array();
		return (isset($result) && !empty($result))? $result:array();
	}

}