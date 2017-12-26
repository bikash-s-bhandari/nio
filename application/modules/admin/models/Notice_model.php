<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Notice_model extends CI_Model
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



		

        function delete_file($table,$where,$folder,$field="filename")
	    {
			$this->db->where($where);
	        $query=$this->db->get($table)->row();
	        $filename=$query->$field;

	        if($filename!=='')
	        {
	            $path = $this->config->item('upload_path') . $folder . '/' . $filename;
	              if (file_exists($path)) {
	              	
	                unlink($path);
	                
	            }
	        }
	        return true;


	    }



    public function delete($table,$id)
    {
        $this->db->where('id',$id);
        $query=$this->db->delete($table);
        return true;


    }
	

	



}