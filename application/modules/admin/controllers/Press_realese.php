<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Press_realese extends MX_Controller
{

	private $table='press_realese';
    private $module='press';
    private $title='Press Realese';
    private $nav = 'press';
    private $file_folder="press_realese";

//=========================================================================================================================

	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('press_model');
         $this->load->model('general_model','general');

	}


//==========================================================================================================================

	public function index()
	{
		$data['nav']=$this->nav;
        $data['title']=$this->title;
		$data['table_name']='<strong>Press</strong> List';
		$data['button_action']='admin/press_realese/create';
        $data['button']='Add New';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'press_realese','Press List'=>'');
        $data['edit']=base_url().'/admin/press_realese/edit/';
        $data['delete']=base_url().'/admin/press_realese/delete/';
        $data['fields']=array('SN','Title','Publish Date','Status','Action');
        $records=$this->press_model->getAll($this->table);
        foreach ($records as $record) {
            $record->publish_at=user_format($record->publish_at);
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
	    $data['title']="Create Press";
        $data['table_name']="<strong>Add</strong> New";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'press_realese','Add New'=>'');
        $data['action']='admin/press_realese/createAction';
        $this->template->load('template','create_press_realese',$data);

    	
	}

    public function  createAction()
	{
            $this->form_validation->set_rules('title','Title','required');
            $this->form_validation->set_rules('description','Description','required');
            $this->form_validation->set_rules('publish_at','Publish Date','required');
			if($this->form_validation->run()==FALSE)
			{
			    $this->create();

			}else
			{

                $data=$this->input->post();
                if(!empty($_FILES['userfile']['name']))
                {
                   $fname=$this->press_model->file_upload($this->file_folder);
                   $data['filename']=$fname;
                }

				$this->general->insert($this->table, $data);
				$task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
		        $status = 'success';
		        set_message($status,$task);
		        redirect(base_url().'admin/press_realese');




			}
		}

//=========================================================================================================================
	
	public function edit($id)
   	{

	    $data['nav']=$this->nav;
	    $data['title']="Edit Press Realese";
        $data['table_name']="<strong>Edit</strong> Press Realese";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'press_realese','Edit Press Realese'=>'');
	    $data['action']='admin/press_realese/update/'.$id;
	    $data['datas']=$this->press_model->get($this->table,$id);
	   if(empty($data['datas']))
        {
            redirect('admin/error404');
        }
        else
        {
            $this->template->load('template','create_press_realese',$data);
        }

     }



	public function update($id)
	{
        $data=$this->input->post();
        if(isset($_FILES) && $_FILES['userfile']['name']!='')
        {
            $fname=$this->press_model->file_upload($this->file_folder);
            $this->general->unlink_file($this->file_folder,$this->input->post('prev_file'));
           
        }
        else
        {
            $fname=$this->input->post('prev_file');
        }
       
       unset($data['prev_file']);
       $data['filename']=$fname;
       
       
   
	    $this->general->update($this->table,$data,array('id'=>$id));
	    $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
	    $status = 'success';
	    set_message($status,$task);
	    redirect(base_url('admin/press_realese'));

  	}

 //=======================================================================================================================

	 public function delete($id)
	 {
	   $this->press_model->delete_file($this->table,array('id' => $id), $this->file_folder);
       $this->press_model->delete($this->table,$id);
       redirect('admin/press_realese');
	 }


 
   





}