<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Landmark extends MX_Controller
{

	private $table='landmarks';
    private $module='Landmark';
    private $title='Landmark Manage';
    private $nav = 'landmark';

//=========================================================================================================================

	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('landmark_model');
		 $this->load->model('general_model','general');

	}


//==========================================================================================================================

	public function index()
	{
		$data['nav']=$this->nav;
        $data['title']=$this->title;
		$data['table_name']='<strong>Landmark</strong> List';
		$data['button_action']='admin/landmark/create';
        $data['button']='Add Landmark';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Landmark List'=>'');
        $data['edit']=base_url().'/admin/landmark/edit/';
        $data['delete']=base_url().'/admin/landmark/delete/';
        $data['fields']=array('SN','Title','Category','Status','Action');
        $records=$this->landmark_model->getAll($this->table);
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
	    $data['title']="Add New Landmark";
        $data['table_name']="<strong>Add</strong> Landmark";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Add Landmark'=>'');
        $data['action']='admin/landmark/createAction';
        $data['cat_id']="";
        $data['options']=get_landmark_categories();
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
                
                if(!empty($_FILES['userfile']['name']))
                {
                    $logo_name=$this->general->upload_file('landmark');
                    $data['image']=$logo_name;
                }

				$this->general->insert($this->table, $data);
				$task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
		        $status = 'success';
		        set_message($status,$task);
		        redirect(base_url().'admin/landmark');




			}
		}

//=========================================================================================================================
	
	public function edit($id)
   	{

	    $data['nav']=$this->nav;
	    $data['title']="Edit Landmark";
        $data['table_name']="<strong>Edit</strong> Landmark";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Edit Landmark'=>'');
	    $data['action']='admin/landmark/update/'.$id;
	    $data['datas']=$this->landmark_model->get($this->table,$id);
	    $data['cat_id']=$data['datas']->cat_id;
        $data['options']=get_landmark_categories();

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


        if(isset($_FILES) && $_FILES['userfile']['name']!='')
        {
            $logo_name=$this->general->upload_file('landmark');
            $this->general->unlink_img('landmark',$this->input->post('prev_image'));
           
        }
        else
        {
            $logo_name=$this->input->post('prev_image');
        }
        $data['image']=$logo_name;
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
	    $this->general->del_image('landmarks',array('id' => $id),'landmark');
	    $this->general->delete($this->table,array('id'=>$id));
	    redirect('admin/landmark');
	 }


 //=======================================================================================================================

public function category()
    {
        $data['nav']=$this->nav;
        $data['title']="Landmark Category";
        $data['button_action']='admin/landmark/create_category';
        $data['button']='Add Category';
        $data['table']='Category List';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','Landmark'=>'Category','Category List'=>'');
        $data['edit']=base_url().'admin/landmark/edit_category/';
        $data['delete']=base_url().'admin/landmark/delete_category/';
        $data['fields']=array('SN','Title','Slug','Priority','Status','Action');
        $records=$this->landmark_model->getCategory();
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
        $data['datas']=$records;
        $this->template->load('template','view_list',$data);
    }

//================================================================================================================

    public function create_category()
    {
        $data['nav']=$this->nav;
        $data['title']="Add New Category";
        $data['table_name']="<strong>Add</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Add Category'=>'');
        $data['action']='admin/landmark/add_category';
        $this->template->load('template','create_landmark_category',$data);
    }


    public function add_category()
    {
        $this->form_validation->set_rules('cat_title','Category Title','required');
         if($this->form_validation->run()==FALSE)
            {
                
                $this->create_category();

            }else
            {
			    $data=$this->input->post();

                 if(!empty($_FILES['userfile']['name']))
                {
                    $logo_name=$this->general->upload_file('landmark/category');
                    $data['image']=$logo_name;

                }

			    $data['slug']=($data['slug']=="")? url_title($data['cat_title'],'-',TRUE):$data['slug'];
			    
                $this->general->insert('landmark_category', $data);
                $task = "<div class='alert alert-success'><strong>Success!</strong> Category added successfully.</div>";
                $status = 'success';
                set_message($status,$task);
                redirect(base_url().'admin/landmark/category');
            }
    }

//==================================================================================================================
    
   public function edit_category($id)
     {
        $data['nav']=$this->nav;
        $data['title']="Edit Category";
        $data['table_name']="<strong>Edit</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Landmark','Edit Category'=>'');
        $data['action']='admin/landmark/update_category/'.$id;
        $data['datas']=$this->landmark_model->getCatById($id);
        if(empty($data['datas']))
            {
                redirect('admin/error404');
            }
            else
            {
                $this->template->load('template','create_landmark_category',$data);
            }
        }


     public function update_category($id)
     {
        $data=$this->input->post();
            if(isset($_FILES) && $_FILES['userfile']['name']!='')
            {
                $logo_name=$this->general->upload_file('landmark/category');
                $this->general->unlink_img('landmark/category',$this->input->post('prev_image'));
               
            }
            else
            {
                $logo_name=$this->input->post('prev_image');
            }
            $data['image']=$logo_name;
            unset($data['prev_image']);
            $data['slug']=($data['slug']=="")? url_title($data['cat_title'],'-',TRUE):$data['slug'];
            $this->general->update('landmark_category',$data,array('id'=>$id));
            $task = "<div class=' alert alert-success'><strong>Success!</strong> Category updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.'landmark/category');
     }


//=======================================================================================================
    
    public function delete_category($id)
    {
     $this->general->del_image('landmark_category',array('id' => $id),'landmark/category');
     $this->general->delete('landmark_category',array('id'=>$id));
     redirect('admin/landmark/category');

    }


//========================================================================================================

public function upload_logo()
{

$photo_src = $_FILES['photo']['tmp_name'];
// test if the photo realy exists
if (is_file($photo_src)) {
    // photo path in our example
    $photo_dest = base_url().'nio/uploads/landmark/logo_'.time().'.jpg';
    // copy the photo from the tmp path to our path
    copy($photo_src, $photo_dest);
    // call the show_popup_crop function in JavaScript to display the crop popup
    echo '<script type="text/javascript">window.top.window.show_popup_crop("'.$photo_dest.'")</script>';
}


}    

   





}