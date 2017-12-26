<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Notice extends MX_Controller
{
	private $table='notices';
    private $module='notice';
    private $title='Notice Manage';
    private $nav = 'notice';

//=========================================================================================================   
	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('notice_model');
         $this->load->model('general_model','general');
         $this->form_validation->CI= &$this;

	}


//=======================================================================================================

	public function index()
	{
        $data['nav']=$this->nav;
        $data['title']=$this->title;
        $data['table_name']='<strong>Notice</strong> List';
        $data['button_action']='admin/notice/create';
        $data['button']='Add Notice';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Notice','Notice List'=>'');
        $data['edit']=base_url().'admin/notice/edit/';
        $data['delete']=base_url().'admin/notice/delete/';
        $data['fields']=array('SN','Title','Status','Action');
        $records=$this->notice_model->getAll($this->table);
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
        // foreach ($records as $key => $value) {
        //     $records[$key]->publish_date=user_format($value->publish_date);
        // }

        $data['datas']=$records;
       $this->template->load('template','view_list',$data);

	}


//========================================================================================================

    public function create()
    {
        $data['nav']=$this->nav;
        $data['title']="Add Notice";
        $data['table_name']="<strong>Add</strong> Notice";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Notice','Add Notice'=>'');
        $data['action']='admin/notice/createAction';
        $this->template->load('template','create_notice',$data);


    }



    public function createAction()
    {
       
       

            $this->form_validation->set_rules('title','Notice Title','required');
            $this->form_validation->set_rules('content','Notice Contents','required');
            
            if($this->form_validation->run()==FALSE)
            {
                
                $this->create();

            }else
            {
                $data=$this->input->post();
                if(!empty($_FILES['userfile']['name']))
                {
                    $file_name=$this->general->do_upload('notice');
                    $data['image']=$file_name;
                }
                
                $this->general->insert($this->table, $data);
                $task = "<div class='alert alert-success'><strong>Success!</strong> ".$this->module . " added successfully.</div>";
                $status = 'success';
                set_message($status,$task);
                redirect(base_url().'admin/notice');

            }

     }




//=======================================================================================================

     public function edit($id)
     {
        $data['nav']=$this->nav;
        $data['title']="Edit Notice";
        $data['table_name']="<strong>Edit</strong> Notice";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Notice','Edit Notice'=>'');
        $data['action']='admin/notice/update/'.$id;
        $data['datas']=$this->notice_model->get($this->table,$id);
        $this->template->load('template','create_notice',$data);

     }



     public function update($id)
     {
             $this->form_validation->set_rules('title','Notice Title','required');
            $this->form_validation->set_rules('content','Notice Contents','required');
            
            if($this->form_validation->run()==FALSE)
            {
                
                $this->edit($id);

            }else
            {
                $data=$this->input->post();
                 if(isset($_FILES) && $_FILES['userfile']['name']!='')
                    {
                        $file_name=$this->general->do_upload('notice');
                        $this->general->unlink_img('notice',$this->input->post('prev_image'));
                        $this->general->unlink_img('notice/thumbs',$this->input->post('prev_image'));
                       
                    }
                    else
                    {
                        $file_name=$this->input->post('prev_image');
                    }
                $data['image']=$file_name;
                unset($data['prev_image']);
               
                // if(!isset($data['status']))
                // {
                //     $data['status']='unpublish';
                // }

        
                
        
            $this->general->update($this->table,$data,array('id'=>$id));
            $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.$this->module);
    }
     }


//=======================================================================================================
     
    public function delete($id)
     {
        $this->general->del_image('notices',array('id' => $id),'notice');
         
        $this->general->delete($this->table,array('id'=>$id));
        redirect('admin/notice');
     }




}