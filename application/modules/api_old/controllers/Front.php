<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Front extends MX_Controller
{
	public function __construct()
	{
		parent::__construct();
	    $this->load->model('front_model');
	    $this->load->model('login_model');
	}
	public function get_user_info()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->login_model->auth();
		       
		        if($response['status'] == 200){
		        	$resp = $this->front_model->get_user();
	    			json_output($response['status'],$resp);
		        }
			}
		}
	}
	public function get_news()
	{
            // $date=date('Y-m-d');
            // $dates =date('D\, M j\,y ',strtotime($date));
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->login_model->auth();
		       
		        if($response['status'] == 200){
		        	$resp = $this->front_model->get_all_news();
		        	foreach ($resp as $key => $value) {
		        		$value->publish_date=date("D\, M j\,'y",strtotime($value->publish_date));
		        		
		        	}
	    			json_output($response['status'],$resp);
		        }
			}
		}
	}
	public function get_landmark_category()
	 {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->login_model->auth();
		       
		        if($response['status'] == 200){
		        	$resp = $this->front_model->get_landmark_cat();
	    			json_output($response['status'],$resp);
		        }
			}
		}
      }
      public function get_landmark()
		{
			
			$method = $_SERVER['REQUEST_METHOD'];
			if($method != 'GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			} else {
				$check_auth_client = $this->login_model->check_auth_client();
				if($check_auth_client == true){
			        $response = $this->login_model->auth();
			       
			        if($response['status'] == 200){
			        	$resp = $this->front_model->get_landmarks();
			        	//dumparray($resp);
			        	
			        	foreach ($resp as $k=>$v) {
			        		$v->image=config_item('upload_path').'landmark/'.$v->image;
			        	}
			        	
		    			json_output($response['status'],$resp);
			        }
				}
			}
		}
}