<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Notification extends MX_Controller
{

	private $table='notifications';
    private $module='notification';
    private $title='Push Notification';
    private $nav = 'notification';

//=========================================================================================================================

	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
         $this->load->model('general_model','general');
		 $this->load->model('notification_model');
		

	}


//==========================================================================================================================

	public function index()
	{
		$data['nav']=$this->nav;
        $data['title']=$this->title;
		$data['table_name']='<strong>Notification</strong> List';
		$data['button_action']='admin/notification/create';
        $data['button']='Add Notification';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Notification','Notification List'=>'');
        $data['edit']=base_url().'/admin/notification/edit/';
        $data['delete']=base_url().'/admin/notification/delete/';
        $data['fields']=array('SN','Title','Created Date','Action');
        $records=$this->notification_model->getAll($this->table);
        $data['datas']=$records;
        foreach ($data['datas'] as $key => $value) {
                    $value->created_at=user_format($value->created_at);
                }

       $this->template->load('template','view_list',$data);

	}

//==========================================================================================================================


	public function create()
	{

		$data['nav']=$this->nav;
	    $data['title']=$this->title;
        $data['table_name']="<strong>Add</strong> Notification";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Notification','Add Notification'=>'');
        $data['action']='admin/notification/createAction';
        
		$this->template->load('template','create_notification',$data);

    	
	}


	public function  createAction()
	{

            $this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('message','Message','required');
			if($this->form_validation->run()==FALSE)
			{
				
				$this->create();

			}
            else
			{
                $data=$this->input->post();

                /*for push notification, device token is from database*/
                $deviceToken=$this->notification_model->get_device_token();
                //dumparray($deviceToken);
                //botton fields haru same hunxa for push notification
                $fields = array(
                'registration_ids' => $deviceToken,
                'data' => array('title' => $data['title'],'message' => $data['message']
        			 ));

                $this->pushMessage($fields);
                
                $this->general->insert($this->table, $data);
				$task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
		        $status = 'success';
		        set_message($status,$task);
		        redirect(base_url().'admin/notification');




			}
		}

//=========================================================================================================================
	
	public function edit($id)
   	{

	    $data['nav']=$this->nav;
	    $data['title']="Edit Notification";
        $data['table_name']="<strong>Edit</strong> Notification";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Notification','Edit Notification'=>'');
	    $data['action']='admin/notification/update/'.$id;
	    $data['datas']=$this->notification_model->get($this->table,$id);
	   

	        if(empty($data['datas']))
	        {
	            redirect('admin/error404');
	        }
	        else
	        {
	            $this->template->load('template','create_notification',$data);
	        }

     }



	public function update($id)
	{
    
	    $data=$this->input->post();
        $this->general->update($this->table,$data,array('id'=>$id));
	    $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
	    $status = 'success';
	    set_message($status,$task);
	    redirect(base_url('admin').'/'.$this->module);

  	}

 //=======================================================================================================================

	 public function delete($id)
	 {
	    $this->general->delete($this->table,array('id'=>$id));
	    redirect('admin/notification');
	 }




	 function pushMessage($fields){
		
		$path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';
		/*authroization key is from mobile FIREBASE CLOUD MESSAGING */
		$headers = array(
            'Authorization:key=' . 'AAAAy6HwnR0:APA91bEvNJbaNyfIOrfWjEcM1Q9IDd8Ho7_r5WVg0E0WLy0zYfJTy1HZT5tcFxKwCtaxbbWZytr_s0hxvFUt_Jf5Ta2VgiHJpr1h49Gj-5e2x-ogs2bIMsjBVrTknye1IYH630Qjdkqt',
            'Content-Type:application/json'
        );
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        //dumparray($result);

        curl_close($ch);


    }





   





}