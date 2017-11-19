<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed!');
class Page extends MX_Controller
{
	private $table='pages';
    private $module='Page';
    private $title='Page Manage';
    private $nav = 'page';

//==========================================================================================================================
	
    public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('page_model');
        $this->load->model('general_model','general');
         check_admin_login();
	}

//===========================================================================================================================

   public function index()
	{
        $data['nav']=$this->nav;
		$data['title'] = 'Page List';
        $data['button'] = 'Add New Page';
        $data['button_action'] ='admin/page/create';
        $data['module'] = $this->module;
        $data['breadcrumb'] = array('Dashboard' => 'Dashboard', $data['module'] => 'Page', 'Page List' => '');
        $data['table_name'] = '<strong>Page</strong> List';
        $data['edit'] = base_url().'admin/page/edit/';
        $data['delete'] = base_url().'admin/page/delete/';
        $data['fields'] = array('SN', 'Title', 'Slug','Category','Action');
        $data['datas'] = $this->page_model->getAll();
        $this->template->load('template', 'view_list', $data);

        
	}

//===========================================================================================================================

     public function  create()
      {
        $data['nav']=$this->nav;
    	$data['title']='Create Page';
    	$data['module']=$this->module;
        $data['breadcrumb']=array('dashboard'=>'dashboard',$data['module']=>'Page','Create Page'=>'');
    	$data['table_name']='<strong>Create</strong> Page';
		$data['action'] = 'admin/page/create';
        $data['nav_id']="";
        $data['options']=get_navigation_list();
        

		if($this->input->post()):
        	$data=$this->input->post();

         $page_data=array
            (
                'title'=>$data['title'],
                'nav_id'=>$data['nav_id'],
                'status'=>$data['status'],
                'content' =>$data['content'],
                'image_link' => $data['image_link'],
                'meta_title' => $data['meta_title'],
                'meta_keywords' => $data['meta_keywords'],
                'meta_description' => $data['meta_description'],
                'created_by' =>$this->session->userdata('admin_user')['user_id']
                );
        //creating auto slug
        $page_slug=$this->input->post('slug');
        $page_title=$data['title'];
        $page_data['slug']=($page_slug=='')? url_title($page_title,'-',TRUE):$page_slug;
        save('pages',$page_data);
        redirect(base_url().'admin/page');
        else:
        $this->template->load('template','create_page',$data);
        endif;
    }



//============================================================================================================================

  public function edit($id)
    {
        $data['nav']=$this->nav;
    	$data['title'] = 'Edit Page';
        $data['module'] = $this->module;
        $data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => 'Page', 'Edit Page' => '');
        $data['table_name'] = '<strong>Page</strong> Edit';
		$data['action'] ='admin/page/update/' . $id;
        $data['datas']=$this->page_model->getPageById($id);
        $data['nav_id']=$data['datas']->nav_id;
        $data['options']=get_navigation_list();
        $this->template->load('template','create_page',$data);



    }



    public function update($id)
    {
    	$data = $this->input->post();
        $page_data=array
            (
                'title'=>$data['title'],
                'nav_id'=>$data['nav_id'],
                'status'=>$data['status'],
                'content' =>$data['content'],
                'image_link' => $data['image_link'],
                'meta_title' => $data['meta_title'],
                'meta_keywords' => $data['meta_keywords'],
                'meta_description' => $data['meta_description'],
                'created_by' =>$this->session->userdata('admin_user')['user_id']
                );
        $page_slug=$data['slug'];
        $page_title=$data['title'];
        $page_data['slug']= ($page_slug=='')? url_title($page_title,'-',TRUE):$page_slug;
        $condition=array('key'=>'id','value'=>$id);
        update('pages',$page_data,$condition);
        $status = "<div class='alert alert-success'><strong>Success!</strong> Page updated successfully.</div>";
        $task = 'success';
        set_message($task, $status);
        redirect(base_url().'admin/page');



    }



   public function delete($id)
    {

    delete('pages',$id);
    redirect(base_url().'admin/page');
    }




//===============================================Creating Navigations=============================================

    
    public function category()
    {
        $data['nav']=$this->nav;
        $data['title']="Page Category";
        $data['button_action']='admin/page/create_category';
        $data['button']='Add Category';
        $data['table']='Category List';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','Pages'=>'Category','Category List'=>'');
        $data['edit']=base_url().'admin/page/edit_category/';
        $data['delete']=base_url().'admin/page/delete_category/';
        $data['fields']=array('SN','Title','Nav Group','Priority','Status','Action');
        $records=$this->page_model->getCategory();
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
        $data['datas']=$records;
        $this->template->load('template','view_list',$data);
    }

//=======================================================================================================

    public function create_category()
    {
        $data['nav']=$this->nav;
        $data['title']="Add New Category";
        $data['table_name']="<strong>Add</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Page','Add Category'=>'');
        $data['action']='admin/page/add_category';
        $data['nav_id']="";
        $data['options']=get_nav_groups();
        $this->template->load('template','create_page_category',$data);
    }


    public function add_category()
    {
        $this->form_validation->set_rules('title','Category Title','required');
         if($this->form_validation->run()==FALSE)
            {
                
                $this->create_category();

            }else
            {


                $data=$this->input->post();
                $this->general->insert('page_navigation', $data);
                $task = "<div class='alert alert-success'><strong>Success!</strong> Navigation added successfully.</div>";
                $status = 'success';
                set_message($status,$task);
                redirect(base_url().'admin/page/category');
            }
    }
//==========================================================================================================
    
   public function edit_category($id)
     {
        $data['nav']=$this->nav;
        $data['title']="Edit Category";
        $data['table_name']="<strong>Edit</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Page','Edit Category'=>'');
        $data['action']='admin/page/update_category/'.$id;
        $data['datas']=$this->page_model->getCatById($id);
        $data['nav_id']=$data['datas']->nav_group_id;
        $data['options']=get_nav_groups();

            if(empty($data['datas']))
            {
                redirect('admin/error404');
            }
            else
            {
                $this->template->load('template','create_page_category',$data);
            }
        }


     public function update_category($id)
     {
            $data=$this->input->post();
            $this->general->update('page_navigation',$data,array('id'=>$id));
            $task = "<div class=' alert alert-success'><strong>Success!</strong> Navigation updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.'page/category');
     }


//=======================================================================================================
    
    public function delete_category($id)
    {

     $this->general->delete('page_navigation',array('id'=>$id));
     redirect('admin/page/category');

    }

//=======================================================================================================

   public function nav_group()
   {
        $data['nav']=$this->nav;
        $data['title']="Navigation Group";
        $data['button_action']='admin/page/create_nav_group';
        $data['button']='Add Navigation Group';
        $data['table']='Group List';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','Pages'=>'Nav Group','Group List'=>'');
        $data['edit']=base_url().'admin/page/edit_nav_group/';
        $data['delete']=base_url().'admin/page/delete_nav_group/';
        $data['fields']=array('SN','Title','Slug','Priority','Status','Action');
        $records=$this->page_model->getNavigationGroup();
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
        $data['datas']=$records;
        $this->template->load('template','view_list',$data);


   }


//========================================================================================================

   public  function create_nav_group()
   {
        $data['nav']=$this->nav;
        $data['title']="Add Nav Group";
        $data['table_name']="<strong>Add</strong> Nav Group";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Page','Add Group'=>'');
        $data['action']='admin/page/create_nav_group';
        if($this->input->post()):
            $data=$this->input->post();
            $data['abbrev']=($data['abbrev']=="")? url_title($data['title'],'-',TRUE):$data['abbrev'];
            $this->general->insert('navigation_groups', $data);
            $task = "<div class='alert alert-success'><strong>Success!</strong> catrgory added successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url().'admin/page/nav_group');


        else:
        $this->template->load('template','create_navigation_group',$data);
        endif;

   } 

//===============================================================================================================
  
   public function edit_nav_group($id)
   {
        $data['nav']=$this->nav;
        $data['title']="Edit Nav Group";
        $data['table_name']="<strong>Edit</strong> Nav Group";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Page','Edit Nav Group'=>'');
        $data['action']='admin/page/update_navigation_group/'.$id;
        $data['datas']=$this->page_model->getNavGroupById($id);

            if(empty($data['datas']))
            {
                redirect('admin/error404');
            }
            else
            {
                $this->template->load('template','create_navigation_group',$data);
            }

   }


  public function update_navigation_group($id)
     {
            $data=$this->input->post();
            $data['abbrev']=($data['abbrev']=="")? url_title($data['title'],'-',TRUE):$data['abbrev'];
            $this->general->update('navigation_groups',$data,array('id'=>$id));
            $task = "<div class=' alert alert-success'><strong>Success!</strong> Navigation Group updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.'page/nav_group');
     }


//=======================================================================================================
    
    public function delete_nav_group($id)
    {

     $this->general->delete('navigation_groups',array('id'=>$id));
     redirect('admin/page/nav_group');

    }  





}