<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed!');
class Page extends CI_Controller
{
	private $module='Page Management';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->model('page_model');
         check_admin_login();
	}

	public function index()
	{
		$data['title'] = 'Page List';
        $data['button'] = 'Add New Page';
        $data['button_action'] = BACKENDFOLDER.'/page/create';
        $data['module'] = $this->module;
        $data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => 'page', 'Page List' => '');
        $data['table_name'] = '<strong>Page</strong> List';
        $data['edit'] = base_url() . BACKENDFOLDER.'/page/edit/';
        $data['delete'] = base_url() . BACKENDFOLDER.'/page/delete/';
        $data['fields'] = array('SN', 'Title', 'Slug', 'URL', 'Action');
        $data['datas'] = $this->page_model->getAll();
        //$data['nav_title'] = $this->navigation_model->get_navigation_group();
        $this->template->load('template', 'view_list', $data);

        
	}


    function form_builder_array($values = array()) {
//value edit garda matra kam garxa
        if (isset($values['is_home']) && $values['is_home'] == 1):
            $checked = 'TRUE';
            $variable = 'Checked';
        else:
            $checked = '';
            $variable = '';
        endif;
        $form_field = array(
            array('label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'value' => isset($values['title']) ? $values['title'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Slug',
                'name' => 'slug',
                'type' => 'text',
                'value' => isset($values['slug']) ? $values['slug'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Class',
                'name' => 'class',
                'type' => 'text',
                'value' => isset($values['class']) ? $values['class'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Navigation Link',
                'name' => 'navigation_link',
                'type' => 'text',
                'value' => isset($values['navigation_link']) ? $values['navigation_link'] : '',
                'class' => 'form-control',
                'additional'=>base_url()
            ),
            array('label' => 'Status',
                'type' => 'radio',
                'selected' => isset($values['status']) ? $values['status'] : 1,
                array(
                    array('type' => 'radio',
                        'name' => 'status',
                        'label' => 'Active',
                        'value' => 1,
                        'class' => 'required'
                    ),
                    array('type' => 'radio',
                        'name' => 'status',
                        'label' => 'De active',
                        'value' => 0,
                        'class' => ''
                    ),
                ),
            ),
            array('label' => 'Add to navigation group',
                'name' => 'navigation_group_id',
                'type' => 'dropdown',
                'option' => get_nav_header(),
                'selected' => isset($values['navigation_group_id']) ? $values['navigation_group_id'] : '',
                'class' => 'class="selectpicker form-control"  parsley-required="true" parsley-error-container="div#select-com-error"'
            ),
            array('label' => 'Page Content',
                'name' => 'body',
                'type' => 'textarea',
                'value' => isset($values['body']) ? $values['body'] : '',
                'class' => 'form-control',
                 'id' => 'page_content',
            ),
            array('label' => 'Image Link',
                'name' => 'link_image',
                'type' => 'text',
                'value' => isset($values['image_link']) ? $values['image_link'] : '',
                'class' => 'form-control'
                //'id' => 'editorCk',
            ),
            array('label' => 'Meta Title',
                'name' => 'meta_title',
                'type' => 'text',
                'value' => isset($values['meta_title']) ? $values['meta_title'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Meta Keyword',
                'name' => 'meta_keyword',
                'type' => 'text',
                'value' => isset($values['meta_keyword']) ? $values['meta_keyword'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Meta Description',
                'name' => 'meta_description',
                'type' => 'textarea',
                'value' => isset($values['meta_description']) ? $values['meta_description'] : '',
                'class' => 'form-control'
            ),
            
            
            array('label' => 'Custom CSS',
                'name' => 'custom_css',
                'type' => 'textarea',
                'value' => isset($values['custom_css']) ? $values['custom_css'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Javascript',
                'name' => 'javascript',
                'type' => 'textarea',
                'value' => isset($values['javascript']) ? $values['javascript'] : '',
                'class' => 'form-control'
            ),
            array('label' => 'Is default home page?',
                'name' => 'is_home',
                'type' => 'checkbox',
                'id' => 'check20',
                $variable => $checked,
            ),
        );
        return $form_field;
    }




    public function  create()
    {
    	$data['title']='Create Page';
    	$data['module']=$this->module;
    	$data['breadcrumb']=array('dashboard'=>'dashboard',$data['module']=>'Page','Create Page'=>'');
    	$data['table_name']='<strong>Create</strong> Page';
		$form['action'] = BACKENDFOLDER.'/page/create';
        $form['label'] = 'Create Page';
        $form['purpose'] = 'Create';
        $form['attribute'] = '';
        $form['fields']=$this->form_builder_array();
        $data['form']=form_builder($form);
        $data['form_id']='page';

		if($this->input->post()):
        	$data=$this->input->post();//form bata ako data haru array ma bascha



        if(!isset($data['is_home']))//home page ho ki nai vanera check garne..if home page ho vane 1 set hunxa
        {
        	$home=0;
        }
        else
        {
        	$home=1;
        }

       

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
    redirect(BACKENDFOLDER.'/page');
    


    }




}