<?php
defined('BASEPATH') OR exit('No direct script allowed');

class News extends MX_Controller
{
	private $table='news';
    private $module='News';
    private $title='News Manage';
    private $nav = 'news';

//=========================================================================================================   
	public function __construct()
	{
		 parent::__construct();
		 check_admin_login();
		 $this->load->model('news_model');
         $this->load->model('general_model','general');
         $this->form_validation->CI= &$this;

	}


//=======================================================================================================

	public function index()
	{
        $data['nav']=$this->nav;
        $data['title']=$this->title;
        $data['table_name']='<strong>News</strong> List';
        $data['button_action']='admin/news/create';
        $data['button']='Add News';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News',' News List'=>'');
        $data['edit']=base_url().'admin/news/edit/';
        $data['delete']=base_url().'admin/news/delete/';
        $data['fields']=array('SN','Title','Slug','Author','Publish Date','Status','Action');
        $records=$this->news_model->getAll($this->table);
        foreach ($records as $key => $value) {
            $records[$key]->publish_date=user_format($value->publish_date);
        }

        $data['datas']=$records;
       $this->template->load('template','view_list',$data);

	}


//========================================================================================================

    public function create()
    {
        $data['nav']=$this->nav;
        $data['title']="Add News";
        $data['table_name']="<strong>Add</strong> News";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News','Add News'=>'');
        $data['action']='admin/news/createAction';
        $data['cat_id']="";
        $data['options']=$this->_get_all_parent_cat_for_dropdown();
        $this->template->load('template','create_news',$data);


    }



    public function createAction()
    {
       

            $this->form_validation->set_rules('title','News Title','required|callback_title_check');
            $this->form_validation->set_rules('author','Author Name','required');
            $this->form_validation->set_rules('content','News Contents','required');
            $this->form_validation->set_rules('cat_id','Category','required|numeric');
            $this->form_validation->set_rules('publish_date','Publish Date','required');
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
                $slug=$data['slug'];
                $title=$data['title'];
                $data['slug']=($slug=='')? url_title($title,'-',TRUE):$slug;
                $data['slug']=$data['slug'].'-'.time();
                $this->general->insert($this->table, $data);
                $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module . " added successfully.</div>";
                $status = 'success';
                set_message($status,$task);
                redirect(base_url().'admin/news');

            }

     }




//=======================================================================================================

     public function edit($id)
     {
        $data['nav']=$this->nav;
        $data['title']="Edit News";
        $data['table_name']="<strong>Edit</strong> News";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'News','Edit News'=>'');
        $data['action']='admin/news/update/'.$id;
        $data['options']=$this->_get_all_parent_cat_for_dropdown();
        $data['datas']=$this->news_model->get($this->table,$id);
        $data['cat_id']=$data['datas']->cat_id;
        $this->template->load('template','create_news',$data);

     }



     public function update($id)
     {
            $this->form_validation->set_rules('title','News Title','required|callback_title_check');
            $this->form_validation->set_rules('author','Author Name','required');
            $this->form_validation->set_rules('content','News Contents','required');
            $this->form_validation->set_rules('cat_id','Category','required|numeric');
            $this->form_validation->set_rules('publish_date','Publish Date','required');
            if($this->form_validation->run()==FALSE)
            {
                
                $this->edit($id);

            }else
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
                $slug=$data['slug'];
                $title=$data['title'];
                $data['slug']=($slug=='')? url_title($title,'-',TRUE).time():$slug;
                if(!isset($data['status']))
                {
                    $data['status']='unpublish';
                }

        
                
        
            $this->general->update($this->table,$data,array('id'=>$id));
            $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->module. " Updated successfully.</div>";
            $status = 'success';
            set_message($status,$task);
            redirect(base_url('admin').'/'.$this->module);
    }
     }

//================cheking duplicate news title===========================================================
     
     public function title_check($str)
     {
        $update_id=$this->uri->segment(4);
        $mysql_query="select * from default_news where title='$str'";
        if(is_numeric($update_id))
        {
            $mysql_query.=" and id!='$update_id'";
        }
        $query=$this->news_model->custom_query($mysql_query);
        $num_rows=$query->num_rows();
        if($num_rows>0)
        {
            $this->form_validation->set_message('title_check','The news title already exist!.');
            return FALSE;

        }else
        {

        }
        


     }

//=======================================================================================================
     
    public function delete($id)
     {
        $this->general->del_image('news',array('id' => $id),'news_events');
         
        $this->general->delete($this->table,array('id'=>$id));
        redirect('admin/news');
     }



//=======================================================================================================
 	
 	public function category()
 	{
        $data['nav']=$this->nav;
 		$data['title']="News Category";
        $data['button_action']='admin/news/create_category';
        $data['button']='Add Category';
        $data['table']='Category List';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','News'=>'Category','Category List'=>'');
        $data['edit']=base_url().'admin/news/edit_category/';
        $data['delete']=base_url().'admin/news/delete_category/';
        $data['fields']=array('SN','Title','Parent','Priority','Status','Action');
        $records=$this->news_model->getCategory();
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
        $data['nav']=$this->nav;
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
                $data['slug']=($data['slug']=="")? url_title($data['cat_title'],'-',TRUE):$data['slug'];
                $this->general->insert('news_category', $data);
                $task = "<div class='alert alert-success'><strong>Success!</strong> catrgory added successfully.</div>";
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


    function _get_all_parent_cat_for_dropdown()
    {
        $mysql_query="select * from default_news_category where parent_cat_id=0 order by parent_cat_id,cat_title";
        $query=$this->news_model->custom_query($mysql_query);
        $options['']="Please select...";
        foreach($query->result() as $row)
        {
           
          $options[$row->id]=$row->cat_title;
        }
        if(!isset($options))
        {
            $options="";
        }
        
        return $options;
    }


    function get_sub_cat_title()
    {
         $parent_cat_id=$this->input->post('data');
         $sub_cat=$this->input->post('sub_cat');

         $mysql_query="select * from default_news_category where parent_cat_id=$parent_cat_id";
         $query=$this->news_model->custom_query($mysql_query);

         if(count($query->result())>0)
         {
         
         $html="<label for='Title'>Sub Category</label>";
         $html.="<div class='row'><div class='col-md-4'>";
         $html.="<select name='sub_cat_id' class='form-control'>";
         foreach($query->result() as $row):
            // $html.="<option value='".$row->id."' ". ($sub_cat==$row->id)?'checked':'' .">".$row->cat_title."</option>";

            $html .= "<option";
            $html .= " value='{$row->id}' ";
            $html .= ($sub_cat==$row->id) ? 'selected' :'';
            $html .= " >{$row->cat_title}</option>";


         endforeach;
         $html.="</select>";
         $html.=" </div></div>";
         
         
        }else
        {
            $html="";
        }
        echo $html;

    }


//=======================================================================================================

     public function edit_category($id)
     {
        $data['nav']=$this->nav;
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
            $data['slug']=($data['slug']=="")? url_title($data['cat_title'],'-',TRUE):$data['slug'];
            $this->general->update('news_category',$data,array('id'=>$id));
            $task = "<div class='alert alert-success'><strong>Success!</strong> category updated successfully.</div>";
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