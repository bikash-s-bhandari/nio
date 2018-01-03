<?php
if(!defined('BASEPATH'))
    exit('No direct script access allowed!');
class Message extends MX_Controller
{
    private $table='chat_messages';
    private $module='message';
    private $title='User Message';
    private $item='Message';
    private $nav = 'u_message';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('message_model');
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
            'nav' => $this->nav,
            
            );
        return $data;
    }


    //=========================================================================================================

    public function index()
    {
        
        $data=$this->essentials();
        $data['table_name']='<strong>Message</strong> List';
        $data['button_action']='admin/message/create';
        $data['button']='Compose Message';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard',$data['module']=>$this->item,'All Message'=>'');
        $data['fields']=array('*','Date Sent','Sent By','Subject','Action');
        $query=$this->message_model->getAllMessage();
        $data['query']=$query;
        // $data['datas']=$records;
        $this->template->load('template','view_message_list',$data);

    }

    //========================================create banner=================================================================

    public function create()
        {
            $data=$this->essentials();
            $data['title']="Compose New Message";
            $data['table_name']="<strong>Compose</strong> Message";
            $data['action']='admin/message/createAction';
            $data['breadcrumb']=array('Dashboard'=>'Dashboard',$data['module']=>'Message','Compose Message'=>'');
            $data['options']= $this->db->where('is_varified',"0")->get('users')->result();
            $data['user_id']="";

            $this->template->load('template','create_message',$data);

        }

   public function createAction()
   {
    $list['data'] = $this->input->get('add_fields_type');

    $this->form_validation->set_rules('message', 'Message', 'trim|required');
    if($this->form_validation->run()==TRUE)
    {
         $data=array(
            'sent_by'=>0,
            'sent_to'=>$this->input->post('user_id'),
            'message'=>$this->input->post('message'),
            'created_at'=>strtotime(date('Y-m-d H:i:s')),
        );
       $this->message_model->send_msg($data);
        $task = "<div class='alert alert-success'><strong>Success!</strong> " . $this->item . " sent successfully.</div>";
        $status = 'success';
        set_message($status,$task);
        redirect('admin/message/create');

    }else
    {
        $this->create();
        //redirect($_SERVER['HTTP_REFERER']);
    }

       


   }



 function delete($id)
 {
    
    $this->general->delete('chat_messages',array('id'=>$id));
    redirect('admin/message');
 }

 //=================================================================================================================


 function view($id)
 {

    $data['title']="User Details";
    $data['nav']=$this->nav;
    $data['table_name']="User Details";
    $data['user_info']=$this->message_model->get_details($id);
    $data['uid']=$id;
    $this->message_model->opened($id);
    $this->template->load('template','view_mesg_detail',$data);

 }


 //==================================================================================================================

 public function reply_message($id)
 {
    $data=$this->essentials();
    $data['title']="Reply Message";
    $data['table_name']="<strong>Reply</strong> Message";
    $data['breadcrumb']=array('Dashboard'=>'Dashboard',$data['module']=>'Message','Reply Message'=>'');
    $data['action']='admin/message/send_reply';
    $data['user_id']=$this->message_model->get_user_id($id);
    $this->template->load('template','reply_message',$data);
 }

 public function send_reply()
 {
    $data=array(
        'sent_by'=>'0',
        'sent_to'=>$this->input->post('user_id'),
        'message'=>$this->input->post('message'),
        'created_at'=>strtotime(date('Y-m-d H:i:s')),
    );

    if($this->db->insert('chat_messages',$data))
    {
        $this->session->set_flashdata('success','Message sent successfully!');
        redirect('admin/message');
    }


 }





}