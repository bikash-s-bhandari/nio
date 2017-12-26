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


//============================================================================================================================

	public function get_user_info()
	{

		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			// if($check_auth_client == true){
		        $response = $this->login_model->auth();
		       
		        if($response['status'] == 200){
		        	$resp = $this->front_model->get_user();
	    			json_output($response['status'],$resp);
		        }
			//}
		}
	}

//============================================================================================================================


	public function get_news()
	{

		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			// $check_auth_client = $this->login_model->check_auth_client();
			/*if($check_auth_client == true){*/
		        // $response = $this->login_model->auth();
		        $response['status']=200;
		       
		        if($response['status'] == 200){
		        	
		        	$resp = $this->front_model->get_all_news();
		        	foreach ($resp['news'] as $key => $value) {
		        		$value->created_at=date("D\, M j\, 'y",strtotime($value->created_at));
		        		$value->image=base_url().'uploads/news_events/'.$value->image;
		        		
		        	}
	    			json_output($response['status'],$resp);
		        }
			//}
		}
	}
	
	
		public function get_recent_news()
	{

		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			// $check_auth_client = $this->login_model->check_auth_client();
			/*if($check_auth_client == true){*/
		        // $response = $this->login_model->auth();
		        $response['status']=200;
		       
		        if($response['status'] == 200){
		        	
		        	$resp = $this->front_model->get_recent_news();
		        	foreach ($resp['recent_news'] as $key => $value) {
		        		$value->created_at=date("D\, M j\, 'y",strtotime($value->created_at));
		        		$value->image=base_url().'uploads/news_events/'.$value->image;
		        		
		        	}
	    			json_output($response['status'],$resp);
		        }
			//}
		}
	}
	
	//get news by id
	public function get_perticular_news($news_id)
	{

		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			// $check_auth_client = $this->login_model->check_auth_client();
			/*if($check_auth_client == true){*/
		        // $response = $this->login_model->auth();
		        $response['status']=200;
		       
		        if($response['status'] == 200){
		        	
		        	$resp = $this->front_model->get_news_by_id($news_id);
		        	if(!empty($resp))
		        	{
		        	    $resp->image=base_url().'uploads/news_events/'.$resp->image;
		        	$resp->publish_date=date("D\, M j\, 'y",strtotime($resp->publish_date));
		        	    
		        	}
		        	
		        
	    			json_output($response['status'],$resp);
		        }
			//}
		}
	}


//============================================================================================================================


	public function get_landmark_category()
	 {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'GET'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->login_model->check_auth_client();
			// if($check_auth_client == true){
		        $response = $this->login_model->auth();
		       
		        // if($response['status'] == 200){
		        	$resp = $this->front_model->get_landmark_cat();
	    			json_output($response['status'],$resp);
		        // }
			// }
		}
      }

//============================================================================================================================

      public function get_landmark()
		{
			
			$method = $_SERVER['REQUEST_METHOD'];
			if($method != 'GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			} else {
				$check_auth_client = $this->login_model->check_auth_client();
				// if($check_auth_client == true){
			        $response = $this->login_model->auth();
			       
			        // if($response['status'] == 200){
			        	$resp = $this->front_model->get_landmarks();
			        	//dumparray($resp);
			        	
			        	foreach ($resp['landmarks'] as $k=>$v) {
			        		$v->image=base_url().'uploads/landmark/'.$v->image;
			        	}
			        	
		    			json_output($response['status'],$resp);
			        // }
				// }
			}


		}


//============================================================================================================================

		public function get_sliders()
		{
			$method = $_SERVER['REQUEST_METHOD'];
			if($method != 'GET'){
				json_output(400,array('status' => 400,'message' => 'Bad request.'));
			} else {
				$check_auth_client = $this->login_model->check_auth_client();
				// if($check_auth_client == true){
			        //$response = $this->login_model->auth();
			       
			        // if($response['status'] == 200){
			        	$resp = $this->front_model->get_slider();
			        	// dumparray($resp);
			        	
			        	foreach ($resp['sliders'] as $k=>$v) {
			        		$v->image=base_url().'uploads/sliders/thumbs/'.$v->image;
			        	}

			        	
		    			json_output(200,$resp);
			        // }
				//}
			}
		}


//============================================================================================================================


	public function create_document()
	{
		
		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       $params = $_REQUEST;
				$folder=$params['folder_name'];
			    $user_id=$params['user_id'];
				$response = $this->front_model->create_folder($folder,$user_id);
				json_output($response['status'],$response);


			
		}

    }
    
    public function delete_document()
    {
    	$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       $params = $_REQUEST;
				$folder_id=$params['folder_id'];
			    $user_id=$params['user_id'];
				$response = $this->front_model->delete_folder($folder_id,$user_id);
				json_output($response['status'],$response);
		}

    }
    
    
     public function delete_image()
    {
    	$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       $params = $_REQUEST;
				$image_id=$params['image_id'];
			   
				$response = $this->front_model->delete_file($image_id);
				json_output($response['status'],$response);
		}



    }


    public function upload_document()
    {
       // phpinfo();
    	$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='POST')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       $params = $_REQUEST;
				$folder_name=$params['folder_name'];
				$images=$params['images'];//expecting base64 image
				$folder_id=$params['folder_id'];
				$user_id=$params['user_id'];
				$response=$this->front_model->file_upload($folder_name,$images,$folder_id,$user_id);
		         json_output($response['status'],$response);


			
		}


    }


    public function folder_listing($id)
    {

    	$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='GET')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       
				$user_id=$id;
				$response=$this->front_model->get_documents($user_id);
				//dumparray($response);
			
			
				
				
				
				//$arr1['documents'] = $response;
				json_output(200,$response);
				//return json_encode($response,true);
				//json_output(200,$arr1);


			
		}

    }

    public function file_listing($user_id,$folder_id)
    {
		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='GET')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       $user_id=$user_id;
				$folder_id=$folder_id;
				$response=$this->front_model->get_files($user_id,$folder_id);
				foreach($response['documents'] as $row)
				{
				    $row->image=base_url().$row->image;
				}
				json_output(200,$response);
		}
    }
    
    
    //=============================================================================================================================


    public function get_ambassador_message()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='GET')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       
				$response=$this->front_model->get_message();
				foreach ($response['message'] as $row) {
					$row->image=base_url().'uploads/ambassador_image/thumbs/'.$row->image;
				}
				json_output(200,$response);
		}

		
	}
	
	
	
	public function get_downloadable_file()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method!=='GET')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       
				$response=$this->front_model->get_download();
				foreach($response['downloads'] as $row)
				{
				    $row->filename=base_url().'uploads/download/'.$row->filename;
				    
				}
				
				json_output(200,$response);
		}



	}
	
	
	public function get_currency()
	{
	    $method = $_SERVER['REQUEST_METHOD'];
		if($method!=='GET')
		{
			json_output(400,array('status'=>400,'message'=>'Bad request.'));

		}else
		{       
				$response=$this->front_model->get_nep_currency();
				
				
				json_output(200,$response);
		}
	    
	}
	
	
	//===============================================================================================================


        public function sava_sos()
        {
        	   $method = $_SERVER['REQUEST_METHOD'];
        		if($method!=='POST')
        		{
        			json_output(400,array('status'=>400,'message'=>'Bad request.'));
        
        		}else
        		{       $params=$_REQUEST;
        			    $sos_data=array(
        				'user_id'=>$params['user_id'],
        				'name'=>$params['name'],
        				'email'=>$params['email'],
        				'phone'=>$params['phone'],
        				'create_at'=>date('Y-m-d H:i:s')
        
        			);
        				
        				$response = $this->front_model->create_sos($sos_data);
        				json_output($response['status'],$response);
        		}
        }


        public function get_sos($user_id)
        {
        
        	    $method = $_SERVER['REQUEST_METHOD'];
        		if($method!=='GET')
        		{
        			json_output(400,array('status'=>400,'message'=>'Bad request.'));
        
        		}else
        		{       
        				$response=$this->front_model->get_sos($user_id);
        				// foreach ($response['sos'] as $row) {
        				// 	$row->create_at=date("M j\,Y",strtotime($row->create_at));
        				// }
        				
        			json_output(200,$response);
        		}
        
        
        }	







}