<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Event extends MX_Controller
{

	private $table='events';
    private $module='Event';
    private $title='Events';
    private $nav = 'news';

//=========================================================================================================================

	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('event_model');
		 $this->load->model('general_model','general');

	}


//==========================================================================================================================

	public function index()
	{

		$data['nav']=$this->nav;
        $data['title']=$this->title;
		$data['table_name']='<strong>Event</strong> List';
		$data['button_action']='admin/event/create';
        $data['button']='Add Event';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Event','Event List'=>'');
        $data['edit']=base_url().'/admin/event/edit/';
        $data['delete']=base_url().'/admin/event/delete/';
        $data['fields']=array('SN','Name','Start Date','End Date','Action');
        $records=$this->event_model->getAll($this->table);
        foreach ($records as $k=>$v) {
            $v->start_date=user_format($v->start_date);
            $v->end_date=user_format($v->end_date);

            
        }

        if(FALSE!=$records):
            $records=check_status($records);
        endif;
       
        $data['datas']=$records;
       
       $this->template->load('template','view_list',$data);

	}

//==========================================================================================================================


	public function create()
	{

        $data['nav']=$this->nav;
	    $data['title']="Add New Event";
        $data['table_name']="<strong>Add</strong> Event";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Event','Add Event'=>'');
        $data['action']='admin/event/createAction';
        // $data['cat_id']="";
        // $data['options']=get_counselor_categories();
		$this->template->load('template','create_event',$data);

    	
	}


	public function  createAction()
	{
            $this->form_validation->set_rules('name','Event Name','required');
            $this->form_validation->set_rules('address','Address','required');
            $this->form_validation->set_rules('phone','Contact Number','required');
           
			if($this->form_validation->run()==FALSE)
			{
				
				$this->create();

			}else
			{


                $data=$this->input->post();

                
                if(!empty($_FILES['userfile']['name']))
                {
                    $file_name=$this->general->do_upload('news_events');
                    $data['image']=$file_name;
                }

				$this->general->insert($this->table, $data);
				$task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
		        $status = 'success';
		        set_message($status,$task);
		        redirect(base_url().'admin/event');




			}
		}

//=========================================================================================================================
	
	public function edit($id)
   	{

	    $data['nav']=$this->nav;
	    $data['title']="Edit Counselor";
        $data['table_name']="<strong>Edit</strong> Event";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Event','Edit Event'=>'');
	    $data['action']='admin/event/update/'.$id;
	    $data['datas']=$this->event_model->get($this->table,$id);
	    // $data['cat_id']=$data['datas']->cat_id;
     //    $data['options']=get_counselor_categories();

	        if(empty($data['datas']))
	        {
	            redirect('admin/error404');
	        }
	        else
	        {
	            $this->template->load('template','create_event',$data);
	        }

     }



	public function update($id)
	{
    
	    $data=$this->input->post();


        if(isset($_FILES) && $_FILES['userfile']['name']!='')
        {
            $file_name=$this->general->do_upload('news_events');
            $this->general->unlink_img('news_events',$this->input->post('prev_image'));
            $this->general->unlink_img('news_events/thumbs',$this->input->post('prev_image'));
           
        }
        else
        {
            $file_name=$this->input->post('prev_image');
        }
        $data['image']=$file_name;
        unset($data['prev_image']);
   
	    $this->general->update($this->table,$data,array('id'=>$id));
	    $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
	    $status = 'success';
	    set_message($status,$task);
	    redirect(base_url('admin').'/'.$this->module);

  	}

 //=======================================================================================================================

	 public function delete($id)
	 {
	    $this->general->del_image($this->table,array('id' => $id),'news_events');
         
	    $this->general->delete($this->table,array('id'=>$id));
	    redirect('admin/event');
	 }


 



   

   





}