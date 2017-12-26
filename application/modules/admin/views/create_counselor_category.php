<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
<!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Counselor Management

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
            <?php  
             $attributes = array('id' => 'counselor_category','enctype'=>"multipart/form-data"); 
            echo form_open($action,$attributes); ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="cat_title" value="<?php if($isEdit) echo $datas->cat_title;  ?>" class="form-control" id="exampleInputEmail1" placeholder="Category Title" required>
                      <span style="color:red"><?php echo form_error('cat_title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="slug">Slug</label>
                      <input type="text" name="slug" value="<?php if($isEdit) echo $datas->slug;  ?>" class="form-control" id="" placeholder="Slug">
                      <p class="help-block">Leave blank to auto create slug. </p>
                    </div>
                    <div class="form-group">
                      <label for="priority">Priority</label>
                      <input type="text" name="priority" value="<?php if($isEdit) echo $datas->priority;  ?>" class="form-control" id="" placeholder="Priority">
                      <span style="color:red"><?php echo form_error('email'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1" style="display: block;">Logo</label>
                      <?php if ($isEdit) { ?>
                                <input type="hidden" value="<?php echo $datas->image; ?>" name="prev_image"/>
                            <?php } ?>

                    <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px; line-height: 150px;">
                     
                    <?php if($isEdit):   ?>
                      <img src="<?php echo base_url().'uploads/'.'counselor/thumbs/'.$datas->image; ?>">
                    <?php endif; ?>   
                                  
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
                      <label>Status</label>
                    <div class="radio">
                        <label>
                          <input type="radio" name="status" id="" value="1"
                          <?php if($isEdit) {if($datas->status==1){echo 'checked'; }}
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
                              if($isEdit) {if($datas->status==0)
                                          {
                                            echo 'checked';
                                          }
                                        }
                                        
                                        ?>
                                        >In Active
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

         
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 