<?php
defined('BASEPATH') OR exit('No direct script allowed');

class User extends CI_Controller
{
	private $module='User Management';
    private $title='Users Manage';
    private $nav = 'users';
    
    public function __construct()
	{
		parent::__construct();
		 check_admin_login();
		 $this->load->model('general_model','general');
		 $this->load->model('user_model');

	}


//==========================================================================================================

	public function index()
	{
		$data['nav']=$this->nav;
        $data['title']=$this->title;
        $data['table_name']='<strong>Users</strong> List';
        $data['button_action']='admin/user/create';
        $data['button']='Add News';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'User',' User List'=>'');
        $data['view']=base_url().'admin/user/view/';
        $data['delete']=base_url().'admin/user/delete/';
        $data['fields']=array('SN','First Name','Last Name','Email','Status','View');
        $records=$this->user_model->getAllUsers();
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
        //dumparray($records);
        // foreach ($records as $key => $value) {
        //     $records[$key]->created_at=user_format($value->created_at);
        // }

        $data['datas']=$records;
        //dumparray($data['datas']);
        $this->template->load('template','view_users',$data);
		
	}


    public function activate($id)
    {
        $data['status']='1';
        $this->db->where('id',$id);
        $this->db->update('users',$data);
         redirect('admin/user');


    }
    public function deactivate($id)
    {
        $data['status']='0';
        $this->db->where('id',$id);
        $this->db->update('users',$data);
         redirect('admin/user');


    }

    public function user_details()
    {
        $u_id=$this->input->post('id');
        $data=$this->user_model->getUserDetails($u_id);
        $data['created_at']=user_format($data['created_at']);
           if($data['status']=='1')
           {
            $data['status']="Active";

           }else
           {
            $data['status']="In Active";
           }
        echo json_encode($data);
    }


//=============================================================================================================	

	public function admin_user()
	{
		$data['nav']=$this->nav;
		$data['title']=$this->title;
		$data['table_name']='<strong>Admin</strong> List';
		$data['button_action']='admin/user/create';
        $data['button']='Add Admin';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Users','Admin List'=>'');
        $data['edit']=base_url().'/admin/user/edit/';
        $data['delete']=base_url().'/admin/user/delete/';
        $data['fields']=array('SN','First Name','Last Name','Role','Status','Action');
        $records=$this->user_model->getAll($this->session->userdata('admin_user')['user_id']);
        if(FALSE!=$records):
            $records=check_status($records);
        endif;
       
        $data['datas']=$records;
       $this->template->load('template','view_list',$data);
    }

//==============================================================================================================
   
    public function create()
    {
    	$data['nav']=$this->nav;
    	$data['title']="Add Admin User";
        $data['table_name']="<strong>Add</strong> Admin User";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Users','Add User'=>'');
        $data['action']='admin/user/create';
        $salt=generate_random_string(4);
        $password=make_hash($this->input->post('password'),$salt);
        if($this->input->post()):
			$data=array(
				'role_id'=>2,
				'username'=>$this->input->post('username'),
				'email'=>$this->input->post('email'),
				'salt'=>$salt,
				'password'=>$password,
				'status'=>$this->input->post('status'),
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname')
			);


		 $this->general->insert('admin', $data);
         $task = "<div class='alert alert-success'><strong>Success!</strong> User added successfully.</div>";
         $status = 'success';
         set_message($status,$task);
         redirect(base_url().'admin/user/admin_user');
        else:
		$this->template->load('template','create_users',$data);
		endif;
    }

//============================================================================================================

    public function edit($id)
    {
    	$data['nav']=$this->nav;
    	$data['title']="Edit User";
        $data['table_name']="<strong>Edit</strong> Users";
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$this->module=>'Users','Edit User'=>'');
        $data['action']='admin/user/update/'.$id;
        $data['datas']=$this->user_model->get($id);
        $this->template->load('template','create_users',$data);


    }

    public function update($id)
    {
    	$data=array(
				'role_id'=>2,
				'username'=>$this->input->post('username'),
				'email'=>$this->input->post('email'),
				'status'=>$this->input->post('status'),
				'fname'=>$this->input->post('fname'),
				'lname'=>$this->input->post('lname')
			      );
    	
		$this->general->update('admin',$data,array('id'=>$id));
        $task = "<div class='alert alert-success'><strong>Success!</strong> User updated successfully.</div>";
        $status = 'success';
        set_message($status,$task);
        redirect(base_url('admin').'/user/admin_user');

    }

//===========================================================================================================

    public function delete($id)
    {
    	$this->general->delete('admin',array('id'=>$id));
        redirect('admin/user/admin_user');
    }

}