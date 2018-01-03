<?php
defined('BASEPATH') OR exit('No direct script access allowed!');
class Message_model extends CI_Model
{
	public function getAllMessage()
	{
		$query=$this->db->select('chat_messages.*,users.full_name,users.email,users.address')
		->from('chat_messages')
		->join('users','chat_messages.sent_by=users.id','left')
		->where('chat_messages.sent_to',0)
		->order_by('chat_messages.created_at','DESC')
		->get();
		return $query;

		




	}


	public function get_details($id)
	{
		$query=$this->db->select('chat_messages.*,users.full_name,users.email,users.address')
		->from('chat_messages')
		->join('users','chat_messages.sent_by=users.id','left')
		->where('chat_messages.sent_to',0)
		->where('chat_messages.id',$id)
		->order_by('chat_messages.created_at','DESC')
		->get();
		$result=$query->row();
		return (isset($result) && !empty($result))? $result:array();



	}


	public function get_user_id($id)
	{
		
		$query=$this->db->select('*')
		->from('chat_messages')
		->where('id',$id)
		->get();
		return $query->row()->sent_by;

	}



	public function opened($id)
	{
		$this->db->where('id',$id);
		$this->db->update('chat_messages',array('opened'=>1));

	}


	public function send_msg($data)
	{
		$this->db->insert('chat_messages',$data);
		return true;

	}
} 