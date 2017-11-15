<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Landmark extends MX_Controller
{

	private $table='landmarks';
    private $module='Landmark';
    private $title='Landmark Manage';
    private $nav = '';

//====================================================================================================

	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('landmark_model');
		 $this->load->model('general_model','general');

	}


//====================================================================================================

	public function index()
	{

		$data['title']=$this->title;
		$data['table_name']='<strong>Landmark</strong> List';
		$data['button_action']='admin/landmark/create';
        $data['button']='Add Landmark';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Landmark List'=>'');
        $data['edit']=base_url().'/admin/landmark/edit/';
        $data['delete']=base_url().'/admin/landmark/delete/';
        $data['fields']=array('SN','Title','Status','Action');
        $records=$this->landmark_model->getAll($this->table);
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
       
        $data['datas']=$records;
       $this->template->load('template','view_list',$data);

	}

//====================================================================================================


	public function create()
	{

        $data['title']="Add New Landmark";
        $data['table_name']="<strong>Add</strong> Landmark";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Add Landmark'=>'');
        $data['action']='admin/landmark/createAction';
		$this->template->load('template','create_landmark',$data);

    	
	}


	public function  createAction()
	{

			$this->form_validation->set_rules('title','Title','required');
			$this->form_validation->set_rules('email','Email','required|valid_email');
			$this->form_validation->set_rules('address','Address','required');

			if($this->form_validation->run()==FALSE)
			{
				
				$this->create();

			}else
			{
				$data=$this->input->post();
				$this->general->insert($this->table, $data);
				$task = "<div class='alert bg-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
		        $status = 'success';
		        set_message($status,$task);
		        redirect(base_url().'admin/landmark');

			}
		}

//====================================================================================================
	
	public function edit($id)
   	{
	   
	    $data['title']="Edit Landmark";
        $data['table_name']="<strong>Edit</strong> Landmark";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Edit Landmark'=>'');
	    $data['action']='admin/landmark/update/'.$id;
	    $data['datas']=$this->landmark_model->get($this->table,$id);

	        if(empty($data['datas']))
	        {
	            redirect('admin/error404');
	        }
	        else
	        {
	            $this->template->load('template','create_landmark',$data);
	        }

     }



	public function update($id)
	{
    
	    $data=$this->input->post();
	    $this->general->update($this->table,$data,array('id'=>$id));
	    $task = "<div class='alert bg-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
	    $status = 'success';
	    set_message($status,$task);
	    redirect(base_url('admin').'/'.$this->module);

  	}

 //====================================================================================================

 function delete($id)
 {
    
    $this->general->delete($this->table,array('id'=>$id));
    redirect('admin/landmark');
 }





}