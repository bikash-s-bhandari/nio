 <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
    <!--<input type="hiden" id="base-url" value="<?php echo base_url();  ?>"/>-->

         <header class="main-header">
        <!-- Logo -->
        <a href="<?php  echo base_url('admin/dashboard');?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>N</b>io</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin</b> Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown messages-menu <?php if($nav=='u_message'){ echo 'active';}   ?>">
                <?php 
                $this->db->where('opened',0);
                $this->db->where('sent_to',0);
                $query=$this->db->get('chat_messages');
                $count=$query->num_rows();

                  ?>
                <a href="<?php echo base_url('admin/message');?>">
                  <i class="fa fa-envelope-o"></i>
                  <?php if($count>0):  ?>
                  <span class="label label-success"><?= $count; ?></span>
                <?php endif; ?>
                </a>
                
              </li>
              <!-- Messages: style can be found in dropdown.less-->
              <?php
              $fullname=$this->session->userdata('admin_user')['fname'].' '.$this->session->userdata('admin_user')['lname'];
              ?>
              
            
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php if($fullname!=''){  echo $fullname;} ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                    <p>
                      <?php if($fullname!=''){  echo $fullname;} ?>
                     
                    </p>
                  </li>
                  <!-- Menu Body -->
                 
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?= base_url('admin')?>/profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url('admin')?>/logout" class="btn btn-default btn-flat">Log out</a>
                    </div>
                  </li>
                </ul>
              </li>
             
            </ul>
          </div>
        </nav>
        <input type="hidden" id="base-url" value="<?= base_url(); ?>">
      </header>