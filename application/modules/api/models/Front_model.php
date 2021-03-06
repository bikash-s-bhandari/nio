<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_model extends CI_Model 
{



	public function get_user()
	{
		$users_id  = $this->input->get_request_header('User-ID', TRUE);
		$query=$this->db->select('id,full_name,email,address,photo')
		->from('users')
		->where('id',$users_id)
		->get();
		$result['user_profile']=$query->row();
	    return (isset($result) && !empty($result))? $result:array();


	}
	
	
	public function get_recent_news()
	{
	    $query=$this->db->select('id,title,content,author,image,created_at')
			->from('news')
			->where('status','publish')
			->limit(3)
			->order_by('created_at','DESC')
			->get();
			$result['recent_news']=$query->result();
			return (isset($result) && !empty($result))? $result:array();
	    
	    
	}


	public function get_all_news()
	{
			$query=$this->db->select('id,title,content,author,image,created_at')
			->from('news')
			->where('status','publish')
			
			->order_by('created_at','DESC')
			->get();
			$result['news']=$query->result();
			return (isset($result) && !empty($result))? $result:array();

    }
    
     public function get_news_by_id($news_id)
    {
    	$query=$this->db->select('*')
    	->from('news')
    	->where('id',$news_id)
    	->get();
    	$result=$query->row();
    	return (isset($result) && !empty($result))? $result:array();


    }



    public function get_landmark_cat()
    {
    	$query=$this->db->select('id,cat_title,image')
			->from('landmark_category')
			->where('status','1')
			->order_by('id','DESC')
			->get();
			$result=$query->result();
			return (isset($result) && !empty($result))? $result:array();

    }

    public function get_landmarks()
    {
    	$query=$this->db->select('lm.*,lc.cat_title as category')
    	->from('landmarks as lm')
    	->join('landmark_category as lc','lc.id=lm.cat_id')
    	->where('lc.status','1')
    	->where('lm.status','1')
    	->get();
    	$result['landmarks']=$query->result();
		return (isset($result) && !empty($result))? $result:array();
	}


	public function get_slider()
	{
		$query=$this->db->select('id,image')
			->from('sliders')
			->where('status','1')
			->order_by('id','DESC')
			->limit(4)
			->get();
			$result['sliders']=$query->result();
			return (isset($result) && !empty($result))? $result:array();

	}



	public function create_folder($folder,$user_id)
	{
	    $folder=strtolower($folder);
		$path= 'uploads/documents/';
		if (!file_exists($path.$folder.'_'.$user_id)) 
        {
        	if(mkdir($path.$folder.'_'.$user_id, 0777, TRUE))
			{
				
				$data=array(
					'user_id'=>$user_id,
					'folder_name'=>$folder,
					'create_at'=>date("Y-m-d")

				);
				if($this->db->insert('documents',$data))
				{
					return array('status' => true,'folder_name' =>$folder,'folder_id'=>$this->db->insert_id(),'create_at'=>date('Y-m-d'));
				}

			}

        }else
        {
        	
        	return array('status' => false,'message' => 'directory already exist!');

        }

	}
	
	
	public function delete_folder($folder_id,$user_id)
	   {
		$query=$this->db->select('*')
		->from('documents')
		->where(array('id'=>$folder_id,'user_id'=>$user_id))
		->get();
		$row=$query->row();

		if($query->num_rows()>0)
		{

			$this->db->where(array('id'=>$folder_id,'user_id'=>$user_id));
			$query=$this->db->delete('documents');
			if($this->db->affected_rows() > 0)
			{
				$folder_path='uploads/documents/'.$row->folder_name.'_'.$user_id;
				
				 rmdir($folder_path);
				$this->db->where('document_id',$folder_id);
				$this->db->delete('document_images');
				return array('status'=>true,'message'=>'directory deleted successfully!');
			}else
			{
				return array('status'=>false,'message'=>'Unauthorized user!');

			}


		}
	       
	   }
	   
	   public function delete_file($image_id)
	{
		$query=$this->db->select('d.id as folder_id,d.user_id,d.folder_name,di.*')
		->from('document_images as di')
		->join('documents as d','di.document_id=d.id','left')
		->where('di.id',$image_id)
		->get()->row();
		
		// $folder_path='uploads/documents/'.$query->folder_name.'_'.$query->user_id;
		$this->db->where('id',$image_id);
		$this->db->delete('document_images');
		if($this->db->affected_rows()>0)
		{
			unlink($query->image);
			return array('status'=>true,'message'=>'file deleted successfully!');


		}
	}




	public function file_upload($folder_name,$file_name,$folder_id,$user_id)
	{
	   

  
	   //dumparray($file_name);
	   $folder_name=strtolower($folder_name);
		
		foreach ($file_name as $file) {
    	$image = $file;
        $path = "uploads/documents/".$folder_name.'_'.$user_id.'/'.time().'_'.generate_random_string(10).'.jpg';
        file_put_contents($path,base64_decode($image));
        $this->db->insert('document_images',array('document_id'=>$folder_id,'image'=>$path));
    		
    	}
    	return array('status'=>true,'message'=>'documents uploaded successfully');
    


	}




	public function get_documents($user_id)
	{
		if(is_numeric($user_id))
		{
		    
		    $query=$this->db->select('id,folder_name,create_at')
			->from('documents')
			->where('user_id',$user_id)
			->get();
			if($query->num_rows()>0)
			{
			foreach ($query->result() as $row) {
				$sql=$this->db->select('*')
				->from('document_images')
				->where('document_id',$row->id)
				->get();
			$count = 	$sql->num_rows();

			$results[]= array('id' => $row->id,
					'folder_name' => $row->folder_name,
					'create_at' =>  date("D\, M j\, 'y",strtotime($row->create_at)),
					'count' => $count );
				
			}
			}else
			{
			    return array('status'=>false,'message'=>'No doucments found!');
			}
			
			
			
			
			$result['folders']=$results;
            return (isset($result) && !empty($result))? $result:array();
		}

	}

	public function get_files($user_id,$folder_id)
	{

		$query=$this->db->select('*')
		->from('documents')
		->where(array('id'=>$folder_id,'user_id'=>$user_id))
		->get();

		if($query->num_rows()>0)
		{

			$sql=$this->db->select('di.id as image_id,di.document_id,di.image')
			->from('document_images as di')
			->where('di.document_id',$folder_id)
			->get();
			$result['documents']=$sql->result();
			return (isset($result) && !empty($result))? $result:array();

			
		}else
		{
			return array('status'=>false,'message'=>'invald!');

			
		}


	}
	
	public function get_message()
	{
		$query=$this->db->select('am.name,am.image,am.message,am.created_at')
		->from('ambassador_message as am')
		->get();
		 $result['message']=$query->result();
		 return (isset($result) && !empty($result))? $result:array();

   }
   
   
   public function get_download()
	{
		$query=$this->db->select('id,title,filename')
		->from('downloads')
		->order_by('create_at','DESC')
		->get();
		 $result['downloads']=$query->result();
		 return (isset($result) && !empty($result))? $result:array();

	}
	
	
	public function get_nep_currency()
	{
	    $query=$this->db->select('*')
		->from('settings')
		
		->get();
		 $result['currency']=round($query->row()->price,2);
		 return (isset($result) && !empty($result))? $result:array();

	    
	    
	    
	}
	
	public function create_sos($data)
	{
		if($this->db->insert('sos',$data))
		{
			return array('status'=>true,'name'=>$data['name'],'email'=>$data['email'],'phone'=>$data['phone']);
		}

	}


	public function get_sos($user_id)
	{
		$query=$this->db->select('*')
		->from('sos')
		->where('user_id',$user_id)
		->get();
		 $result['sos']=$query->result();
		 return (isset($result) && !empty($result))? $result:array();

	}
	
	
	
	public function send_now($user_id)
	{
	    $query=$this->db->select('name,email,phone')
	    ->from('sos')
	    ->where('user_id',$user_id)
	    ->or_where('user_id',0)
	    ->get();
	    $result=$query->result();
	    foreach($result as $row)
	    {
	        $data=array(
	            'name'=>$row->name,
	            'email'=>$row->email
	            
	            
	            );
	       $this->send_sos_mail($data,$user_id);
	                 
	    }
	    return array('status'=>true,'message'=>'Success!');
	    
	 }


	 public function get_sos_user($sos_id)
	 {
	 	$query=$this->db->select('id,name,email,phone')
	 	->from('sos')
	 	->where('id',$sos_id)
	 	->get();
	 	$result['edit_user']=$query->row();
	 	return (isset($result) && !empty($result))? $result:array();


	 }


	 public function update_sos_user($sos_user_id,$sos_data)
	 {
	 	$this->db->where('id',$sos_user_id);
	 	$this->db->update('sos',$sos_data);
	 	return array('status'=>true,'message'=>'User updated successfully!');


	 }

	 public function delete_sos($user_id,$sos_id)
	 {

		$this->db->where(array('id'=>$sos_id,'user_id'=>$user_id));
		$this->db->delete('sos');
		return array('status'=>true,'message'=>'User deleted successfully!');
	 }

	
	
	
	public function send_sos_mail($user_info,$user_id)
	{
	    $this->db->where('id',$user_id);
	    $uinfo=$this->db->get('users')->row();
	    
	    
	    $From =$uinfo->email;

        $Name = $user_info['name'];

        $Email = $user_info['email'];
        

        $this->load->library('My_PHPMailer');

        $mails = new PHPMailer();

        $mails->SetFrom($From, $uinfo->full_name);

        $mails->AddReplyTo($From,$uinfo->full_name);

        $destino = $Email;

        $mails->AddAddress($destino,$uinfo->full_name);

        $mails->Subject =$uinfo->full_name. " Need Emergency Help!";

		$message = '<strong>Dear ' . $Name . ',</strong><br><br>';

        $message.='<p>Please <strong>Help me, I AM IN TROUBLE!</strong></p>';
       
        $mails->Body = $message;

        $mails->AltBody = "Email Verification Information from " . config_item('site_email');

        if ($mails->send()) {
            
            return true;
        } else {

       return false;
            
        }
	    
	 }
	 
	 
	 public function get_press()
	 {
	     $today=date('Y-m-d');
	     $query=$this->db->select('id,title,publish_at')
			->from('press_realese')
			->where('status','1')
			->where('publish_at<=',$today)
			->order_by('publish_at','DESC')
			->get();
			$result['press_realese']=$query->result();
			return (isset($result) && !empty($result))? $result:array();
	     
	     
	     
	 }
	 
	 
	 public function get_press_by_id($id)
	 {
	     $query=$this->db->select('*')
			->from('press_realese')
			->where('id',$id)
			
			->get();
			$result['press_details']=$query->row();
			return (isset($result) && !empty($result))? $result:array();
	     
	     
	 }


	 public function get_counselor_affair()
	 {
	 	$query=$this->db->select('id,title,description,image')
		->from('counselor')
		// ->where('status',1)
		->order_by('priority','ASC')
		->get();
		 $result['counselor']=$query->result();
		 return (isset($result) && !empty($result))? $result:array();
	 }


	 public function get_status()
	 {
	 	$query=$this->db->select('*')
		->from('settings')
		->where('id',1)
		
		->get();
		 $result['online_status']=$query->row()->login_status;
		 return (isset($result) && !empty($result))? $result:array();

	 }

	 public function save_chat_message($data)
	 {
	 	$this->db->insert('chat_messages',$data);
	 	return array('status'=>true,'message'=>'Your message is sent!');


	 }


	 public function get_messages($user_id)
	 {
	 	$query=$this->db->select('*')
		->from('chat_messages')
		->where('sent_to',$user_id)
		->where('sent_by',0)
		->order_by('created_at','DESC')
		->get();
		$result=array();

		foreach ($query->result() as $k => $v) {
			if($v->sent_by==0)
			{
				$sent_by="Admin";
			}
			$v->created_at=date("F j\, Y h:i:sA",$v->created_at);
			$result['chat_messages']=array(
				'id'=>$v->id,
				'sent_by'=>$sent_by,
			 	'message'=>$v->message,
			 	'sent_date'=>$v->created_at

			)

			
		}
		 
		 return (isset($result) && !empty($result))? $result:array();
	}


	public function get_notifications()
	{

		$query=$this->db->select('id,title,message,created_at')
		->from('notifications')
		->order_by('created_at','DESC')
		->get();
		 $result['notifications']=$query->result();
		 return (isset($result) && !empty($result))? $result:array();


	}



	// public function get_documents($user_id)
	// {
	// 	// $query=$this->db->select('d.*,di.id as image_id,di.image')
	// 	// ->from('documents as d')
	// 	// ->join('document_images as di','di.document_id=d.id')
	// 	// ->where('d.user_id',$user_id)
	// 	// ->get();

	// 	$query=$this->db->select('d.*')
	// 	->from('documents as d')
	// 	->where('d.user_id',$user_id)
	// 	->get();
	// 	$result=$query->result();
	// 	foreach ($result as $key => $value) {
	// 		$query2 = $this->db->select('*')
	// 		->from('document_images')
	// 		->where('document_id',$value->id)
	// 		->get();
	// 		$images = $query2->result();
	// 		$img = array();

	// 		foreach ($images as $key1 => $value1) {
	// 			$img[] = array('id'=> $value1->id,
	// 						'image' => $value1->image);
	// 		}



	// 		$newArray[] = array('id' => $value->id,
	// 							'folder_name' => $value->folder_name,
	// 							'count' => count($images),
	// 							'images' => $img );
	// 	}

	// 	return $newArray;


	// 	// return (isset($result) && !empty($result))? $result:array();
	// }


// 	  public function uploadMultipleFiles($folder) {
//         $files = $_FILES;
//         $image_name = array();
//         if (!empty($files['userfile']['name'][0])) {
           
//             $this->load->library('upload', $this->set_upload_options($folder));
//             $count = count($_FILES['userfile']['name']);
//             for ($i = 0; $i < $count; $i++) {
//                 $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
//                 $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
//                 $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
//                 $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
//                 $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

//                 $this->upload->initialize($this->set_upload_options($folder));
//                 if ($this->upload->do_upload() == false) {
//                     $error = array('error' => $this->upload->display_errors());
//                print_r($error);exit;
//                 }
//                 $imginfo = $this->upload->data();
//                 // echo "<pre>";
//                 // print_r($imginfo)
// ;                $imgname = $imginfo['raw_name'] . $imginfo['file_ext'];
              
//                 $image_name[] = ($imgname);

          

               
//             }


//         }
        
//             return $image_name;
        
//     }

//     private function set_upload_options($folder) {
//         $this->load->helper('string');
//         $file = time() . '_' . random_string('alnum', 2);
//         //upload an image options
//         $config = array();
//         $config['upload_path'] = './uploads/documents/' . $folder;
//         $config['allowed_types'] = 'gif|jpg|png|jpeg|svg|jpeg';
//         $config['max_size'] = 0;
//         $config['file_name'] = $file;
//         $config['overwrite'] = TRUE;
//         return $config;
//     }




	 
	


}