<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed!');
class Ambassador_message extends MX_Controller
{
    private $module='Message';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model','general');
        check_admin_login();
    }

    

//=======================================================================================================

    public function index()
    {
        $data['nav']='msg';
        $data['title']="Message";
        $data['module']=$this->module;
        $data['table_name']='<strong>Ambassador<strong> Message';
        $data['breadcrumb']=array('Dashboard'=>'dashboard',$data['module']=>'');
        $data['message'] = getWhere('ambassador_message', array('id' => 1));

        if($this->input->post()):
            if(!empty($_FILES['userfile']['name'])):
            $image_name=$this->general->do_upload('ambassador_image');
            $this->general->del_image('ambassador_message',array('id'=>1),'ambassador_image','image');
            $site_data=$this->input->post();
            $site_data['image']=$image_name;
            else:
            $site_data=$this->input->post();
            endif;
            
            $cond=array('id'=>1);
            $this->general->update('ambassador_message', $site_data, $cond);

            $this->session->set_flashdata('success','<strong>Success!</strong> Message updated sucessfully.');
            

            redirect('admin/ambassador_message');
         else:


       $this->template->load('template','ambassador_message',$data);
        endif;


    }

//=======================================================================================================


}