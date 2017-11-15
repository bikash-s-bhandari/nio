<?php
if(!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin_model extends CI_Model
{


	function login($username,$email,$password)
	{
		$query=$this->db->select('*')
		->from('admin')
		->where('username',$username)
		->or_where('email',$email)
		->limit(1)
		->get();
		if($query->num_rows()==1)
		{
			$user=$query->row();
			$encryp_pass=make_hash($password,$user->salt);
			
			
			
			if($encryp_pass==$user->password)
			{
				return $user;
			}
			else
			{
				return INVALID_PASSWORD;
			}

		}
		else
		{
			return INVALID_EMAIL;
		}

	}


	public function getInfo()
	{
		$query=$this->db->select('id,fname,lname')
		->from('admin')
		->get();
		return $query->row();
	}



	public function getSalt($id)
	{


		$query=$this->db->select('*')
		->from('admin')
		->where('id',$id)
		->get();

		return $query->row()->salt;
	}


	public function update_pass($id,$data)
	{
		$this->db->where('id',$id);
		$query=$this->db->update('admin',$data);
		return true;
		
		
	}


	public function authenticate($table, $condition) {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($condition);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->row();
        }
    }

   public  function saveCode($code,$email)
    {
        $data['password_reset_code']=$code;
        $this->db->where('email',$email);
        $query=$this->db->update('admin',$data);

    }


    public function varify_reset_password_code($email_code)
    {

        $this->db->where('password_reset_code',$email_code);
        $query=$this->db->get('admin');

        if($query->num_rows()==1)
        {
            return $query->row();
            
        }
    }


		public function updatePassword($email,$password)
		{
		    $data['password']=$password;
		    $this->db->where('email',$email);
		    $query=$this->db->update('admin',$data);
		    return true;

		}

		public function removeCode($email)
		{
		    $data['password_reset_code']='';
		    $this->db->where('email',$email);
		    $query=$this->db->update('admin',$data);

		}


}