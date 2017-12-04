<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model 
{



	public function get_user()
	{
		$users_id  = $this->input->get_request_header('User-ID', TRUE);
		$query=$this->db->select('id,first_name,middle_name,last_name,username,email,last_login,photo')
		->from('users')
		->where('id',$users_id)
		->get();
		$result=$query->row();
	    return (isset($result) && !empty($result))? $result:array();


	}


	public function get_all_news()
	{
			$query=$this->db->select('id,title,content,author,publish_date')
			->from('news')
			->where('status','publish')
			->limit(5)
			->order_by('publish_date','DESC')
			->get();
			$result=$query->result();
			return (isset($result) && !empty($result))? $result:array();

    }


    public function get_landmark_cat()
    {
    	$query=$this->db->select('id,cat_title,image')
			->from('landmark_category')
			->where('status','1')
			->order_by('id','DESC')
			->get();
			$result=$query->result();
			return (isset($result) && !empty($result))? $result:array();

    }

    public function get_landmarks()
    {
    	$query=$this->db->select('lm.*,lc.cat_title as category')
    	->from('landmarks as lm')
    	->join('landmark_category as lc','lc.id=lm.cat_id')
    	->where('lc.status','1')
    	->where('lm.status','1')
    	->get();
    	$result=$query->result();
		return (isset($result) && !empty($result))? $result:array();
	}

	


}