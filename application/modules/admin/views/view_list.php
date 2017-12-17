 <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Content
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
            <?= $this->session->flashdata('success'); ?>

            <?php endif;  ?>

            <div class="row">
              <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                 
                   
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <div><a href="<?= base_url().$button_action ?>" class="btn btn-primary"><?= $button; ?></a></div>
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
                        $i=1;


                        if(!empty($datas)):
                          foreach($datas as $data):
                          echo '<tr role="row" class="odd">';
                          echo '<td class="sorting_1">'.$i++.'</td>';


                          foreach($data as $key=>$v):
                           if($key=='id'):
                             elseif($key=='image'):
                               echo '<td><img src="' . base_url('uploads/sliders/thumbs') . '/' . $v . '" width="100"></td>';
                             elseif($key=='photo'):
                              echo '<td><img src="' . base_url('uploads/staff_photo') . '/' . $v . '" width="100"></td>';
                            
                              else:
                              echo '<td>' .html_entity_decode($v, ENT_QUOTES,'UTF-8'). '</td>';
                                   endif;
                                   endforeach;


                              echo '<td> <span class="tooltip-area">'
                                    . '<a href="' . $edit . $data->id . '" class="btn btn-default btn-sm" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                   <a href="' . $delete . $data->id . '" class="btn btn-default btn-sm" title="" data-original-title="Delete"  onclick="return confirm(\'Are you sure\')"><i class="fa fa-trash-o"></i></a>
                                              ';
                              echo '</tr>';


                            




                            endforeach;
                           endif;
                        ?>
                        
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
       