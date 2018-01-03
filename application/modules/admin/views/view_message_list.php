 <style type="text/css">
   .urgent{
   
   /* color: yellow;*/

   }

   /* The switch - the box around the slider */
   body {
     font-family: "Montserrat", "Lato", "Open Sans", "Helvetica Neue", Helvetica, Calibri, Arial, sans-serif;
     color: #6b7381;
     background: #f2f2f2;
   }
   .jumbotron {
     background: #6b7381;
     color: #bdc1c8;
   }
   .jumbotron h1 {
     color: #fff;
   }
   .example {
     margin: 4rem auto;
   }
   .example > .row {
     margin-top: 2rem;
     height: 5rem;
     vertical-align: middle;
     text-align: center;
     border: 1px solid rgba(189, 193, 200, 0.5);
   }
   .example > .row:first-of-type {
     border: none;
     height: auto;
     text-align: left;
   }
   .example h3 {
     font-weight: 400;
   }
   .example h3 > small {
     font-weight: 200;
     font-size: 0.75em;
     color: #939aa5;
   }
   .example h6 {
     font-weight: 700;
     font-size: 0.65rem;
     letter-spacing: 3.32px;
     text-transform: uppercase;
     color: #bdc1c8;
     margin: 0;
     line-height: 5rem;
   }
   .example .btn-toggle {
     top: 50%;
     transform: translateY(-50%);
   }
   .btn-toggle {
     margin: 0 4rem;
     padding: 0;
     position: relative;
     border: none;
     height: 1.5rem;
     width: 3rem;
     border-radius: 1.5rem;
     color: #6b7381;
     background: #bdc1c8;
   }
   .btn-toggle:focus,
   .btn-toggle.focus,
   .btn-toggle:focus.active,
   .btn-toggle.focus.active {
     outline: none;
   }
   .btn-toggle:before,
   .btn-toggle:after {
     line-height: 1.5rem;
     width: 4rem;
     text-align: center;
     font-weight: 600;
     font-size: 0.75rem;
     text-transform: uppercase;
     letter-spacing: 2px;
     position: absolute;
     bottom: 0;
     transition: opacity 0.25s;
   }
   .btn-toggle:before {
     content: "Off";
     left: -4rem;
   }
   .btn-toggle:after {
     content: "On";
     right: -4rem;
     opacity: 0.5;
   }
   .btn-toggle > .handle {
     position: absolute;
     top: 0.1875rem;
     left: 0.1875rem;
     width: 1.125rem;
     height: 1.125rem;
     border-radius: 1.125rem;
     background: #fff;
     transition: left 0.25s;
   }
   .btn-toggle.active {
     transition: background-color 0.25s;
   }
   .btn-toggle.active > .handle {
     left: 1.6875rem;
     transition: left 0.25s;
   }
   .btn-toggle.active:before {
     opacity: 0.5;
   }
   .btn-toggle.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-sm:before,
   .btn-toggle.btn-sm:after {
     line-height: -0.5rem;
     color: #fff;
     letter-spacing: 0.75px;
     left: 0.4125rem;
     width: 2.325rem;
   }
   .btn-toggle.btn-sm:before {
     text-align: right;
   }
   .btn-toggle.btn-sm:after {
     text-align: left;
     opacity: 0;
   }
   .btn-toggle.btn-sm.active:before {
     opacity: 0;
   }
   .btn-toggle.btn-sm.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-xs:before,
   .btn-toggle.btn-xs:after {
     display: none;
   }
   .btn-toggle:before,
   .btn-toggle:after {
     color: #6b7381;
   }
   .btn-toggle.active {
     background-color: #29b5a8;
   }
   .btn-toggle.btn-lg {
     margin: 0 5rem;
     padding: 0;
     position: relative;
     border: none;
     height: 2.5rem;
     width: 5rem;
     border-radius: 2.5rem;
   }
   .btn-toggle.btn-lg:focus,
   .btn-toggle.btn-lg.focus,
   .btn-toggle.btn-lg:focus.active,
   .btn-toggle.btn-lg.focus.active {
     outline: none;
   }
   .btn-toggle.btn-lg:before,
   .btn-toggle.btn-lg:after {
     line-height: 2.5rem;
     width: 5rem;
     text-align: center;
     font-weight: 600;
     font-size: 1rem;
     text-transform: uppercase;
     letter-spacing: 2px;
     position: absolute;
     bottom: 0;
     transition: opacity 0.25s;
   }
   .btn-toggle.btn-lg:before {
     content: "Off";
     left: -5rem;
   }
   .btn-toggle.btn-lg:after {
     content: "On";
     right: -5rem;
     opacity: 0.5;
   }
   .btn-toggle.btn-lg > .handle {
     position: absolute;
     top: 0.3125rem;
     left: 0.3125rem;
     width: 1.875rem;
     height: 1.875rem;
     border-radius: 1.875rem;
     background: #fff;
     transition: left 0.25s;
   }
   .btn-toggle.btn-lg.active {
     transition: background-color 0.25s;
   }
   .btn-toggle.btn-lg.active > .handle {
     left: 2.8125rem;
     transition: left 0.25s;
   }
   .btn-toggle.btn-lg.active:before {
     opacity: 0.5;
   }
   .btn-toggle.btn-lg.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-lg.btn-sm:before,
   .btn-toggle.btn-lg.btn-sm:after {
     line-height: 0.5rem;
     color: #fff;
     letter-spacing: 0.75px;
     left: 0.6875rem;
     width: 3.875rem;
   }
   .btn-toggle.btn-lg.btn-sm:before {
     text-align: right;
   }
   .btn-toggle.btn-lg.btn-sm:after {
     text-align: left;
     opacity: 0;
   }
   .btn-toggle.btn-lg.btn-sm.active:before {
     opacity: 0;
   }
   .btn-toggle.btn-lg.btn-sm.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-lg.btn-xs:before,
   .btn-toggle.btn-lg.btn-xs:after {
     display: none;
   }
   .btn-toggle.btn-sm {
     margin: 0 0.5rem;
     padding: 0;
     position: relative;
     border: none;
     height: 1.5rem;
     width: 3rem;
     border-radius: 1.5rem;
   }
   .btn-toggle.btn-sm:focus,
   .btn-toggle.btn-sm.focus,
   .btn-toggle.btn-sm:focus.active,
   .btn-toggle.btn-sm.focus.active {
     outline: none;
   }
   .btn-toggle.btn-sm:before,
   .btn-toggle.btn-sm:after {
     line-height: 1.5rem;
     width: 0.5rem;
     text-align: center;
     font-weight: 600;
     font-size: 0.55rem;
     text-transform: uppercase;
     letter-spacing: 2px;
     position: absolute;
     bottom: 0;
     transition: opacity 0.25s;
   }
   .btn-toggle.btn-sm:before {
     content: "Off";
     left: -0.5rem;
   }
   .btn-toggle.btn-sm:after {
     content: "On";
     right: -0.5rem;
     opacity: 0.5;
   }
   .btn-toggle.btn-sm > .handle {
     position: absolute;
     top: 0.1875rem;
     left: 0.1875rem;
     width: 1.125rem;
     height: 1.125rem;
     border-radius: 1.125rem;
     background: #fff;
     transition: left 0.25s;
   }
   .btn-toggle.btn-sm.active {
     transition: background-color 0.25s;
   }
   .btn-toggle.btn-sm.active > .handle {
     left: 1.6875rem;
     transition: left 0.25s;
   }
   .btn-toggle.btn-sm.active:before {
     opacity: 0.5;
   }
   .btn-toggle.btn-sm.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-sm.btn-sm:before,
   .btn-toggle.btn-sm.btn-sm:after {
     line-height: -0.5rem;
     color: #fff;
     letter-spacing: 0.75px;
     left: 0.4125rem;
     width: 2.325rem;
   }
   .btn-toggle.btn-sm.btn-sm:before {
     text-align: right;
   }
   .btn-toggle.btn-sm.btn-sm:after {
     text-align: left;
     opacity: 0;
   }
   .btn-toggle.btn-sm.btn-sm.active:before {
     opacity: 0;
   }
   .btn-toggle.btn-sm.btn-sm.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-sm.btn-xs:before,
   .btn-toggle.btn-sm.btn-xs:after {
     display: none;
   }
   .btn-toggle.btn-xs {
     margin: 0 0;
     padding: 0;
     position: relative;
     border: none;
     height: 1rem;
     width: 2rem;
     border-radius: 1rem;
   }
   .btn-toggle.btn-xs:focus,
   .btn-toggle.btn-xs.focus,
   .btn-toggle.btn-xs:focus.active,
   .btn-toggle.btn-xs.focus.active {
     outline: none;
   }
   .btn-toggle.btn-xs:before,
   .btn-toggle.btn-xs:after {
     line-height: 1rem;
     width: 0;
     text-align: center;
     font-weight: 600;
     font-size: 0.75rem;
     text-transform: uppercase;
     letter-spacing: 2px;
     position: absolute;
     bottom: 0;
     transition: opacity 0.25s;
   }
   .btn-toggle.btn-xs:before {
     content: "Off";
     left: 0;
   }
   .btn-toggle.btn-xs:after {
     content: "On";
     right: 0;
     opacity: 0.5;
   }
   .btn-toggle.btn-xs > .handle {
     position: absolute;
     top: 0.125rem;
     left: 0.125rem;
     width: 0.75rem;
     height: 0.75rem;
     border-radius: 0.75rem;
     background: #fff;
     transition: left 0.25s;
   }
   .btn-toggle.btn-xs.active {
     transition: background-color 0.25s;
   }
   .btn-toggle.btn-xs.active > .handle {
     left: 1.125rem;
     transition: left 0.25s;
   }
   .btn-toggle.btn-xs.active:before {
     opacity: 0.5;
   }
   .btn-toggle.btn-xs.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-xs.btn-sm:before,
   .btn-toggle.btn-xs.btn-sm:after {
     line-height: -1rem;
     color: #fff;
     letter-spacing: 0.75px;
     left: 0.275rem;
     width: 1.55rem;
   }
   .btn-toggle.btn-xs.btn-sm:before {
     text-align: right;
   }
   .btn-toggle.btn-xs.btn-sm:after {
     text-align: left;
     opacity: 0;
   }
   .btn-toggle.btn-xs.btn-sm.active:before {
     opacity: 0;
   }
   .btn-toggle.btn-xs.btn-sm.active:after {
     opacity: 1;
   }
   .btn-toggle.btn-xs.btn-xs:before,
   .btn-toggle.btn-xs.btn-xs:after {
     display: none;
   }
   .btn-toggle.btn-secondary {
     color: #6b7381;
     background: #bdc1c8;
   }
   .btn-toggle.btn-secondary:before,
   .btn-toggle.btn-secondary:after {
     color: #6b7381;
   }
   .btn-toggle.btn-secondary.active {
     background-color: #ff8300;
   }

 </style>
 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Message
              <small>Management</small>
            </h1>
            <ol class="breadcrumb">

            <?php foreach($breadcrumb as $key => $value):?>
              <?php if($value==''):   ?>
                 <li class="active"><?= ucfirst($key) ?></li>
               <?php else:  ?>
              <li><a href="<?php echo base_url();?>admin/<?php echo $value; ?>"><i class="fa fa-dashboard"></i><?= $value ?></a></li>
              
            <?php endif; ?>
             
            <?php endforeach; ?>
            </ol>
          </section>

          <!-- Main content -->
          <section class="content">
          
          <?php if($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>

            <?php endif;  ?>

            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                 </div><!-- /.box-header -->
                  <div class="box-body">

                    <div class="row">
                      <div class="col-md-6">
                        <a href="<?= base_url().$button_action ?>" class="btn btn-primary"><?= $button; ?></a>
                      </div>
                      
                      <div class="pull-right">
                        <div class="col-md-6">
                          <?php $status=$this->db->where('id',1)->get('settings')->row()->login_status; ?>
                         <button type="button" class="btn btn-lg btn-toggle <?php if($status=='1'){ echo "active";}else { echo "";}  ?> " id="login_status" data-toggle="button" aria-pressed="true" autocomplete="off">
                           <div class="handle"></div>
                         </button>
                       </div>
                       </div>
                      

                    </div>
                    <br/>
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"></div><div class="row"><div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr role="row">

                        <?php foreach ($fields as $field)
                         {
                          echo '<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 177px;">'.$field.'</th>';
                         }   ?>

                        </tr>
                                             
                      </thead>
                      <tbody>
                        <?php 
                        
              
              foreach($query->result() as $row):   
              $opened=$row->opened;
              $urgent=$row->urgent;
             
              if($opened==1)
              {
                $icon="<i class='fa fa-envelope'></li>";
              }else
              {
                $icon="<i class='fa fa-envelope' style='color:orange'></li>";
              }
              $date_sent=get_nice_date($row->created_at,'shorter');
              if($row->sent_by==0)
              {
                $sent_by='Admin';
              }else
              {
                $sent_by=get_user_info($row->sent_by);
               
               
              }

              ?>
                

              <tr <?php if($urgent==1){ echo 'class="urgent"';}   ?>>

                <td class="span1"><?= $icon;?></td>
                
                <td><?php echo  $date_sent; ?></td>
                <td class="center"><?= $sent_by->full_name; ?></td>
                
                <td class="center"><?= $row->subject; ?></td>
                
                <td class="center span1">
                  
                  <a class="btn btn-info" href="<?= base_url();?>admin/message/view/<?= $row->id; ?>">View
                    <i class="halflings-icon white zoom-in"></i>  
                  </a>
                  <!-- <a class="btn btn-danger" href="#">
                    <i class="halflings-icon white trash"></i> 
                  </a> -->
                </td>
              </tr>

            <?php endforeach; ?>
                       
                        
                      </tbody>
                      
                    </table>
                    </div>
                    </div>

                  <!-- for pagination of datatables -->
                    <div class="row"><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"></div></div>
                    </div>
                    </div>
                    
                  </div>
                </div><!-- /.box -->
              </div><!-- /.col -->
            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
       