
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            App Management
            
          </h1>
          <ol class="breadcrumb">
          <?php foreach($breadcrumb as $key => $value):?>
            <?php if($value==''):  ?>
            <li class="active"><?= ucfirst($key);?></li>

            <?php else:  ?>
          <li><a href="<?php echo base_url();?>admin/<?php echo $value;?>"><?= ucfirst($key);?></a></li>
          <?php endif; endforeach; ?>
            
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
          <?php if($this->session->flashdata('success')):    ?>
            <div class=" col-sm-offset-0 col-sm-12">
                     
             <center><div id="success" class="alert alert-success"><?= $this->session->flashdata('success'); ?></div></center>
           </div> 
              
           
            
          <?php endif; ?>
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?= $table_name; ?></h3>
                </div><!-- /.box-header -->
             


               
                <!-- form start -->
               <form action="<?php echo base_url('admin');?>/settings" method="post" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">App Name</label>
                      <input type="text" class="form-control"  name="app_name" value="<?= $settings->app_name; ?>" id="exampleInputEmail1" placeholder="Enter App Name">
                    </div>
                    <!-- <div class="form-group">
                      <label for="exampleInputEmail1">Sub Name</label>
                      <input type="text" class="form-control"  name="sub_name" value="<?= $settings->sub_name; ?>" id="exampleInputEmail1" placeholder="Enter App Sub Name">
                    </div> -->
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">App Slogan</label>
                      <input type="text" class="form-control"  name="app_slogan" value="<?= $settings->app_slogan; ?>" id="exampleInputEmail1" placeholder="Enter App Slogan">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">App Logo</label>

            <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
             
            <img src="<?php echo base_url('uploads').'/logo/'.$settings->logo_url ?>">
                          
            </div>
            <div>
              <span class="btn default btn-file">
              <span class="fileinput-new">
              Select image </span>
              <span class="fileinput-exists">
              Change </span>
              <input type="file" name="userfile">
              </span>
              <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">
              Remove </a>
            </div>
          </div>
                      
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Email</label>
                      <input type="email" name="contact_email" value="<?= $settings->contact_email; ?>" class="form-control" id="form_control_1" placeholder="Enter your contact email address">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Phone</label>
                      <input type="text" name="contact_phone" value="<?= $settings->contact_phone; ?>" class="form-control" id="form_control_1" placeholder="Enter your contact phone">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Contact Address</label>
                     <input type="text" name="contact_address" value="<?= $settings->contact_address; ?>" class="form-control" id="form_control_1" placeholder="Enter your contact address">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Website URL</label>
                     <input type="text" name="website_url" value="<?= $settings->website_url; ?>" class="form-control" id="form_control_1" placeholder="Enter your website url">
                    </div>
                    
                     <div class="form-group">
                      <label for="exampleInputEmail1">Copyright</label>
                    <input type="text" name="copyright" value="<?= $settings->copyright; ?>" class="form-control" id="form_control_1" placeholder="Copyright">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">About App</label>
                     <textarea class="form-control" rows="3" name="about_app" placeholder="App Descriptions"><?= $settings->about_app; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Facebook URL</label>
                     <input type="text" name="facebook_url" value="<?= $settings->facebook_url; ?>" class="form-control" id="form_control_1" placeholder="http://www.facebook.com">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Twitter URL</label>
                    <input type="text" name="twitter_url" value="<?= $settings->twitter_url; ?>" class="form-control" id="form_control_1" placeholder="http://www.twitter.com">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Google Plus URL</label>
                   <input type="text" name="google_url" value="<?= $settings->google_url; ?>" class="form-control" id="form_control_1" placeholder="http://www.google.com">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Youtube URL</label>
                     <input type="text" name="youtube_url" value="<?= $settings->youtube_url; ?>" class="form-control" id="form_control_1" placeholder="http://www.youtube.com">
                    </div>



                   
                   
                 
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
             
              
                
              </div><!-- /.box -->

              

              

             


            </div><!--/.col (left) -->
            <!-- right column -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      