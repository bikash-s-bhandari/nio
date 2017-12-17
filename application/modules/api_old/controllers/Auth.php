<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('login_model');
	}
//==================================================================================================================================
	public function user_login()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));
		}else
		{
			$check_auth_client=$this->login_model->check_auth_client();
			if($check_auth_client)
			{
				$params = $_REQUEST;
				$username=$params['username'];
				$password=$params['password'];
				$response = $this->login_model->check_user($username,$password);
				//echo json_encode($response);
				//die();
				// dumparray($response);
			    json_output($response['status'],$response);
			}
		}
	}
//===================================================================================================================================	
	public function logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			if($check_auth_client){
		        $response = $this->login_model->logout();
				json_output($response['status'],$response);
			}
		}
	}
//=================================================================================================================================
	public function signup()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			if($check_auth_client){
				$params = $_REQUEST;
				if ($params['first_name'] == "" || $params['last_name'] == "") 
				{
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'FirstName Or LastName can\'t be empty!');
				}elseif($params['email']=="" || $params['username']=="")
				{
					$respStatus = 400;
					$resp = array('status' => 400,'message' =>  'Username Or Email can\'t be empty!');
				}
			    else
				{
					if($this->login_model->check_duplicate_username($params)==false)
					{
					    $respStatus = 400;
						$resp = array('status' => 400,'message' =>  'The username is already taken!.');
					}elseif($this->login_model->check_duplicate_email($params)==false){
						$respStatus = 400;
						$resp = array('status' => 400,'message' =>  'The email is already used!.');
					}else
					{
					$data=array(
						'first_name'=>$params['first_name'],
						'last_name'=>$params['last_name'],
						'middle_name'=>$params['middle_name'],
						'username'=>$params['username'],
						'password'=>$params['password'],
						'email'=>$params['email'],
						'ip_address'=>$params['ip_address'],
						'status'=>'0',
						'photo'=>$params['photo'],
						'created_at'=>date('Y-m-d H:i:s')
				    		);
					$respStatus=200;
					$resp = $this->login_model->create_user($data);
						
					}
				}
				json_output($respStatus,$resp);
				
		    }
		}
	}
//=================================================================================================================================
	public function forgot_password_request()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));
		}else
		{
			$check_auth_client=$this->login_model->check_auth_client();
			if($check_auth_client)
			{
				$params = $_REQUEST;
				if($params['email']=="")
				{
					$respStatus=400;
					$resp=array('status' => 400,'message' =>  "The email field is empty!");
				}else
				{
					if($user_info=$this->login_model->check_user_email($params['email']))
					{
						if($user_info->status=='0')
						{
						$respStatus=403;
						$resp=array('status' => 403,'message' =>  "Your Account is not activated.Please contact the site administrator!.");
						}else
						{
						$email=$user_info->email;
                        $this->load->helper('string');
		                $code = random_string('alnum', 60);
		                $this->login_model->save_reset_code($code, $email); 
		                $From = config_item('site_email');
	                    $Name = $user_info->first_name;
	                    $Email = $user_info->email;
	                    $this->load->library('My_PHPMailer');
	                 
	                    $mails = new PHPMailer();
	                    $mails->SetFrom($From, config_item('site_name'));
	                    $mails->AddReplyTo($From, config_item('site_name'));
	                    $destino = $Email;
	                    $mails->AddAddress($destino, config_item('site_name'));
	                    $mails->Subject = config_item('site_name') . ": Password Reset Information.";
						$message = '<strong>Dear ' . $Name . ',</strong><br><br>';
	                    $message.='<p>We want to help you to reset your password .Please <strong><a href="' . base_url() . 'api/auth/reset_password_form/' . $code . '">Click Here</a></strong> to reset your password</p>';
	                    $message.= 'Your password has been reset, as per your request.<br>';
	                  
	                    $message.= "Thank You, <br>Best Regards, <br><strong>" . config_item('site_name') . "</strong>";
	                    $mails->Body = $message;
	                    $mails->AltBody = "Password Reset Information from " . config_item('site_email');
	                    dumparray($mails);
	                    
	                    if ($mails->send()) {
	                    $respStatus=200;
						$resp=array('status' => 200,'message' =>  "Your password is reset and has been sent to your email. Please check your email.");
                     
                       
	                    } else {
	                    $respStatus=400;
						$resp=array('status' => 400,'message' =>  "Error Occured, The password cannot be reset, Please try again.");
	                        
	                    }
						}
					
						
					}
					else
					{
						$respStatus=404;
						$resp=array('status' => 404,'message' =>  "Sorry, there is no account associated with this email. Please check your email address and submit again!!!");
				    }
				}
				json_output($respStatus,$resp);
			}
		}
	}
//===============================================varifying the email code===============================================
   
    public function reset_password_form($email_code) {
        if (isset($email_code)) {
			$data['title'] = 'Reset Password';
            $data['reset_code'] = $email_code;
            $this->load->view('password-reset/update_password_form',$data);
        }
    }
//=====================================================================================================================
    
    public function update_password() {
		$varified = $this->login_model->varify_reset_password_code($this->input->post('reset_code'));
        if ($varified) {
           $password = $this->input->post('new_password');
           if ($this->login_model->update_user_password($varified->email, $password)) {
				$this->login_model->clear_code($varified->email);
                dumparray("successfully");
               
            }
        }
    }
}