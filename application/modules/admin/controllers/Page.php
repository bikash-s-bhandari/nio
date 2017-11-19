<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed!');
class Page extends MX_Controller
{
	private $table='pages';
    private $module='Page';
    private $title='Page Manage';
    private $nav = 'page';

//=============================================================================================================
	
    public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('page_model');
        $this->load->model('general_model','general');
         check_admin_login();
	}


   public function index()
	{
        $data['nav']=$this->nav;
		$data['title'] = 'Page List';
        $data['button'] = 'Add New Page';
        $data['button_action'] ='admin/page/create';
        $data['module'] = $this->module;
        $data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => 'page', 'Page List' => '');
        $data['table_name'] = '<strong>Page</strong> List';
        $data['edit'] = base_url().'admin/page/edit/';
        $data['delete'] = base_url().'admin/page/delete/';
        $data['fields'] = array('SN', 'Title', 'Slug', 'URL', 'Action');
        $data['datas'] = $this->page_model->getAll();
        $this->template->load('template', 'view_list', $data);

        
	}


     public function  create()
      {
        $data['nav']=$this->nav;
    	$data['title']='Create Page';
    	$data['module']=$this->module;
    	$data['breadcrumb']=array('dashboard'=>'dashboard',$data['module']=>'Page','Create Page'=>'');
    	$data['table_name']='<strong>Create</strong> Page';
		$form['action'] = 'admin/page/create';
        $form['label'] = 'Create Page';
        $form['purpose'] = 'Create';
        $form['attribute'] = '';
        $form['fields']=$this->form_builder_array();
        $data['form']=form_builder($form);
        $data['form_id']='page';

		if($this->input->post()):
        	$data=$this->input->post();



        
       

        $page_data=array
            (
                'title'=>$data['title'],
                'navigation_link'=>lcfirst($data['navigation_link']),
                'class'=>$data['class'],
                'status'=>$data['status'],
                'navigation_link_id'=>'',
                'body' => ucfirst($data['body']),
                'image_link' => $data['link_image'],
                'meta_title' => $data['meta_title'],
                'meta_keywords' => $data['meta_keyword'],
                'meta_description' => $data['meta_description'],
                'custom_css' => $data['custom_css'],
                'javascript' => $data['javascript'],
                'is_home' => $home,
                'created_by' =>'' ,
                );
        //creating auto slug
        $page_slug=$this->input->post('slug');// or $page_slug=$data['slug'];
        $page_title=$data['title'];
        $page_data['slug']=($page_slug=='')? url_title($page_title,'-',TRUE):$page_slug;

      
        save('pages',$page_data);

        $page_id=$this->db->insert_id();

        //inserting the navigation when page is created

        $nav_data=array
            (
                'title'=>ucfirst($data['title']),
                'nav_group_id'=>$data['navigation_group_id'],
                'url'=>$data['navigation_link'],
                'page_id'=>$page_id,
                'class'=>'fa-home',
                'target'=>''
            );

            save('navigation_link',$nav_data);

            $nav_id=$this->db->insert_id();

            $condition=array('key'=>'id','value'=>$page_id);

            update('pages',array('navigation_link_id'=>$nav_id),$condition);
        $task = "<div class='alert bg-success'><strong>Success!</strong> Page added successfully.</div>";
            $status = 'success';
       redirect(BACKENDFOLDER.'/page');
       else:
     $this->template->load('template','create',$data);
      endif;
    }





  public function edit($id)
    {
        $data['nav']=$this->nav;
    	$data['title'] = 'Edit Page';
        $data['module'] = $this->module;
        $data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => 'page', 'Edit Page' => '');
        $data['table_name'] = '<strong>Page</strong> Edit';
		$form['action'] = BACKENDFOLDER.'/page/update/' . $id;
        $form['label'] = 'Edit Page';
        $form['purpose'] = 'Update';
        $form['attribute'] = '';
        $data['form_id']='page';
        $pages=$this->page_model->get_page_by_id($id);
       	$pages=(array)$pages;
       	$form['fields']=$this->form_builder_array($pages);
       	$data['form']=form_builder($form);
       	$this->template->load('template','create',$data);



    }



    public function update($id)
    {
    	$data = $this->input->post();


        if(isset($data['is_home'])):
            $home=1;
        else:
            $home=0;
        endif;

        $page_data=array(
                'title'=>$data['title'],
                'navigation_link'=>lcfirst($data['navigation_link']),
                'class'=>$data['class'],
                'status'=>$data['status'],
                'body' => $data['body'],
                'image_link' => $data['link_image'],
                'meta_title' => $data['meta_title'],
                'meta_keywords' => $data['meta_keyword'],
                'meta_description' => $data['meta_description'],
                'custom_css' => $data['custom_css'],
                'javascript' => $data['javascript'],
                'is_home' => $home,
            );
        $page_slug=$data['slug'];
        $page_title=$data['title'];
        $page_data['slug']= ($page_slug=='')? url_title($page_title,'-',TRUE):$page_slug;

        $nav_data=array(
            'title'=>$data['title'],
            'nav_group_id'=>$data['navigation_group_id'],
            'url'=>$data['navigation_link']
            );
        //getting navigation_list_id of page
        $navigation_id=$this->page_model->get_page_by_id($id);
    
        $cond=array('key'=>'id','value'=> $navigation_id->navigation_link_id);
        update('navigation_link',$nav_data,$cond);
        $condition=array('key'=>'id','value'=>$id);
        update('pages',$page_data,$condition);
        $status = "<div class='alert bg-success'><strong>Success!</strong> Page updated successfully.</div>";
        $task = 'success';
        set_message($task, $status);
        redirect(BACKENDFOLDER.'/page');



    }



     public function delete($id)
    {

    $navigation_id=$this->page_model->get_page_by_id($id);
    $nav_id=$navigation_id->navigation_link_id;
    delete('pages',$id);
    delete('navigation_link',$nav_id);
    redirect(base_url().'admin/page');
    


    }




//=============================================================================================================

    
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
        $data['fields']=array('SN','Title','Priority','Status','Action');
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
        $data['cat_id']="";
        $this->template->load('template','create_page_category',$data);
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
                $this->general->insert('page_category', $data);
                $task = "<div class='alert bg-success'><strong>Success!</strong> catrgory added successfully.</div>";
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
            $this->general->update('page_category',$data,array('id'=>$id));
            $task = "<div class='alert bg-success'><strong>Success!</strong> category updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.'page/category');
     }

//=======================================================================================================
    
    public function delete_category($id)
    {

     $this->general->delete('page_category',array('id'=>$id));
     redirect('admin/page/category');

    }






}