<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Press_model extends CI_Model
{


	public function getAll($table)
	{
		$query=$this->db->select('id,title,publish_at,status')
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



		public function file_upload($folder,$fileName = 'userfile') {
        $config['upload_path'] = config_item('upload_path') . $folder;


        $config['allowed_types'] ='pdf|doc|txt';
        $config['max_size'] = 8192;//8MB
        $config['file_name'] = time();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($fileName)) {
            $error = $this->upload->display_errors();
         
            $this->session->set_flashdata('errors',$error);
            redirect('admin/press_realese/create');
         
         
        } else {
          $finfo = $this->upload->data();
          $name = $finfo['file_name'];
          return $name;
        }
        
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