<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Template {

    var $template_data = array();

    function set($name, $value)
    {
        $this->template_data[$name] = $value;
    }
//$template is templae in view which is use to disply the layout name,$view is view name,$view_data is data to be passed in view
    function load($template = '', $view = '', $view_data = array(), $return = FALSE)
     {
        $this->CI = & get_instance();
        $this->set('head', $this->CI->load->view('templates/head', $view_data, TRUE));// head ma head view load gareko jun template ma echo $head vako xa 
        $this->set('header', $this->CI->load->view('templates/header', $view_data, TRUE));
        $this->set('left_nav', $this->CI->load->view('templates/left_nav', $view_data, TRUE));
        $this->set('content', $this->CI->load->view($view, $view_data, TRUE));
        $this->set('footer', $this->CI->load->view('templates/footer', $view_data, TRUE));
        $this->set('slide_left_content', $this->CI->load->view('templates/slide_left_content', $view_data, TRUE));
        //$this->set('search', $this->CI->load->view('templates/search', $view_data, TRUE));
       
        //$this->set('model_message', $this->CI->load->view('templates/model_message', $view_data, TRUE));
        //$this->set('model_notification', $this->CI->load->view('templates/model_notification', $view_data, TRUE));
        
        //$this->set('right_nav', $this->CI->load->view('templates/right_nav', $view_data, TRUE));
        

        return $this->CI->load->view($template, $this->template_data, $return);
    }

    //for frontend

    function front($template = '', $view = '', $view_data = array(), $return = FALSE) {
        $this->CI = & get_instance();
        $this->set('head', $this->CI->load->view('frontend/templates/head', $view_data, TRUE));
        $this->set('header', $this->CI->load->view('frontend/templates/header', $view_data, TRUE));
        // $this->set('nav',$this->CI->load->view('frontend/templates/nav',$view_data,TRUE));
        $this->set('content', $this->CI->load->view($view, $view_data, TRUE));
        $this->set('footer', $this->CI->load->view('frontend/templates/footer', $view_data, TRUE));
        $this->set('foot', $this->CI->load->view('frontend/templates/foot', $view_data, TRUE));
        return $this->CI->load->view($template, $this->template_data, $return);
    }

}

/* End of file Template.php */
/* Location: ./system/application/libraries/Template.php */