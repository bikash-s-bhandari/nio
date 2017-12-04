<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

    
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Reset</b>-Password</a>
      </div><!-- /.login-logo -->
      <!--login error alert-->
      <?php if($this->session->flashdata('message')): ?>
      <div class="alert alert-danger alert-dismissable" style="min-height:50px">
     <p class="login-box-msg"><?= $this->session->flashdata('message'); ?></p>
                    
      </div>
    <?php endif; ?>
      <!--end of login error alert-->
      <div class="login-box-body">
        <p class="login-box-msg">Please enter new password to reset</p>
        <?php echo form_open(base_url().'api/auth/update_password'); ?>
          <div class="form-group has-feedback">

         
            <input type="password" class="form-control" placeholder="New Password" name="new_password">
            
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Confirm Password" name="password2">
            
          </div>
          
          <div class="row">
           <input type="hidden" name="reset_code" value="<?= $reset_code; ?>">
           
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Update</button>
            </div><!-- /.col -->
          </div>
       <?php echo form_close(); ?>

     

       
        
      
    </div>

    
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
