 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              User
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
            <div id="error"><?= $this->session->flashdata('success'); ?></div>

            <?php endif;  ?>

            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                 
                   
                  </div><!-- /.box-header -->
                  <div class="box-body">
                   
                    <br/>
                    <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"></div><div class="row"><div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr role="row">

                        <?php foreach ($fields as $field)
                         {
                          echo '<th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 177px;">'.$field.'</th>';
                         }  
                          ?>
                         

                        </tr>
                                             
                      </thead>
                      <tbody>
                       

                        <?php $i=1; foreach($datas as $data):  ?>
                         <tr role="row" class="odd">
                         <td class="sorting_1"><?= $i++; ?></td>
                         <td><?= $data->full_name; ?></td>
                        
                          <td><?=  $data->email;?></td>
                          <td><?= $data->address; ?></td>
                          <?php if($data->status=='In Active'){?>
                          <td><span class="bg-red" style="text-align:center;width:100px; display:inline-block;border-radius: 3px"><?= $data->status;?></span> &nbsp;<a onclick="return confirm('Do you want to activate this account?')" href="<?php echo base_url();?>admin/user/activate/<?= $data->id; ?>" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
                           <?php } else if($data->status=='Active') { ?>
                           <td><span class="bg-green" style="text-align:center;width:100px; display:inline-block;border-radius: 3px"><?= $data->status;?></span> &nbsp;<a onclick="return confirm('Do you want to deactivate this account?')" href="<?php echo base_url();?>admin/user/deactivate/<?= $data->id; ?>" class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>

                           <?php } ?>




                          <td>
                       &nbsp; <a href="javascript:void()" class="btn btn-default btn-sm user_detail" title="View Details" data-id="<?php echo $data->id; ?>"><i class="fa fa-eye"></i></a>
                                              
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

<div class="modal fade" id="user-details" tabindex='-1' role='dialog' aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title"><legend>User Details</legend></h4>
</div>
<div class="modal-body">

<div class="row">
<div class="form-group">
    <label class="col-sm-3" for="firstname">Full Name</label>
    <div class="col-sm-9">
      <input type="text" placeholder="" id="fullname" class="form-control" readonly="readonly">
    </div>
  </div>
</div>
<br/>
<!-- <div class="row">
<div class="form-group">
    <label class="col-sm-3" for="middlename">Middle Name</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="middlename" class="form-control" readonly="readonly">
      </div>
    </div>
</div> -->
<!-- <br/> -->
<!-- <div class="row">
<div class="form-group">
    <label class="col-sm-3" for="lastname">Last Name</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="lastname" class="form-control" readonly="readonly">
      </div>
    </div>
</div> -->

<!-- <div class="row">
<div class="form-group">
    <label class="col-sm-3" for="username">Username</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="username" class="form-control" readonly="readonly">
      </div>
       
   </div>
</div> -->
<!-- <br/> -->
<div class="row">
<div class="form-group">
    <label class="col-sm-3" for="email">Email Address</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="email" class="form-control" readonly="readonly">
      </div>
       
   </div>
</div>
<br/> 
<div class="row">
<div class="form-group">
    <label class="col-sm-3" for="ipaddress">Address</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="address" class="form-control" readonly="readonly">
      </div>
    </div>
</div>
<br/>
<div class="row">
<div class="form-group">
    <label class="col-sm-3" for="ipaddress">Account Status</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="status" class="form-control" readonly="readonly">
      </div>
    </div>
</div>

<br/>
<div class="row">
<div class="form-group">
    <label class="col-sm-3" for="rd">Registered Date</label>
    <div class="col-sm-9">
        <input type="text" placeholder="" id="created_at" class="form-control" readonly="readonly">
      </div>
    </div>
</div>

</div>
<div class="modal-footer">
<button data-dismiss="modal" class="btn btn-danger" type="button">Close</button>

</div>
</div>
</div>
</div>

       