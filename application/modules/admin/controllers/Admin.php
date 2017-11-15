<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->config->load('my_config');
		$this->load->model('admin_model');

		
	}
//========================================================================================================
	public function index()
	{
        $this->login();

	}


//========================================================================================================

	public function login()
	{
		$this->load->view('login/login');
	}

//========================================================================================================


	public function check_login()
	{
		$username=$this->input->post('email');
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$result=$this->admin_model->login($username,$email,$password);

		if(isset($result->id))
		{
			if($result->status==1)
			{
				$data=array(
					'user_id'=>$result->id,
					'email'=>$result->email,
					'username'=>$result->username,
					'fname'=>$result->fname,
					'lname'=>$result->lname,
					'is_logged_in'=>TRUE
					);

				$this->session->set_userdata('admin_user',$data);


				
				redirect(base_url().'admin/dashboard');
			}
		      else
		      {
		      	$this->session->set_flashdata('error','The account is not activated!');
		      	redirect(base_url('admin'));

		      }
			
		}
		elseif($result==INVALID_EMAIL)
		{
			$this->session->set_flashdata('error',INVALID_EMAIL);
		      	redirect(base_url('admin'));
			
		}
		else
		{
			$this->session->set_flashdata('error',INVALID_PASSWORD);
		      	redirect(base_url('admin'));
		}
		
	}

//========================================================================================================

	public function profile()
	{
		$data['title']="Profile";
		$data['user']=$this->admin_model->getInfo();

		$this->template->load('template','profile',$data);

	}

//========================================================================================================	
	public function changePassword()
	{

		$data=array(
			'fname'=>$this->input->post('fname'),
			'lname'=>$this->input->post('lname')

			);


		if(!empty($_POST['password']))
		{

			$this->form_validation->set_rules('password','Password','trim|required');
			$this->form_validation->set_rules('password2','Confirm Password','trim|required|matches[password]');
			if($this->form_validation->run()==FALSE)
			{

                $this->session->set_flashdata('error','Confirm password did not match!');

				redirect(base_url().'/admin/profile');
				// dumparray('error');
			}
			else
			{
			
				$salt=$this->admin_model->getSalt($this->session->userdata('admin_user')['user_id']);
				$password=$this->input->post('password');
				$enc_password=make_hash($password,$salt);
				$data['password']=$enc_password;
			}
		}

		$update=$this->admin_model->update_pass($this->session->userdata('admin_user')['user_id'],$data);
		if($update)
		{
			$this->session->set_flashdata('success','Profile Updated Successfully!');
			redirect(base_url().'/admin/profile');
		}

}


//========================================================================================================

	public function forgotPassword()
	{
		$data['title']="Reset Password";
		$this->load->view('password-reset/email_form',$data);


	}



//========================================================================================================
	
	public function logout()
	{
		$this->session->unset_userdata('admin_user');
		$this->session->sess_destroy();
		redirect(base_url('admin'));
	}

//========================================================================================================

	public function resetPassword() {
        $email = $this->input->post('email');
        if (isset($email) && $email != '') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('message', 'Invalid Email.');
                redirect(base_url().'/admin/forgotPassword');
            }
            $user_info = $this->admin_model->authenticate('admin', array('email' => $email));
            if (FALSE == ($user_info)) {
                $this->session->set_flashdata('message', 'Sorry, there is no account associated with this email. Please check your email address and submit again!!!');
                redirect(base_url(base_url().'/admin/forgotPassword'));
            } else {
                if ($user_info->status != '1') {
                    $this->session->set_flashdata('message', 'Your Account is not activated.Please contact the site administrator.');
                    redirect(base_url().'/admin/forgotPassword');
                } else {
                	$this->load->helper('string');
                 $code = random_string('alnum', 60);
                 $this->admin_model->saveCode($code, $email); //reset code save garan

                    //send mail 
                    $From = config_item('site_email');
                    $Name = $user_info->fname;
                    $Email = $user_info->email;
                    $this->load->library('My_PHPMailer');
                 
                    $mails = new PHPMailer();

                    $mails->SetFrom($From, config_item('site_name'));
                    $mails->AddReplyTo($From, config_item('site_name'));
                    $destino = $Email;
                    $mails->AddAddress($destino, config_item('site_name'));
                    $mails->Subject = config_item('site_name') . ": Password Reset Information.";



                    $message = '<strong>Dear ' . $Name . ',</strong><br><br>';
                    $message.='<p>We want to help you to reset your password .Please <strong><a href="' . base_url() . 'admin/reset_password_form/' . $code . '">Click Here</a></strong> to reset your password</p>';
                    $message.= 'Your password has been reset, as per your request.<br>';
                  
                    $message.= "Thank You, <br>Best Regards, <br><strong>" . config_item('site_name') . "</strong>";

                    $mails->Body = $message;
                    $mails->AltBody = "Password Reset Information from " . config_item('site_email');

                
//                    echo $message; exit;
                    if ($mails->send()) {
                        //$this->general->update('users', array('password' => md5($newPassword)), 'id = ' . $user_info->id);
                        $this->session->set_flashdata('message', 'Your password is reset and has been sent to your email. Please check your email.');
                    } else {
                        $this->session->set_flashdata('message', 'Error Occured, The password cannot be reset, Please try again.');
                    }
                    redirect(base_url(base_url().'/admin/forgotPassword'));
                }
            }
        }



        $data['page_title'] = 'Forgot Password';
        $data['current'] = $this->uri->segment(1);
        $this->template->front('frontend/template', 'users/resetPassword_view', $data);
    }

//===============================================varifying the email code================================
   

    public function reset_password_form($email_code) {

        if (isset($email_code)) {
			$data['title'] = 'Reset Password';
            $data['current'] = $this->uri->segment(1);
            $data['reset_code'] = $email_code;
            $this->load->view('password-reset/update_password_form',$data);
        }
    }


//========================================================================================================
    
    public function updatePassword() {
		$varified = $this->admin_model->varify_reset_password_code($this->input->post('rcode'));
        if ($varified) {
           $password = make_hash($this->input->post('new_password'),$varified->salt);
           if ($this->admin_model->updatePassword($varified->email, $password)) {
                $this->session->set_flashdata('success', 'Your password is reset successfully! Please login ');
                $this->admin_model->removeCode($varified->email);

                redirect(base_url().'/admin/login');
            }
        }
    }

}
