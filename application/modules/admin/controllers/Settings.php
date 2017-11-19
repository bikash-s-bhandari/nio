<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed!');
class Settings extends CI_Controller
{
    private $module='Settings';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('general_model','general');
        check_admin_login();
    }

    

//=======================================================================================================

    public function index()
    {
        $data['nav']='settings';
        $data['title']="Settings";
        $data['module']=$this->module;
        $data['action']="";
        $data['table_name']='<strong>App<strong> Settings';
        $data['breadcrumb']=array('Dashboard'=>'dashboard',$data['module']=>'');
        $data['settings'] = getWhere('settings', array('id' => 1));
        if($this->input->post()):

            if(!empty($_FILES['userfile']['name'])):


            $image_name=$this->general->upload_file('logo');

            $this->general->del_image('settings',array('id'=>1),'logo','logo_url');
            $site_data=$this->input->post();
            
            $site_data['logo_url']=$image_name;

            else:
            $site_data=$this->input->post();
            endif;
            
            $cond=array('id'=>1);
            $this->general->update('settings', $site_data, $cond);

            $this->session->set_flashdata('success','<strong>Success!</strong> Settings updated sucessfully.');
            

            redirect('admin/settings');
         else:
       $this->template->load('template','create_setting',$data);
        endif;


    }

//=======================================================================================================


}