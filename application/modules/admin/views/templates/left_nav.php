  <?php if($nav!=""){$nav=$nav;
  }else
  {
    $nav="";
  }
 
 


  ?>

      <!-- contains the logo and  left sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <?php
              $fullname=$this->session->userdata('admin_user')['fname'].' '.$this->session->userdata('admin_user')['lname'];
              ?>
            <div class="pull-left info">
              <p><?php if($fullname!=''){  echo $fullname;} ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?php if($nav=='dashboard') echo 'active';?> treeview">
              <a href="<?= base_url('admin/dashboard'); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
              </a>
              
            </li>
            <li class="<?php if($nav=='settings'){echo "active";}?> treeview">
              <a href="<?php echo base_url('admin');?>/settings">
                <i class="fa fa-gears"></i>
                <span>App Setting</span>
              
              </a>
             
            </li>
            <li class="<?php if($nav=='users'){echo "active";}?> treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>User Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <?php if($this->session->userdata('admin_user')['role']=='superadmin'){  ?>
            <li><a href="<?php echo base_url('admin/user/admin_user');?>"><i class="fa fa-file"></i>Admins</a></li>
            <?php } ?>
            <li><a href="<?php echo base_url('admin/user');?>"><i class="fa fa-file"></i>Registered Users</a></li>
               </ul>
            </li>
          

          <li class="<?php if($nav=='landmark') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i>
                <span>Landmarks</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              
                <li><a href="<?php echo base_url('admin/landmark');?>"><i class="fa fa-file"></i>Landmarks</a></li>

                <li><a href="<?php echo base_url('admin/landmark/create');?>"><i class="fa fa-plus-circle"></i>Add New Landmark</a></li>
                
                
                
              </ul>
           </li>

           <li class="<?php if($nav=='news') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>News Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/news/category');?>"><i class="fa fa-file"></i>Categories</a></li>
                <li><a href="<?php echo base_url('admin/news');?>"><i class="fa fa-file"></i>News</a></li>
                <li><a href="<?php echo base_url('admin/news/create');?>"><i class="fa fa-plus-circle"></i>Add New News</a></li>
                
                
                
              </ul>
           </li>
              
            <li class="<?php if($nav=='page') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-th-list"></i>
                <span>Content Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a  href="<?php echo base_url('admin/page');?>"><i class="fa fa-file"></i>Pages</a></li>
                <li><a href="<?php echo base_url('admin/page/create');?>"><i class="fa fa-plus-circle"></i>Add New Pages</a></li>
                <li><a href="<?php echo base_url('admin/page/category');?>"><i class="fa fa-file"></i>Navigations</a></li>
                <li><a href="<?php echo base_url('admin/page/create_category');?>"><i class="fa fa-plus-circle"></i> Add New Navigation</a></li>
                <li><a href="<?php echo base_url('admin/page/nav_group');?>"><i class="fa fa-file"></i>Navigation Groups</a></li>
                <li><a href="<?php echo base_url('admin/page/create_nav_group');?>"><i class="fa fa-plus-circle"></i> Add Navigation Group</a></li>
                
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.left sidebar -->
      </aside>