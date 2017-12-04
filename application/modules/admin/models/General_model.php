<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin General_model Model
 * @package Model
 * @subpackage Model
 * Date created: Feb 7 2016
 * @author bkesh maharjan<limited_sky710@yahoo.com>
 */
class General_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insert($table, $data) {
        $query=$this->db->insert($table, $data);
        if($query)
        {
             return $this->db->insert_id();

        }
       
    }

    function update($table, $data, $where) {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete($table, $where) {
        $this->db->where($where);
        $this->db->delete($table);
    }

    //uploading file

    function upload_file($folder, $w = '', $h = '', $fileName = 'userfile') {
//        echo $fileName;exit;
        $file = time();


        $config['upload_path'] = config_item('upload_path') . $folder;

        $config['allowed_types'] = "gif|jpg|jpeg|png";
        $config['max_size'] = 0;
        $config['max_width'] = 0;
        $config['max_height'] = 0;
        $config['file_name'] = $file;
        $this->load->library('upload', $config);



        $this->upload->initialize($config);
        if (!$this->upload->do_upload($fileName)) {
            $error = array('error' => $this->upload->display_errors());
        dumparray($error);
         //dumparray($config['upload_path']);
            $thumb = '';
        } else {
            $finfo = $this->upload->data();
            $thumb = $finfo['raw_name'] . $finfo['file_ext'];

           //  //resample image
           //  $ww = $w == '' ? config_item('img_width') : $w;
           //  $hh = $h == '' ? config_item('img_height') : $h;
           //  $this->load->library('image_moo');
           // // $this->image_moo->load('uploads/' . $folder . '/' . $thumb);
           // // $this->image_moo->resize_crop($ww, $hh);
           //  //$thumbimg = 'uploads/' . $folder . '/thumbs/' . $thumb;
           //  $this->image_moo->save($thumbimg, $overwrite = TRUE);
        }
        return $thumb;
    }





    public function uploadMultipleFiles($folder) {
        $files = $_FILES;
        $image_name = array();
        if (!empty($files['userfile']['name'][0])) {
           
            $this->load->library('upload', $this->set_upload_options($folder));
            $count = count($_FILES['userfile']['name']);
            for ($i = 0; $i < $count; $i++) {
                $_FILES['userfile']['name'] = $files['userfile']['name'][$i];
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];

                $this->upload->initialize($this->set_upload_options($folder));
                if ($this->upload->do_upload() == false) {
                    $error = array('error' => $this->upload->display_errors());
               print_r($error);exit;
                }
                $imginfo = $this->upload->data();
                $imgname = $imginfo['raw_name'] . $imginfo['file_ext'];
                $image_name[] = ($imgname);

          

               
            }


        }
        
            return $image_name;
        
    }

    private function set_upload_options($folder) {
        $this->load->helper('string');
        $file = time() . '_' . random_string('alnum', 2);
        //upload an image options
        $config = array();
        $config['upload_path'] = './uploads/' . $folder;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|svg|jpeg';
        $config['max_size'] = 0;
        $config['file_name'] = $file;
        $config['overwrite'] = TRUE;
        return $config;
    }









    function unlink_img($folder,$name)
    {


        if($name!='')
        {
            $path=config_item('upload_path').$folder.'/'.$name;
            if(file_exists($path))
            {
                unlink($path);
            }
        }

    }

    function unlink_file($folder,$name)
    {


        if($name!='')
        {
            $path=config_item('upload_path').$folder.'/'.$name;
            if(file_exists($path))
            {
                unlink($path);
            }
        }

    }


    function del_image($table,$where,$folder,$field="image")
    {
        
        $this->db->where($where);
        $query=$this->db->get($table)->row();
        $image=$query->$field;
        if($image!=='')
        {
            $path = $this->config->item('upload_path') . $folder . '/' . $image;
            $path_th = $this->config->item('upload_path') . $folder . '/thumbs/' . $image;
            if (file_exists($path)) {
                unlink($path);
                unlink($path_th);
            }
        }
        return true;


    }
    
    
     function del_images($table,$where,$folder,$field="images")
    {
        
        $this->db->where($where);
        $query=$this->db->get($table)->row();
        $image=$query->$field;
        if($image!=='')
        {
            $path = $this->config->item('upload_path') . $folder . '/' . $image;
            //$path_th = $this->config->item('upload_path') . $folder . '/thumbs/' . $image;
            if (file_exists($path)) {
                unlink($path);
                //unlink($path_th);
            }
        }
        return true;


    }

    

    
    
    

}

