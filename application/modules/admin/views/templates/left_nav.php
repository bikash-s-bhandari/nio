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
              <p><?php if($fullname!=''){  echo $fullname;}else {echo "Admin";} ?></p>
             

              <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>

            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <!-- <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div> -->
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

            <li class="<?php if($nav=='msg'){echo "active";}?> treeview">
              <a href="<?php echo base_url('admin');?>/ambassador">
                <i class="fa fa-envelope"></i>
                <span>Ambassador Message</span>
              </a>
            </li>
             <li class="<?php if($nav=='currency') echo 'active';?> treeview">
              <a href="<?php echo base_url('admin')?>/currency">
                <i class="fa fa-money" aria-hidden="true"></i>
                <span>Curreny Converter</span>
              </a>
            </li>
            <li class="<?php if($nav=='notice') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span>Notice</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/notice');?>"><i class="fa fa-file"></i>Notices</a></li>
                <li><a href="<?php echo base_url('admin/notice/create');?>"><i class="fa fa-plus-circle"></i>Add New</a></li>
             </ul>
            </li>
            <li class="<?php if($nav=='notification') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-bell" aria-hidden="true"></i>
                <span>Push Notification</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/notification');?>"><i class="fa fa-file"></i>Notification</a></li>
                <li><a href="<?php echo base_url('admin/notification/create');?>"><i class="fa fa-plus-circle"></i>Add New</a></li>
             </ul>
            </li>

            <li class="<?php if($nav=='press') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-list-alt" aria-hidden="true"></i>
                <span>Press Realese</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/press_realese');?>"><i class="fa fa-file"></i>Press</a></li>
                <li><a href="<?php echo base_url('admin/press_realese/create');?>"><i class="fa fa-plus-circle"></i>Add New</a></li>
             </ul>
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
            <li class="<?php if($nav=='con_affair') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-book"></i>
                <span>Counselor Affair</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/counselor/category');?>"><i class="fa fa-file"></i>Categories</a></li>
                <li><a href="<?php echo base_url('admin/counselor');?>"><i class="fa fa-file"></i>Counselor</a></li>

               
              </ul>
             </li>
          
             <li class="<?php if($nav=='landmark') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i>
                <span>Landmarks</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/landmark/category');?>"><i class="fa fa-file"></i>Categories</a></li>
                <li><a href="<?php echo base_url('admin/landmark');?>"><i class="fa fa-file"></i>Landmarks</a></li>

                <li><a href="<?php echo base_url('admin/landmark/create');?>"><i class="fa fa-plus-circle"></i>Add New Landmark</a></li>
              </ul>
             </li>

           <li class="<?php if($nav=='news') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-newspaper-o"></i>
                <span>News & Events Manage</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('admin/news/category');?>"><i class="fa fa-file"></i>Categories</a></li>
                <li><a href="<?php echo base_url('admin/news');?>"><i class="fa fa-file"></i>News</a></li>
                <li><a href="<?php echo base_url('admin/news/create');?>"><i class="fa fa-plus-circle"></i>Add New News</a></li>
                <li><a href="<?php echo base_url('admin/event');?>"><i class="fa fa-file"></i>Events</a></li>
                <li><a href="<?php echo base_url('admin/event/create');?>"><i class="fa fa-plus-circle"></i>Add New Events</a></li>
                
                
                
              </ul>
           </li>
              
            <li class="<?php if($nav=='page') echo 'active';?> treeview">
              <a href="#">
                <i class="fa fa-th-list"></i>
                <span>Content Management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a  href="<?php echo base_url('admin/slider');?>"><i class="fa fa-file"></i>Sliders</a></li>
                <li><a  href="<?php echo base_url('admin/slider/create');?>"><i class="fa fa-plus-circle"></i>Add Slider</a></li>
                <li><a  href="<?php echo base_url('admin/page');?>"><i class="fa fa-file"></i>Pages</a></li>
                <li><a href="<?php echo base_url('admin/page/create');?>"><i class="fa fa-plus-circle"></i>Add New Pages</a></li>
                <li><a href="<?php echo base_url('admin/page/category');?>"><i class="fa fa-file"></i>Navigations</a></li>
                <li><a href="<?php echo base_url('admin/page/create_category');?>"><i class="fa fa-plus-circle"></i> Add New Navigation</a></li>
                <li><a href="<?php echo base_url('admin/page/nav_group');?>"><i class="fa fa-file"></i>Navigation Groups</a></li>
                <li><a href="<?php echo base_url('admin/page/create_nav_group');?>"><i class="fa fa-plus-circle"></i> Add Navigation Group</a></li>
                
              </ul>
            </li>
            <li class="<?php if($nav=='download') echo 'active';   ?>"><a href="<?php echo base_url('admin/download');?>"><i class="fa fa-download" aria-hidden="true"></i>Download</a></li>
          </ul>
        </section>
        <!-- /.left sidebar -->
      </aside>