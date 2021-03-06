<?php
defined('BASEPATH') OR exit('No direct script allowed');

class Currency extends MX_Controller
{

    


    public function __construct()
    {
         parent::__construct();
         check_admin_login();
        
    }


//==========================================================================================================================

    public function index()
    {
        $amount =10;

        $from_Curr ="NPR";

        $to_Curr ="OMR";
        //$converted_currency=$this->currencyConverter($from_Curr, $to_Curr, $amount);
        //echo $converted_currency;

        $data['nav']='currency';
        $data['title']="Currency Convert";
        $data['table_name']="Currency Convert";
        $data['table_name']='<strong>Landmark</strong> List';
        $data['button_action']='admin/landmark/create';
        $data['button']='Add Landmark';
        $data['breadcrumb']=array('Dashboard'=>'Dashboard','Currency'=>'Landmark','Converter'=>'');

        
        
       $this->template->load('template','currency',$data);

    }


//necessary to use for errors:http wraper is disblabe...fopen=0 
        function url_get_contents ($Url) {
            if (!function_exists('curl_init')){ 
                die('CURL is not installed!');
            }
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }


    public function currencyConverter() 
    {
        $from_Currency=$this->input->post('from');
        $to_Currency=$this->input->post('to');
        $amount=$this->input->post('amount');

        $from_Currency = urlencode($from_Currency);
        $to_Currency = urlencode($to_Currency);
        $get = $this->url_get_contents("https://finance.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
      
        $get = explode("<span class=bld>",$get);
        $get = explode("</span>",$get[1]);
        $converted_currency = preg_replace("/[^0-9\.]/", null, $get[0]);
        echo $converted_currency;
    }


}