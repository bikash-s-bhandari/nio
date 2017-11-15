<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>

  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           News Management

        </h1>
          <ol class="breadcrumb">
          <?php foreach ($breadcrumb as $key => $value)
          {
            if($value==''):
              echo '<li class="active">'.ucfirst($key).'</li>';

              else:
              echo '<li><a href="'.base_url().'admin/'.$value.'">'.ucfirst($key).'</a></li>';

             endif;
           } ?>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title"><?=$table_name; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
            <?php  echo form_open($action); ?>
                  <div class="box-body">
                    <?php if($num_dropdown_options>1):   ?>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Parent Category</label>
                      <div class="row">
                        <div class="col-md-4">
                      <?php 
                         $js='class="form-control"';
                         
                         echo form_dropdown('parent_cat_id',$options,$parent_cat_id,$js);
                       ?>
                     </div>
                     </div>
                    </div>
                  <?php endif;  ?>

                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="cat_title" value="<?php if($isEdit) echo $datas->cat_title;  ?>" class="form-control" id="exampleInputEmail1" placeholder="Category Title">
                      <span style="color:red"><?php echo form_error('cat_title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Priority</label>
                      <input type="text" name="priority" value="<?php if($isEdit) echo $datas->priority;  ?>" class="form-control" id="exampleInputEmail1" placeholder="Priority">
                      <span style="color:red"><?php echo form_error('email'); ?></span>
                    </div>
                   
                    </div>
                        <div class="form-group">
                      <label>Status</label>
                     <div class="form-group">
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios1" value="1"
                          <?php
                              if($isEdit) 
                                       {
                                          if($datas->status==1)
                                          {
                                            echo 'checked'; 

                                          }
                                        
                                        }
                                        else
                                        {
                                          echo 'checked';
                                        }
                                        ?>
                                        >
                          Active
                        </label>
                      </div>
                      <div class="radio">
                        <label>
                          <input type="radio" name="status" id="optionsRadios2" value="0"
                          <?php
                              if($isEdit) 
                                       {
                                          if($datas->status==0)
                                          {
                                            echo 'checked'; 

                                          }
                                        
                                        }
                                        
                                        ?>


                          >
                          In Active
                        </label>
                      </div>
                      
                    </div>
                    </div>
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                  
                <?php echo form_close();  ?>
              </div><!-- /.box -->

              

              

            </div><!--/.col (left) -->
            <!-- right column -->

          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 