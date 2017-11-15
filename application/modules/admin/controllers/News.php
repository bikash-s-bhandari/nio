<?php
defined('BASEPATH') OR exit('No direct script allowed');

class News extends MX_Controller
{
	private $table='news';
    private $module='News';
    private $title='News Manage';
    private $nav = '';

//=========================================================================================================   
	public function __construct()
	{
		parent::__construct();
		 check_admin_login();
		 $this->load->model('news_model');
         $this->load->model('general_model','general');

	}


//=======================================================================================================

	public function index()
	{
        $data['title']=$this->title;
        $data['table_name']='<strong>News</strong> List';
        $data['button_action']='admin/news/create';
        $data['button']='Add News';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News',' News List'=>'');
        $data['edit']=base_url().'/admin/news/edit/';
        $data['delete']=base_url().'/admin/news/delete/';
        $data['fields']=array('SN','Title','Author','Publish Date','Status','Action');
        $records=$this->news_model->getAll($this->table);
        foreach ($records as $key => $value) {
            $records[$key]->publish_date=user_format($value->publish_date);
        }

        $data['datas']=$records;
       $this->template->load('template','view_list',$data);

	}


//=======================================================================================================

    public function create()
    {
        $data['title']="Add News";
        $data['table_name']="<strong>Add</strong> News";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News','Add News'=>'');
        $data['action']='admin/news/createAction';
        $this->template->load('template','create_news',$data);


    }



    public function createAction()
    {

            $this->form_validation->set_rules('title','News Title','required');
            $this->form_validation->set_rules('author','Author Name','required');
            $this->form_validation->set_rules('content','News Contents','required');
            $this->form_validation->set_rules('publish_date','Publish Date','required');
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
                redirect(base_url().'admin/news');

            }

     }

//=======================================================================================================

     public function edit($id)
     {
        $data['title']="Edit News";
        $data['table_name']="<strong>Edit</strong> News";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News','Edit News'=>'');
        $data['action']='admin/news/update/'.$id;
        $data['datas']=$this->news_model->get($this->table,$id);
        $this->template->load('template','create_news',$data);

     }



     public function update()
     {
        $data=$this->input->post();
        dumparray($data);
        $this->general->update($this->table,$data,array('id'=>$id));
        $task = "<div class='alert bg-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
        $status = 'success';
        set_message($status,$task);
        redirect(base_url('admin').'/'.$this->module);
     }



//=======================================================================================================
 	
 	public function category()
 	{
 		$data['title']="News Category";
        $data['button_action']='admin/news/create_category';
        $data['button']='Add Category';
        $data['table']='Category List';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','News'=>'Category','Category List'=>'');
        $data['edit']=base_url().'admin/news/edit_category/';
        $data['delete']=base_url().'admin/news/delete_category/';
        $data['fields']=array('SN','Title','Parent','Priority','Status','Action');
        $records=$this->news_model->getCategory();
    dumparray($records);
        foreach ($records as $k=>$v) 
        {
          $records[$k]->parent_cat_id=$this->_get_parent_cat_title($v->id);
           
        }


       if(FALSE!=$records):
            $records=check_status($records);
        endif;
        $data['datas']=$records;
        $this->template->load('template','view_news_category',$data);
 	}

//=======================================================================================================

    public function create_category()
    {

        $data['title']="Add New Category";
        $data['table_name']="<strong>Add</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News','Add Category'=>'');
        $data['action']='admin/news/add_category';
        $data['parent_cat_id']="";
        $data['options']=$this->_get_dropdown_options();
        $data['num_dropdown_options']=count($data['options']);
        $this->template->load('template','create_news_category',$data);
    }


    public function add_category()
    {
        $this->form_validation->set_rules('cat_title','Category Title','required');
       // $this->form_validation->set_rules('priority','Priority','required');
        if($this->form_validation->run()==FALSE)
            {
                
                $this->create_category();

            }else
            {

                $data=$this->input->post();
                $this->general->insert('news_category', $data);
                $task = "<div class='alert bg-success'><strong>Success!</strong> catrgory added successfully.</div>";
                $status = 'success';
                set_message($status,$task);
                redirect(base_url().'admin/news/category');
            }
    }

    function _get_parent_cat_title($id)
    {
        
        $data=$this->news_model->getCategoryById($id);
        $parent_cat_id=$data['parent_cat_id'];
        $parent_cat_title=$this->_get_cat_title($parent_cat_id);

        return $parent_cat_title;


    }


    function _get_cat_title($parent_id)
     {
        $data=$this->news_model->getParentCatName($parent_id);
        if(!empty($data))
        {
            $cat_title=$data['cat_title'];

        }else
        {
            $cat_title="-";
        }

      return $cat_title;
     }


     function _get_dropdown_options($id=null)
     {
        if(!is_numeric($id))
        {
            $id=0;
        }
        
        $options['']="Please select...";
        //build an array of parent category
        $mysql_query="select * from default_news_category where parent_cat_id=0 and id!=$id";
        $query=$this->news_model->custom_query($mysql_query);
        foreach($query->result() as $row) {
            $options[$row->id]=$row->cat_title;
        }
        return $options;

     }


     function _get_parent_id($id)
     {
        return $this->news_model->getParentId($id);
     }


//=======================================================================================================

     public function edit_category($id)
     {

        $data['title']="Edit Category";
        $data['table_name']="<strong>Edit</strong> Category";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News','Edit Category'=>'');
        $data['action']='admin/news/update_category/'.$id;
        $data['parent_cat_id']=$this->_get_parent_id($id);
        //dumparray($data['parent_cat_id']);
        $data['options']=$this->_get_dropdown_options($id);
        $data['num_dropdown_options']=count($data['options']);
        $data['datas']=$this->news_model->getCat($id);

            if(empty($data['datas']))
            {
                redirect('admin/error404');
            }
            else
            {
                $this->template->load('template','create_news_category',$data);
            }

     

     }


     public function update_category($id)
     {
            $data=$this->input->post();
            $this->general->update('news_category',$data,array('id'=>$id));
            $task = "<div class='alert bg-success'><strong>Success!</strong> category updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.'news/category');
     }

//=======================================================================================================
    
    public function delete_category($id)
    {

     $this->general->delete('news_category',array('id'=>$id));
     redirect('admin/news/category');

    }


}