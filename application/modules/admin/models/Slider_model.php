<?php
defined('BASEPATH') OR exit('No direct script access allowed!');
class Slider_model extends CI_Model
{
	function getAll()
	{
		$this->db->select('id,title,image,status');
		$this->db->from('sliders');
		$query=$this->db->get();
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return array();
		}
	}

	function get($id)
	{
		return $this->db->get_where('sliders',array('id'=>$id))->row();
	}


	
	function insert_multiple($table,$data)
	{
		$this->db->insert_batch($table,$data);

	}
} 