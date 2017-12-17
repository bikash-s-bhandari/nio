<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed!');
class Slider extends MX_Controller
{
    private $table='sliders';
    private $module='slider';
    private $title='Slider Management';
    private $item='Slider';
    private $img_folder='sliders';
    private $nav = 'page';
    


    public function __construct()
    {
        parent::__construct();
        $this->load->model('slider_model');
        $this->load->model('general_model','general');
        check_admin_login();


    }

    //=========================================================================================================

    public function essentials()
    {
        $data=array
        (
            'table'=>$this->table,
            'module' => $this->module,
            'title' => $this->title,
            'item' => $this->item,
            'img_folder' => $this->img_folder,
            'nav' => $this->nav,
            
            );
        return $data;
    }


    //=========================================================================================================

    public function index()
    {
        
        $data=$this->essentials();
        $data['table_name']='<strong>Slider</strong> List';
        $data['img_folder']=$this->img_folder.'/thumbs';
        $data['button_action']='admin/slider/create';
        $data['button']='Add Slider';
        $data['breadcrumb']=array('Dashboard'=>'dashboard',$data['module']=>$this->item,'Slider List'=>'');
        $data['edit']=base_url('admin').'/slider/edit/';
        $data['delete']=base_url('admin').'/slider/delete/';
        $data['fields']=array('SN','Title','Image','Status','Action');
        $records=$this->slider_model->getAll();

        if(FALSE!=$records):
            $records=check_status($records);
        endif;
        $data['datas']=$records;
        $this->template->load('template','view_list',$data);

    }

    //========================================create banner=================================================================

    public function create()
        {
            $data=$this->essentials();
            $data['title']="Add New Slider";
            $data['table_name']="<strong>Add</strong> Slider";
            $data['breadcrumb']=array('Dashboard'=>'dashboard',$data['module']=>'Slider','Slider Banner'=>'');
            $data['action']='admin/slider/createAction';
            $this->template->load('template','slider_form',$data);

        }

   public function createAction()
   {
    $images=$this->general->uploadMultipleFiles($this->img_folder);
     foreach($images as $img)
        {
            $image_data[]=array(
                'title'=>$this->input->post('title'),
                'image'=>$img,
                'status'=>$this->input->post('status')

                );
        }

        $this->slider_model->insert_multiple('sliders', $image_data);
        $task = "<div class='alert bg-success'><strong>Success!</strong> " . $this->item . " added successfully.</div>";
        $status = 'success';
        set_message($status,$task);
        redirect('admin/slider');


   }


public function edit($id)
   {


    $data=$this->essentials();
    $data['title']="Edit Slider";
    $data['breadcrumb']=array('Dashboard'=>'dashboard',$data['module']=>'Slider','Edit Slider'=>'');
    $data['module']=$this->module;
    $data['table_name']="<strong>Edit</strong> Slider";
    $data['action']='admin/slider/update/'.$id;
    $data['datas']=$this->slider_model->get($id);
    
    $this->template->load('template','slider_form',$data);
    
}



function update($id)
{

    if(isset($_FILES) && $_FILES['userfile']['name']!='')
    {
        $image=$this->general->do_upload($this->img_folder);
        $this->general->unlink_img($this->img_folder,$this->input->post('prev_image'));
        $this->general->unlink_img($this->img_folder.'/thumbs/',$this->input->post('prev_image'));
        
    }
    else
    {
        $image=$this->input->post('prev_image');
    }
    $data=$this->input->post();
    $data['image']=$image;

    unset($data['prev_image']);
  
    
    $this->general->update('sliders',$data,array('id'=>$id));
    $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->item . " updated successfully.</div>";
    $status = 'success';
    set_message($status,$task);
    redirect(base_url('admin').'/' . $this->module);

  }

 function delete($id)
 {
    $this->general->del_image('sliders',array('id' => $id), $this->img_folder);
    $this->general->delete('sliders',array('id'=>$id));
    redirect('admin/slider');
 }





}