<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Counselor extends MX_Controller
{

	private $table='counselor';
    private $module='counselor';
    private $title='Counselor Affair';
    private $nav = 'con_affair';

//=========================================================================================================================

	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('counselor_model');
		 $this->load->model('general_model','general');

	}


//==========================================================================================================================

	public function index()
	{
		$data['nav']=$this->nav;
        $data['title']=$this->title;
		$data['table_name']='<strong>Counselor</strong> List';
		$data['button_action']='admin/counselor/create';
        $data['button']='Add Counselor';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Counselor','Counselor List'=>'');
        $data['edit']=base_url().'/admin/counselor/edit/';
        $data['delete']=base_url().'/admin/counselor/delete/';
        $data['fields']=array('SN','Title','Category','Action');
        $records=$this->counselor_model->getAll($this->table);

        // if(FALSE!=$records):
        //     $records=check_status($records);
        // endif;
       
        $data['datas']=$records;
       $this->template->load('template','view_list',$data);

	}

//==========================================================================================================================


	public function create()
	{

        $data['nav']=$this->nav;
	    $data['title']="Add New Landmark";
        $data['table_name']="<strong>Add</strong> Counselor";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Counselor','Add Counselor'=>'');
        $data['action']='admin/counselor/createAction';
        $data['cat_id']="";
        $data['options']=get_counselor_categories();
		$this->template->load('template','create_counselor',$data);

    	
	}


	public function  createAction()
	{
            $this->form_validation->set_rules('title','Title','required');
			if($this->form_validation->run()==FALSE)
			{
				
				$this->create();

			}else
			{


                $data=$this->input->post();
                
                if(!empty($_FILES['userfile']['name']))
                {
                    $file_name=$this->general->do_upload('counselor');
                    $data['image']=$file_name;
                }

				$this->general->insert($this->table, $data);
				$task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
		        $status = 'success';
		        set_message($status,$task);
		        redirect(base_url().'admin/counselor');




			}
		}

//=========================================================================================================================
	
	public function edit($id)
   	{

	    $data['nav']=$this->nav;
	    $data['title']="Edit Counselor";
        $data['table_name']="<strong>Edit</strong> Counselor";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Counselor','Edit Counselor'=>'');
	    $data['action']='admin/counselor/update/'.$id;
	    $data['datas']=$this->counselor_model->get($this->table,$id);
	    $data['cat_id']=$data['datas']->cat_id;
        $data['options']=get_counselor_categories();

	        if(empty($data['datas']))
	        {
	            redirect('admin/error404');
	        }
	        else
	        {
	            $this->template->load('template','create_counselor',$data);
	        }

     }



	public function update($id)
	{
    
	    $data=$this->input->post();


        if(isset($_FILES) && $_FILES['userfile']['name']!='')
        {
            $file_name=$this->general->do_upload('counselor');
            $this->general->unlink_img('counselor',$this->input->post('prev_image'));
            $this->general->unlink_img('counselor/thumbs',$this->input->post('prev_image'));
           
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
	    $this->general->del_image('counselor',array('id' => $id),'counselor');
         
	    $this->general->delete($this->table,array('id'=>$id));
	    redirect('admin/counselor');
	 }


 //=======================================================================================================================

public function category()
    {
        $data['nav']=$this->nav;
        $data['title']="Counselor Category";
        $data['button_action']='admin/counselor/create_category';
        $data['button']='Add Category';
        $data['table']='Category List';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','Counselor'=>'Category','Category List'=>'');
        $data['edit']=base_url().'admin/counselor/edit_category/';
        $data['delete']=base_url().'admin/counselor/delete_category/';
        $data['fields']=array('SN','Title','Slug','Priority','Status','Action');
        $records=$this->counselor_model->getCategory();
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
        $data['action']='admin/counselor/add_category';
        $this->template->load('template','create_counselor_category',$data);
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


                   // $logo_name=$this->general->upload_file('counselor/category');
                    $logo_name=$this->general->do_upload('counselor');
                    $data['image']=$logo_name;

                }

			    $data['slug']=($data['slug']=="")? url_title($data['cat_title'],'-',TRUE):$data['slug'];
			    
                $this->general->insert('counselor_category', $data);
                $task = "<div class='alert alert-success'><strong>Success!</strong> Category added successfully.</div>";
                $status = 'success';
                set_message($status,$task);
                redirect(base_url().'admin/counselor/category');
            }
    }

//==================================================================================================================
    
   public function edit_category($id)
     {
        $data['nav']=$this->nav;
        $data['title']="Edit Category";
        $data['table_name']="<strong>Edit</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Counselor','Edit Category'=>'');
        $data['action']='admin/counselor/update_category/'.$id;
        $data['datas']=$this->counselor_model->getCatById($id);

        if(empty($data['datas']))
            {
                redirect('admin/error404');
            }
            else
            {
                $this->template->load('template','create_counselor_category',$data);
            }
        }


     public function update_category($id)
     {
        $data=$this->input->post();
            if(isset($_FILES) && $_FILES['userfile']['name']!='')
            {
                //$logo_name=$this->general->upload_file('landmark/category');
                $logo_name=$this->general->do_upload('counselor');
                $this->general->unlink_img('counselor/thumbs',$this->input->post('prev_image'));
                $this->general->unlink_img('counselor',$this->input->post('prev_image'));
               
            }
            else
            {
                $logo_name=$this->input->post('prev_image');
            }
            $data['image']=$logo_name;
            unset($data['prev_image']);
            $data['slug']=($data['slug']=="")? url_title($data['cat_title'],'-',TRUE):$data['slug'];
            $this->general->update('counselor_category',$data,array('id'=>$id));
            $task = "<div class=' alert alert-success'><strong>Success!</strong> Category updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.'counselor/category');
     }


//=======================================================================================================
    
    public function delete_category($id)
    {
     $this->general->del_image('counselor_category',array('id' => $id),'counselor/category');
     $this->general->del_image('counselor_category',array('id' => $id),'counselor');
     $this->general->delete('counselor_category',array('id'=>$id));
     redirect('admin/counselor/category');

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