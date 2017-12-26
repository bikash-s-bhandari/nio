<?php
defined('BASEPATH') OR exit('No direct script access allowed!');
 class Download extends MX_Controller
 {
 	private $table='downloads';
 	private $module='download';
 	private $file_folder='download';
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model('general_model','general');
 		$this->load->model('download_model');
 		 check_admin_login();
    }

    public function index()
 	{
        $data['nav']="download";
 		$data['title']="File List";
 		$data['table_name']="<strong>File</strong> List";
 		$data['module']=$this->module;
 		$data['button_action']='admin/download/create_file';
        $data['button'] = 'Upload File';
 		$data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => '');
 		$data['delete']=base_url().'admin/download/delete/';
 		$data['edit']=base_url().'admin/download/edit/';
        $data['fields']=array('SN','Title','File','Action');
        $records=$this->download_model->getFiles();
        $data['datas']=$records;
        $this->template->load('template','view_file_list',$data);

 	}

 	public function create_file()
 	{
        $data['nav']="download";
 		$data['title']="Upload File";
 		$data['table_name']="<strong>File</strong> Upload";
 		$data['module']=$this->module;
 		$data['action']='admin/download/upload_file';
 		$data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => 'download','Upload'=>'');
        $this->template->load('template','create_file',$data);



 	}

     public function edit($id)
    {
        $data['nav']="download";
        $data['title']="Edit Download";
        $data['table_name']="<strong>Download</strong> Edit";
        $data['module']=$this->module;
        $data['action']='admin/download/update/'.$id;
        $data['breadcrumb'] = array('Dashboard' => 'dashboard', $data['module'] => 'Download','Edit Download'=>'');
        $records=$this->download_model->getDownloadById($id);
        $data['datas']=$records;
        $this->template->load('template','create_file',$data);


    }

   public function update($id)
    {
      if(isset($_FILES) && $_FILES['userfile']['name']!='')
    {

        
        $fname=$this->download_model->file_upload($this->file_folder);
        $data=array(
            'title'=>$this->input->post('title'),
            'filename'=>$fname
            );
        $this->general->unlink_file($this->file_folder,$this->input->post('prev_file'));
       
    }
    else
    {
        $data=array(
            'title'=>$this->input->post('title'),
            'filename'=> $this->input->post('prev_file')
            );

    }
        $cond = array('key' => 'id', 'value' => $id);
        update('downloads',$data,$cond);
        $task = "<div class='alert alert-success'><strong>Success!</strong> File Updated successfully.</div>";
        $status = 'success';
        set_message($status,$task);
        redirect('admin/download');

   
    


    }




 	public function upload_file()
 	{
 		$fname=$this->download_model->file_upload($this->file_folder);
        $data=array(
            'title'=>$this->input->post('title'),
            'filename'=>$fname
            );

    if($this->db->insert('downloads',$data))
       {
        $task = "<div class='alert alert-success'><strong>Success!</strong> File Uploaded successfully.</div>";
        $status = 'success';
        set_message($status,$task);
        redirect('admin/download');

       }
        

 }



 	public function delete($id)
 	{
        $this->download_model->delete_file($this->table,array('id' => $id), $this->file_folder);
        $this->download_model->delete($this->table,$id);
        redirect('admin/download');
 	}


     public function forcedownload()
     {

        $file_name = $_GET['filename'];
        $file_url =$_GET['file_url'];
        
        if(file_exists($file_url.'/'.$file_name))
        {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-disposition: attachment; filename=\"".$file_name."\""); 
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-Length: " . filesize($file_url.'/'.$file_name));
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        ob_clean();
        flush();
    
        readfile($file_url.'/'.$file_name);
        exit();

        }
        else
        {
            echo "File does not exists";
        }


     }



   

   



 }