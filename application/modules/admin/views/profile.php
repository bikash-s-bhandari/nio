<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Profile Management
           
          </h1>
          <ol class="breadcrumb">
         
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
<?php if($this->session->flashdata('success')):  ?>
                      <p class="alert alert-success" id="pass" style="text-aligh:center"><?= $this->session->flashdata('success'); ?></p>

                    <?php  endif;?>
                    <?php if($this->session->flashdata('error')):  ?>
                      <p class="alert alert-danger" id="cpass"  style="text-aligh:center"><?= $this->session->flashdata('error'); ?></p>

                    <?php  endif;?>
              <!-- general form elements -->
              <div class="box box-primary">

               <div class="box box-info">
                
                    
                <div class="box-header with-border">
                  <h3 class="box-title"><?//$table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
            <?php // echo form_open_multipart($action); ?>
            <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?=  base_url();?>assets/dist/img/user2-160x160.jpg" alt="User profile picture">
                  <?php
              $fullname=$this->session->userdata('admin_user')['fname'].' '.$this->session->userdata('admin_user')['lname'];
              ?>
                  <h3 class="profile-username text-center"><?php if($fullname!=''){  echo $fullname;} ?></h3>



               
                <!-- form start -->
                <form class="form-horizontal" action="<?= base_url('admin');?>/changePassword" method="post">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="<?= $user->fname; ?>" id="inputEmail3" placeholder="First Name" name="fname">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Last Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control"  value="<?= $user->lname; ?>" id="inputEmail3" placeholder="Last Name" name="lname">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputPassword3" class="col-sm-2 control-label">New Password</label>
                      <div class="col-sm-10">
                     
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                        
                      </div>
                    </div>
                    <div class="form-group">
                     <label for="inputPassword3" class="col-sm-2 control-label">Confirm Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" id="inputPassword3" placeholder="Confirm Password" name="password2">
                        <?php echo form_error('password2'); ?>

                      </div>
                      
                    </div>

                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                   
                    <button type="submit" class="btn btn-primary pull-right">Update Now</button>
                  </div><!-- /.box-footer -->
                </form>
              </div>
                
                  

                 
                  
                </div><!-- /.box-body -->
                
                    
              </div><!-- /.box -->

              

              

            </div><!--/.col (left) -->
            <!-- right column -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 