<?php
if(!defined('BASEPATH'))
exit('No direct script access allowed');

// for user authentication
function check_admin_login()
{

	$ci=&get_instance();
	
	if(!isset($ci->session->userdata('admin_user')['user_id']))
	{
		redirect(base_url('admin'),'refresh');

	}
    elseif(!$ci->session->userdata('admin_user'))
    {
    	redirect(base_url('admin'),'refresh');

    }
    	
    	
  } 


//printing array structure

function dumparray($array,$exit=TRUE)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	if($exit)
	{
		exit();
	}

}


//printing last excuted query

function printQuery()
{
	$ci=&get_instance();
	echo $ci->db->last_query();
	exit();
}

/**
 * checks if the values is set if not sets 0 to it especially for checkbox
 * @param type $input
 * @return type
 */

 function filter_checkbox($input)
 {
 	$return = !isset($input)? '0':$input;
 	return $return;

 }

 // **
 // * checks sataus and returns the realted term to display
 // * @param type $record
 // * @return type
 // */

 function check_status($record,$a='Active',$b='In Active')
 {
 	foreach ($record as $key => $value) 
 	{
 		if($value->status==1)
 		{
 			$record[$key]->status=$a;//status=active gareko
 		}
 		else if($value->status==0)
 		{
 			$record[$key]->status=$b;

 		}
 		
 	}
 	return $record;

 }


 /**
 * decodes the json encoded images and displays the first in row image as preview
 * @param type $record
 * @return type
 */

 function image_check($record)
 {
 	foreach ($record as $key => $value) {
 		$img=$value->image;
 		$preview='';
 		if(!empty($img))
 		{
 			$image=json_decode($image);
 			$preview=!empty($image)? $image[0]:'';
 		}
 		$record[$key]->image=$preview;
 	}
 	return $record;
 }


 //for breadcrumb it is in form of associative array

 function display_breadcrumb($breadcrumb)
 {
 	$bread='<ul class="page-breadcrumb">';
 	foreach ($breadcrumb as $key => $value) 
 	{
 		if($value==''):
 		
 			$bread.='<li class="active">'.ucfirst($key).'</li>';
 		else:
 		if($key=='Dashboard'):
 		    $bread.='<li><i class="fa fa-home"></i><a href="'.base_url().'admin/'.$value.'">'.ucfirst($key).'</a><i class="fa fa-angle-right"></i></li>';
 		else:
			$bread.='<li><a href="'.base_url().'admin/'.$value.'">'.ucfirst($key).'</a><i class="fa fa-angle-right"></i></li>';
 		endif;
 		endif;
 	}
 	$bread.='</ul>';
 	return $bread;

 }

 //password hasing

 function make_hash($password,$salt)
 {
 	$hash=sha1($password.$salt);
 	return $hash;
 }


 //supre getwhere

 function getWhere($table,$where,$result=FALSE,$order_by='',$limit='',$offset=0)
 {
 	$ci=&get_instance();
 	if($where!='')
 	{
 		$ci->db->where($where);//$where should be in array
 	}

 	if($order_by!='')
 	{
 		$ci->db->order_by($order_by);

 	}

 	if($limit!='')
 	{
 		$ci->db->limit($limit,$offset);
 	}

 	$query=$ci->db->get($table);
 	if($query->num_rows()==0)
 	{
 		return FALSE;

 	}
 	else
 	{
 		if($result==TRUE)
 		{
 			return $query->result();
 		}
 		else
 		{
 			return $query->row();
 		}

 	}
}


//date format

function db_format($date)
{
	return date('Y-m-d',strtotime($date));
}

//user format

function user_format($date) 
{
    $time = strtotime($date);
    if ($time == 0) {
        return ' - ';
    } else {
        return date('M d Y', strtotime($date));
    }
}

function api_format($date) 
{
    $time = strtotime($date);
    if ($time == 0) {
        return ' - ';
    } else {
        return date('d M, Y', strtotime($date));
    }
}

function spilt_format($date) 
{
    $time = strtotime($date);
    if ($time == 0) {
        return ' - ';
    } else {
        $a['m']= date('M', strtotime($date));

        $a['y']=  date('Y', strtotime($date));

        $a['d']=  date('d', strtotime($date));
        return $a;
    }
}







function save($table,$data)
{
	
	$ci=&get_instance();
	$ci->db->insert($table,$data);
	return;

}

function update($table,$data,$condition)
{
	$ci=&get_instance();
	$ci->db->where($condition['key'],$condition['value']);
	$ci->db->update($table,$data);
	return;

}

function delete($table, $id) {
    $ci = & get_instance();
    $ci->db->where('id', $id);
    $ci->db->delete($table);
    return;
}


//setting messages in session

function set_message($status,$task)
{
	$ci = & get_instance();
	$ci->session->set_flashdata($status,$task);

	
}


/*navigation group listing*/
function get_nav_groups()
{
	$ci=&get_instance();
	$array['']="------------";
	$sql=$ci->db->get('navigation_groups')->result();
	foreach ($sql as $k=> $v) {
		$array[$v->id]=$v->title;

		
	}
	return $array;
}

/*page category listing*/
function get_navigation_list()
{
	$ci=&get_instance();
	$array['']="------------";
	$sql=$ci->db->get('page_navigation')->result();
	foreach ($sql as $k=> $v) {
		$array[$v->id]=$v->title;

		
	}
	return $array;
}

/*landmarks category*/

function get_landmark_categories()
{

	$ci=&get_instance();
	$array['']="------------";
	$sql=$ci->db->get('landmark_category')->result();
	foreach ($sql as $k=> $v) {
		$array[$v->id]=$v->cat_title;

		
	}
	return $array;

}

function get_counselor_categories()
{
	$ci=&get_instance();
	$array['']="------------";
	$sql=$ci->db->get('counselor_category')->result();
	foreach ($sql as $k=> $v) {
		$array[$v->id]=$v->cat_title;

		
	}
	return $array;

}


/*getting news category id*/
function get_cat_id($news_id)
{
	$ci = & get_instance();
	$query=$ci->db->select('*')
	->from('news')
	->where('id',$news_id)
	->get();
	return $query->row();

}


/*generating random string*/
function generate_random_string($length)
	{
		$characters="!$#@23456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randomString="";
		for($i=0;$i<$length;$i++)
		{
			$randomString.=$characters[rand(0,strlen($characters)-1)];

		}
	
		return $randomString;
	}

/*get user role*/

function get_role($id)
{
	$ci = & get_instance();
	$query=$ci->db->select('*')
	->from('roles')
	->where('id',$id)
	->get();
	return $query->row()->role;

}


 

