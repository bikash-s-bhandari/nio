<?php $isEdit=isset($datas)? TRUE:FALSE;    ?>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Slider Management
           
          </h1>
          <ol class="breadcrumb">
          <?php foreach ($breadcrumb as $key => $value)
          {
            if($value==''):
              echo '<li class="active">'.ucfirst($key).'</li>';

              else:
              echo '<li><a href="'.base_url().'admin/'.$value.'">'.ucfirst($key).'</a></li>';

             endif;
           } 
           ?>
            
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
            <?php  echo form_open_multipart($action); ?>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Title</label>
                      <input type="text" name="title" value="<?php if($isEdit) echo $datas->title;  ?>" class="form-control" id="exampleInputEmail1" placeholder="Slider Title">
                    </div>
                 
                   <div class="form-group">
                    <label class="control-label" style="display: block;">Images</label>
                            <?php if ($isEdit) { ?>
                                <input type="hidden" value="<?php echo $datas->image; ?>" name="prev_image"/>
                            <?php } ?>
                               <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                     <?php if($isEdit):   ?>
                                      <img src="<?php echo base_url().'uploads/'.'sliders/thumbs/'.$datas->image; ?>">


                                     <?php endif; ?>   
                                    </div>
                                    <div> 
                                        <span class="btn btn-default btn-file">
                                        <?php if($isEdit): ?>
                                             <span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                            <?php else:?>
                                            <span class="fileinput-new">Upload multiple images</span><span class="fileinput-exists">Change</span>
                                          <?php endif; ?>
                                            <?php if($isEdit): ?>
                                            <input type="file" name="userfile">
                                            <?php else:?>
                                            <input type="file" name="userfile[]" multiple required>
                                          <?php endif; ?>
                                        </span> 
                                        <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                    </div>
                                </div><!-- //fileinput-->
                      
                     
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
 