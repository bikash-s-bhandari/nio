<?php
defined('BASEPATH') OR exit('No direct script allowed');

class User extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		 check_admin_login();

	}


	//==================================================================================

	public function index()
	{
		
	}

}