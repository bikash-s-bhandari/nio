<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MX_Controller

{



	public function __construct()

	{

		parent::__construct();
        $this->load->model('login_model');
	    $this->load->helper('string');

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

			// $check_auth_client=$this->login_model->check_auth_client();

			// if($check_auth_client)

			// {

				$params = $_REQUEST;

				$username=$params['email'];

				$password=$params['password'];





				$response = $this->login_model->check_user($username,$password);

				



				

			    json_output($response['status'],$response);





			//}

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
			$params = $_REQUEST;
			if ($params['full_name'] == "") 

				{

						$respStatus = 400;

						$resp = array('status' => false,'message' =>  'FullName can\'t be empty!');

				}elseif($params['email']=="")

				{

					$respStatus = 400;

					$resp = array('status' => false,'message' =>  'Email address can\'t be empty!');



				}

			    else

				{

				

					if($this->login_model->check_duplicate_email($params)==false){

						$respStatus = 400;

						$resp = array('status' => false,'message' =>  'The email is already used!.');

					}else

					{

					

					$photo=$this->upload_photo($params['photo']);
					
			        $email_code=random_string('alnum', 100);
				
                    $data=array(

						'full_name'=>$params['full_name'],

					    'password'=>$params['password'],

						'email'=>$params['email'],

						'address'=>$params['address'],

				        'status'=>'1',

						'photo'=>$photo,
						
						'email_varified_link'=>$email_code,

						'created_at'=>date('Y-m-d H:i:s')

					);



					$respStatus=200;
	                $this->send_email_verification($email_code,$params['email'],$params['full_name']);
					$resp = $this->login_model->create_user($data);
				

						

					}



				}



				json_output($respStatus,$resp);

				

		    



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

// 			if($check_auth_client)

// 			{

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

						$resp=array('status' => false,'message' =>  "Your Account is not activated.Please contact the site administrator!.");



						}else

						{

						$email=$user_info->email;
                        
                        $code = random_string('alnum', 60);

		                $this->login_model->save_reset_code($code, $email); 

		                $From = config_item('site_email');

	                    $Name = $user_info->full_name;

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

	                   // dumparray($mails);

	                    

	                    if ($mails->send()) {

	                    $respStatus=200;

						$resp=array('status' => true,'message' =>  "Your password is reset and has been sent to your email. Please check your email.");

                     

                       

	                    } else {

	                    $respStatus=400;

						$resp=array('status' => false,'message' =>  "Error Occured, The password cannot be reset, Please try again.");

	                        

	                    }



						}

					

						



					}

					else

					{

						$respStatus=404;

						$resp=array('status' => false,'message' =>  "Sorry, there is no account associated with this email. Please check your email address and submit again!!!");

				    }



				}

				json_output($respStatus,$resp);

		//	}

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
      
        
        $this -> form_validation -> set_rules('new_password', 'New Password', 'required|max_length[15]|min_length[5]');
        $this -> form_validation -> set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
        
        if ($this -> form_validation -> run() == FALSE)
        {
            
           $this->reset_password_form($this->input->post('reset_code'));
              
        }else
        {
            $varified = $this->login_model->varify_reset_password_code($this->input->post('reset_code'));

            if ($varified) {
              $password = $this->input->post('new_password');
                 if ($this->login_model->update_user_password($varified->email, $password)) {
                   
    
    				$this->login_model->clear_code($varified->email);
    				$this->session->set_flashdata('success','Your password is successfully reset. Please login through your mobile app');
    				redirect(base_url('api/auth/reset_success'));
    		  }
    
            }
        
            
        }



		
        





    }
    
    
    public function reset_success()
    {
            $data['title'] = 'Success';
            $this->load->view('password-reset/success',$data);
        
    }



//=======================================================================================================================



    public function upload_photo($file)

    {

    	$name=time();

    	$image = $file;

        $path = "uploads/photo/$name.jpg";

        file_put_contents($path,base64_decode($image));

        return 'uploads/photo/'.$name;

    }
    
    
    
//=======================Sending email for  verification======================================================================


    public function send_email_verification($email_code,$email,$name)
    {
      
        $From = config_item('site_email');

        $Name = $name;

        $Email = $email;

        $this->load->library('My_PHPMailer');

        $mails = new PHPMailer();

        $mails->SetFrom($From, config_item('site_name'));

        $mails->AddReplyTo($From, config_item('site_name'));

        $destino = $Email;

        $mails->AddAddress($destino, config_item('site_name'));

        $mails->Subject = config_item('site_name') . ": Email Verification Information.";

		$message = '<strong>Dear ' . $Name . ',</strong><br><br>';

        $message.='<p>Please <strong><a href="' . base_url() . 'api/auth/verify_email?email='.$Email.'&email_code='.$email_code.'">Click Here</a></strong> to verify your email address</p>';
        $message.= "Thank You, <br>Best Regards, <br><strong>" . config_item('site_name') . "</strong>";
		$mails->Body = $message;

        $mails->AltBody = "Email Verification Information from " . config_item('site_email');

     	if ($mails->send()) {
            
            return true;

       } else {

       

		$resp=array('status' => false,'message' =>  "Error Occured");

            

        }


        
        
    }
    
    
    
    public function verify_email()
    {
        $email=$_GET['email'];
        $verification_code=$_GET['email_code'];
       
        if($this->login_model->verify_user_email($email,$verification_code))
        {
            $this->login_model->verify_user_now($email);
            $this->session->set_flashdata('success','Your email is successfully verified. Please login through your mobile app');
    		redirect(base_url('api/auth/reset_success'));
        
            
        }else
        {
            dumparray("error");
            
        }
        
        
    }



   public function save_device_key()
    {

		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')

		{

			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else

		{
		    //accept json raw data
		    $params=json_decode(file_get_contents("php://input"), true);
		  

		  //  $params = $_REQUEST;
		    //device token
			$key=$params['device_key'];
			$response = $this->login_model->save_key($key);
			json_output($response['status'],$response);

		}
	}















}