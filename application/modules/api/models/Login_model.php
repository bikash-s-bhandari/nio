<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	var $client_service = "mobile-user";
	var $auth_key="test-api";

	public function check_auth_client()
	{
		$client_service=$this->input->get_request_header('Client-Service',TRUE);
		$auth_key=$this->input->get_request_header('Auth-key',TRUE);

		if($client_service==$this->client_service && $auth_key==$this->auth_key)
		{
			return true;

		}else
		{
			return json_output(401,array('status'=>401,'message'=>'Unauthorized User.'));

		}
	}


	public function check_user($username,$password)
	{
		$query=$this->db->select('*')
		       ->from('users')
		       ->where('username',$username)
		       ->or_where('email',$username)
		       ->limit(1)
		       ->get();
		if($query->num_rows()==0)
		{
			return array('status' => 401,'message' => 'The username is incorrect!.');
		}else
		{
			$user=$query->row();

			$enc_password=$user->password;
			$user_id=$user->id;



			if ($this->verify_hash($password,$enc_password)) 
			{

				if($user->status==1)
				{

                    $last_login=date('Y-m-d H:i:s');
					// $token = crypt(substr( md5(rand()), 0, 7));
					$token=generate_random_string(60);
					$expire_at=date('Y-m-d H:i:s',strtotime('+12 hours'));
					/*transation start*/
					$this->db->trans_start();

					$this->db->where('id',$user_id)->update('users',array('last_login' => $last_login));
					$this->db->insert('user_auth',array('user_id'=>$user_id,'token'=>$token,'expire_at'=>$expire_at));

					$this->db->trans_complete();

					
					if($this->db->trans_status()==FALSE)
					{
						$this->db->trans_rollback();
						return array('status' => 500,'message' => 'Internal server error.');

					}else
					{
					  $this->db->trans_commit();
	                  return array('status' => 200,'message' => 'Successfully login.','user_id' => $user_id, 'token' => $token);

					}

				}
				else
				{
					return array('status' => 403,'message' => 'Your account is not activated, Please activate your account via email verification.');
					

				}
		  }else
			{
			   
               return array('status' => 401,'message' => 'The password is incorrect!.');

			}

		}
	}


	
   function hash_string($str)
	{
		
		$hash_string=password_hash($str,PASSWORD_BCRYPT,array('cost'=>11));
		return $hash_string;

	}
  
	function verify_hash($plan_text,$hash_string)
	{
		$result=password_verify($plan_text,$hash_string);
		return $result;
	}




	public function logout()
	{
		$users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $this->db->where('user_id',$users_id);
        $this->db->where('token',$token);
        $query=$this->db->delete('user_auth');
        if($this->db->affected_rows())
        {
        	return array('status' => 200,'message' => 'Successfully logout.');

        }else
        {
        	return array('status' => 400,'message' => 'Error! Unauthorized');
        }


        
	}


	public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('expire_at')->from('user_auth')->where('user_id',$users_id)->where('token',$token)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->expire_at < date('Y-m-d H:i:s')){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('user_id',$users_id)->where('token',$token)->update('user_auth',array('expire_at' => $expired_at,'updated_at' => $updated_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }




    public function create_user($data)
    {
        $data['password']=$this->hash_string($data['password']);
    	$this->db->insert('users',$data);
        return array('status' => 201,'message' => 'Your account is successfully created.');
    }


   

    public  function check_duplicate_username($params)
    {
    	$username=$params['username'];
    	
    	$this->db->where('username',$username);
    	$query=$this->db->get('users');
    	if($query->num_rows()>0)
    	{


    		return false;

    	}else
    	{
    		return true;
    	}
    }


    public function check_duplicate_email($params)
    {
    	$email=$params['email'];
    	$this->db->where('email',$email);
    	$query=$this->db->get('users');
    	if($query->num_rows()>0)
    	{

    		return false;

    	}else
    	{
    		return true;
    	}

    }



    public function check_user_email($email)
    {
    	$this->db->where('email',$email);
    	$query=$this->db->get('users');
    	if($query->num_rows()==1)
    	{
    		return $query->row();
    	}else
    	{
    		return false;
    	}
    }



    public function save_reset_code($code, $email)
    {
    	$data['password_reset_code']=$code;
        $this->db->where('email',$email);
        $query=$this->db->update('users',$data);

    }

    public function varify_reset_password_code($email_code)
    {
		$this->db->where('password_reset_code',$email_code);
        $query=$this->db->get('users');

        if($query->num_rows()==1)
        {
            return $query->row();
            
        }
    }


	public function update_user_password($email,$password)
	{

	    $data['password']=$this->hash_string($password);
	    $this->db->where('email',$email);
	    $query=$this->db->update('users',$data);

	    return true;

	}

	public function clear_code($email)
	{
	    $data['password_reset_code']=null;
	    $this->db->where('email',$email);
	    $query=$this->db->update('users',$data);

	}







}