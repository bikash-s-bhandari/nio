<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller {

   

    public function __construct()
     {
        parent::__construct();
        check_admin_login();

        
      }

//========================================================================================================
    
	 public function index() 
	 	{
	        $data['title'] = 'Dashboard';
	        $this->template->load('template', 'content', $data);
	    }

 //======================================================================================================= 

    

}
