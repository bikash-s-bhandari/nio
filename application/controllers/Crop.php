<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crop extends CI_Controller {

   public function index()
	{
	    
	      // $up_path_tmp=str_replace("application\\","", APPPATH);
	      // $up_path=str_replace("\\","/",$up_path_tmp)."uploads/landmark/";
	      // echo $up_path;
	      //die();
		
		$this->load->view('crop');
	}

	public function upload_file()
	{
			// get the tmp url
	$photo_src = $_FILES['photo']['tmp_name'];
	
	
	// test if the photo realy exists
	if (is_file($photo_src)) {

	// photo path in our example
		 $up_path_tmp=str_replace("application\\","", APPPATH);
	     $up_path=str_replace("\\","/",$up_path_tmp).'uploads/landmark/photo_'.time().'.jpg';
	$photo_dest = $up_path;


	// copy the photo from the tmp path to our path
	copy($photo_src, $photo_dest);
	$photo_dest=base_url().str_replace('C:/xampp/htdocs/nio/','',$photo_dest);
	//dumparray($photo_dest);

	// call the show_popup_crop function in JavaScript to display the crop popup
	echo '<script type="text/javascript">window.top.window.show_popup_crop("'.$photo_dest.'")</script>';
}
	}




	public function crop_photo()
	{
		// Target siz
	$targ_w = $_POST['targ_w'];
	$targ_h = $_POST['targ_h'];
	// quality
	$jpeg_quality = 90;
	// photo path
	$src = $_POST['photo_url'];

	// dumparray($src);

	 // $up_path_tmp=str_replace("application\\","", APPPATH);
	 // $up_path=str_replace("\\","/",$up_path_tmp).'uploads/landmark/photo_'.time().'.jpg';
	
	// create new jpeg image based on the target sizes
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
	// crop photo
	$check = imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'], $targ_w,$targ_h,$_POST['w'],$_POST['h']);
	// create the physical photo
	// dumparray($dst_r);


	imagejpeg($dst_r,$src,$jpeg_quality);
	// display the  photo - "?time()" to force refresh by the browser
	echo '<img src="'.$src.'?'.time().'">';
	exit;
	}
}
